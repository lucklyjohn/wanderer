<?php

namespace App\Providers\Base\Cache;
use App\Providers\Base\Cache\CacheBehavior;
use Log;
use Cache;

class CacheTemplate{
    const NO_DATA_TIMEOUT = 600;
    protected $defaultBehavior = 0;
    CONST BEHAVIOR_FETCH_SOURCE = 1;

    public function setDefaultBehavior($defaultBehavior){
        $this->defaultBehavior = $defaultBehavior;
    }

    protected function _fetch($key, $callback)
    {
        $data = false;
        $updated = false;
        $interval = 500000; //0.5s
        for($i = 0; $i < CacheBehavior::DEFAULT_TRY_TIMES; ++$i){
            if(0 === ($this->defaultBehavior & CacheBehavior::BEHAVIOR_FETCH_SOURCE)){
                try{
                    $data = Cache::get($key);
                }catch(CacheErrorException $e){
                    Log::error("Cache Error at try: $i", array($e));
                }
            }
            if(false !== $data && null !== $data){
                break;
            }else{
                try{
                    $data = call_user_func($callback, $key);
                    if(false !== $data && null !== $data){
                        $updated = true;
                    }
                    break;
                }catch(CallbackLockFailedException $e){
                    Log::warn("Lock key failed.", array($e));
                    //wait for lock
                    if($i != 0){
                        usleep($interval);
                        $interval *= 2;
                    }
                }
            }
        }

        if (false === $data) {
            Log::error("[Data Missed] key: $key (Should not use false as return value)");
            //throw new DataMissedException("[Data Missed] key: $key (Should not use NULL as return value)");
        } else if ($updated || 0 != ($this->defaultBehavior & CacheBehavior::BEHAVIOR_UPDATE_CACHE)){
            Cache::put($key, $data, CacheBehavior::FOREVER);
        }

        return $data;
    }

    protected function _fetchMulti($keys, $callback)
    {
        $cache = Cache::getMemcached();
        $map = false;
        $expires = array();
        $updated = false;
        $interval = 500000; //0.5s
        for($i = 0; $i < CacheBehavior::DEFAULT_TRY_TIMES; ++$i){
            if(0 === ($this->defaultBehavior & CacheBehavior::BEHAVIOR_FETCH_SOURCE)){
                try{
                    $map = $cache->getMulti($keys);
                }catch(CacheErrorException $e){
                    $logger = LogFactory::get('cache_template');
                    $logger->error("Cache Error at try: $i", array($e));
                }
            }

            if(false === $map){
                $map = array();
            }

            $cachedKeys = array_keys($map);
            $missedKeys = array_diff($keys, $cachedKeys);
            $map_src = array();
            if(empty($missedKeys)){
                break;
            }else{
                try{
                    //NOTICE: to avoid parameter errors during prepared statement execution
                    $missedKeys = array_values($missedKeys);
                    $map_src = call_user_func($callback, $missedKeys);
                    if(!empty($map_src)){
                        $map = $map + $map_src;
                        $updated = true;
                    }
                    if($map_src !== false){
                        break;
                    }
                }catch(CallbackLockFailedException $e){
                    Log::warning("Lock key failed.", array($e));
                    //wait for lock
                    if($i != 0){
                        usleep($interval);
                        $interval *= 2;
                    }
                }
            }
        }
        if(empty($map)){
            Log::warning("[Data Missed] multi keys: " . var_export($keys, true));
            //throw new DataMissedException("[Data Missed] key: $key (Should not use NULL as return value)");
        }else{
            $map_to_update = null;
            if(0 != ($this->defaultBehavior & CacheBehavior::BEHAVIOR_UPDATE_CACHE)){
                $map_to_update = &$map;
            }else if($updated){
                $map_to_update = &$map_src;
            }
            if(!empty($map_to_update)){
                $toSave = $map_to_update;
                $cache->save($toSave, CacheBehavior::FOREVER);
            }

            if(!empty($expires) && !empty($this->warmer)){
                $current = time();
                $toWarm = array();
                foreach($expires as $key => $expire){
                    if($expire > 0 && $expire - $current < $this->prefetch){
                        $toWarm[] = $key;
                    }
                }
                if(!empty($toWarm)){
                    $this->warmer->registerMulti($callback, $toWarm, $cache, $behavior, $timeout);
                }
            }
        }
        if($this->clearNoData && !empty($map) && is_array($map)){
            $map = NoData::clear($map);
        }
        return $map;
    }
}

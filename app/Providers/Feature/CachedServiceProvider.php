<?php
namespace App\Providers\Feature;
use App\Providers\Base\Cache\CacheTemplate;
use Cache;
class CachedFeatureService extends CacheTemplate implements FeatureService
{
    const PART = 'feature_part';

    const VERSION = 'version';

    private $instance;

    function __construct($featureModel)
    {
        $this->instance = $featureModel;
    }

    public function getFeature($param){
        if (!$param){
            $msg = ['code'=>0,'error'=>'请传入feature配置参数'];
            return $msg;
        }

        $retParams = $this->explainParam($param);

        $feature = [];

        foreach ($retParams as $retParam){
            $feature[$retParam[self::PART]] = $this->getConfig($retParam[self::PART],$retParam[self::VERSION]);
        }

        return $feature;

    }

    public function explainParam($param){

        $retParams = [];

        foreach ($param as $item=>$values){
            foreach ($values as $key=>$value){
                $retParams[$key][$item] = $value;
            }
        }

        return $retParams;
    }

    public function getConfig($part,$version){
        $feature = $this->instance->getConfig($part,$version);
        return $feature;
    }


}
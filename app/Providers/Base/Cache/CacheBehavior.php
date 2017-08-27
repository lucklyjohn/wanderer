<?php

namespace App\Providers\Base\Cache;

/**
 * Define the constants that controls the behavior of cache.
 **/
interface CacheBehavior{
    /**
     * Default behavior is
     *  to fetch from source if item not found in cache.
     *  update cache if item found from source.
     *  use php serializer for cache format.
     **/
    CONST BEHAVIOR_DEFAULT = 0;
    /**
     * Always fetch item from source.
     **/
    CONST BEHAVIOR_FETCH_SOURCE = 1;
    /**
     * Always update cache with items. Could be used to extend cached item lifetime.
     **/
    CONST BEHAVIOR_UPDATE_CACHE = 2;
    /**
     * Use json as cache format.
     * It will be slower than default php serializer format, but more compatible.
     **/
    //@deprecated
    //CONST BEHAVIOR_JSON = 4;
    /**
     * Save cache with short-term timeout, especially used in building other complex caches
     **/
    CONST BEHAVIOR_SHORT_TERM = 8;
    /**
     * Save cache with mid-term timeout, used in caching normal visitable caches
     **/
    CONST BEHAVIOR_MID_TERM = 16;
    /**
     * Save cache with long-term timeout, used in stable caches, delay can be tolerated or update manually
     **/
    CONST BEHAVIOR_LONG_TERM = 32;
    /**
     * Shuffle the cache item timeout. So that the cache item saved at same time will not expire together.
     */
    CONST BEHAVIOR_SHUFFLE = 64;
    /*
     * Wrap the cache content, attach expire time to support prediction of cache item expiration.
     */
    CONST BEHAVIOR_EXPIRE_PREDICT = 128;

    /**
     * Times to try if data fetch failed.
     * Including cache access and source access if cache not found.
     **/
    CONST DEFAULT_TRY_TIMES = 3;

    /**
     * Different level of cache timeout (short/mid/long term)
     **/
    CONST SHORT_TERM     = 'SHORT_TERM';
    CONST MID_TERM       = 'MID_TERM';
    CONST LONG_TERM      = 'LONG_TERM';
    CONST SHUFFLE_SUFFIX = "_SHUFFLE";
    /**
     * A very long time for default cache timeout.
     **/
    CONST FOREVER = 172800; //2 days
} // END interface

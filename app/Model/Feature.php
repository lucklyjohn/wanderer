<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //
    protected $table = 'features';

    public function getConfig($part,$version){

        $config = Feature::where('feature_part',$part)->where('version',$version)->first();

        return $config;
    }

}

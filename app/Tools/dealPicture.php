<?php
namespace App\Tools;
use Config;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class DealPicture{

    private $appObj;

    private $publicObj;

    public function __construct()
    {
        $this->appObj = Storage::disk('local');

        $this->publicObj = Storage::disk('public');
    }

    static $PUBLICPATH = '/storage/';

    public function savePictures(array $streams,$dirname){

        if (!$streams){

            return ['code'=>0,'msg'=>'文件流为空'];

        }

        if (!$this->publicObj->exists($dirname)){

            $this->publicObj->makeDirectory($dirname);

        }

        foreach ($streams as $stream){

            $stream = explode(',',$stream);

            $stream = end($stream);

            $namerule = md5(uniqid(mt_rand(1,100).time(),true));

            $filename = $dirname.'/'.$namerule.'.jpeg';

            try{

                $this->publicObj->put($filename,base64_decode($stream));

                $path = self::$PUBLICPATH.$dirname.'/'.$namerule.'.jpeg';

                return ['code'=>1,'msg'=>$path];

            }catch (Exception $e){

                return ['code'=>0,'msg'=>$e->getMessage()];

            }

        }

    }

}
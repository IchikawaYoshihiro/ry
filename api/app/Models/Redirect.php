<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = ['rand', 'original_url'];
    public $timestamps = false;

    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }

    public static function createFromOriginalUrl($original_url): string
    {
        $redirect = parent::firstOrCreate(['original_url' => $original_url], ['rand' => self::createRand()]);
        return $redirect->tiny_url;
    }

    public static function getRedirectByTinyUrl($tiny_url):? self
    {
        $id = substr($tiny_url, 0, strlen($tiny_url)-3);
        $rand = substr($tiny_url, -3, 3);

        return self::where('rand', $rand)->find($id);
    }

    /**
     * 000 - zzz
     */
    private static function createRand()
    {
        return str_pad(base_convert(random_int(0, 46656), 10, 36), 3, '0', STR_PAD_LEFT);
    }



    /**
     * id+乱数(3桁)
     */
    public function getTinyUrlAttribute()
    {
        return config('app.url').'/'.$this->id.$this->rand;
    }

    public function addAccessLog($data = [])
    {
        return $this->accessLogs()->save(new AccessLog($data));
    }
}

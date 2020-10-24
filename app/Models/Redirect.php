<?php

namespace App\Models;

use Error;

class Redirect
{
    public static function create($original)
    {
        $data = [
            'original' => $original,
            'tiny' => self::createTiny(),
        ];
        $result = app('db')->table('redirects')->insert($data);

        if ($result) {
            return config('app.url').'/'.$data['tiny'];
        }
        throw new Error('短縮URLの生成に失敗しました');
    }

    public static function getOriginal($tiny):? string
    {
        $result = app('db')->table('redirects')->select('original')->where('tiny', $tiny)->first();
        return $result->original ?? null;
    }

    private static function createTiny(): string
    {
        $latest = app('db')->select("SELECT id FROM redirects limit 1");
        $id = empty($latest) ? 1 : $latest[0]->id;
        return dechex($id.random_int(100, 999));
    }
}

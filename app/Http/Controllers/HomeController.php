<?php

namespace App\Http\Controllers;

use App\Models\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return response(config('app.name'));
    }

    public function redirect(string $tiny)
    {
        $original_url = Redirect::getOriginalUrlByTinyUrl($tiny);
        return $original_url
            ? redirect($original_url)
            : response('指定されたURLが見つかりませんでした。', 404);
    }
}

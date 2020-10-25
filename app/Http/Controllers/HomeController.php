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
        $redirect = Redirect::getRedirectByTinyUrl($tiny);
        if ($redirect) {
            $redirect->addAccessLog([
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'ua' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
            return redirect($redirect->original_url);
        }
        return response('指定されたURLが見つかりませんでした。', 404);
    }
}

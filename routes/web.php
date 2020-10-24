<?php

use App\Models\Redirect;
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () {
    return '短縮URLサービス';
});

$router->get('/api/redirects/create', function (Request $request) {
    return Redirect::create($request->url);
});

$router->get('/{tiny:.+}', function ($tiny) {
    $original = Redirect::getOriginal($tiny);
    return $original
        ? redirect($original)
        : response('指定されたURLが見つかりませんでした。', 404);
});

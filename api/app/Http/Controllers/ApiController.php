<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;
use Validator;

class ApiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return response('指定されたURLが正しくありません', 422);
        }

        return Redirect::createFromOriginalUrl($request->url);
    }
    public function createMany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'urls' => 'required|array|max:100',
            'urls.*' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return response('指定されたURLが正しくありません', 422);
        }

        return array_reduce(
            $request->urls,
            function ($results, $original_url) {
                $results[$original_url] = Redirect::createFromOriginalUrl($original_url);
                return $results;
            },
            []
        );
    }
}

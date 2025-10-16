<?php

namespace App\Http\Controllers;

use App\Http\Requests\Linkrequest;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    use HttpResponses;

    public function shortLink(Linkrequest $request){

        $request->validated($request->all());
        $user = $request->user();
        /*if(!$request->custom_code){
            $request->custom_code =  \Illuminate\Support\Str::random(10);
        }*/
        $click = 0;
        $short = Link::create([
            'original_url' => $request->original_url,
            'code' => $request->custom_code || Str::random(10),
            'user_id' => $user->id,
            'clicks' => $click,
        ]);

        return $this->success($short,'', 201);
    }
}

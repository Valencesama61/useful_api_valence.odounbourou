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
        //$click = 0;
       
        $short = Link::create([
            'original_url' => $request->original_url,
            'code' => $request->custom_code ? $request->custom_code : Str::random(10),
            'user_id' => $user->id,
            'clicks' => 0,
        ]);
        
        return $this->success($short,'', 201);
    }

    public function redirection(Request $request, $code){
        $short = Link::find($code);
        if(!$short) return $this->error('', 'Original link not found', 404);
        $short->clicks++;
        return redirect($short->original_url);
    }

    public function fetchLinks(Request $request){
        $user = $request->user();
        $links = Link::where('user_id', $user->id);
        return $this->success($links);
    }

    public function delete(Request $request, $id){
        $user = $request->user();
        $link = Link::where('user_id', $user->id)
                    ->where('module_id', $id);

        if(!$link) return $this->error('', 'Original link not found', 404);
        $link->delete();
        return $this->success('', 'link deleted successfully');
    }
}

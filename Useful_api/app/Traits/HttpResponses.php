<?php 

namespace App\Traits;

trait HttpResponses{
    //success response
    protected function success($data, $message = null, $code = 200){
        return response()->json([
            'status' => 'Ok',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    //error response
    protected function error($data, $message = null, $code){
        return response()->json([
            'status' => 'Ok',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}


?>
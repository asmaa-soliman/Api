<?php
namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($data=null,$message=null,$status=null)
    {
        $array=[
            'key'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
        //response(content,ststus,array header(المسدج اللي رجعت))
        return response($array,$status);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendResponse($data,$message,$status=200){
        $result = [
            "data" => $data,
            "message" => $message
        ];

        return response()->json($result,$status);
    }
}

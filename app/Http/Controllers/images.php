<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class images extends Controller
{
    //
    public function index(ImageService $service){
        return $service->getall();
    }

    public function store(ImageService $service, Request $request){
        return $service->store($request);
    }
}

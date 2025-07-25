<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Response;   
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(request $request){
        $request = Request::create(
            url('/api/products'),
            'GET'
        );
        $response = Route::dispatch($request);
        $products = $response->getContent();
        $products = json_decode($products, true);
        if (is_null($products)) {
            $products = [];
        }
        if (isset($products['data'])) {
            $products = $products['data'];
        } else {
            $products = [];
        }           

        return view('welcome', compact('products'));
    }
}

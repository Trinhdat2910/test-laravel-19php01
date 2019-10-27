<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function getAdd(){

        return view('home.products.add');
    }
    public function postAdd(ProductRequest $request){
        return 'àkjkdhf';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductDetails;
use Gloudemans\Shoppingcart\Facades\Cart ;

class ProductsController extends Controller
{
    protected $products;
    protected $productdetails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Products $_products = null, ProductDetails $_productdetails = null)
    {
     
        $this->products = $_products;
        $this->productdetails = $_productdetails;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        $oPorduct= $this->products->getProductById($id);
        if(empty($oPorduct)){
            return redirect()->back();
        }
        return view('home.detail.index',[
            'oPorduct' => $oPorduct
        ]);
    }
    public function getSize()
    {
        $id = $_GET['id'];
        $status= $this->productdetails->getStatusById($id);
        if(empty($status)){
            return response()->json(array(
                "errors" => array("error" => array('Vui lòng chọn size'))
            ), 422);
        }
        return response()->json($status);  
    }
    
}

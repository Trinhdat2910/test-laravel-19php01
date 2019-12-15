<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{
    protected $products;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Products $_products = null)
    {
     
        $this->products = $_products;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listProductHot= $this->products->getProductsHot();
        return view('home.index',[
            'listProductHot' => $listProductHot
        ]);
    }
    public function collection($key)
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $listProductHot= $this->products->where('name','like','%'.$search.'%')->where('status', 1)->paginate(20);
            return view('home.index',[
                'listProductHot' => $listProductHot
            ]);

        }else{
            if(!empty($key)){
                if($key == 'collection'){
                    $listProduct= $this->products->getProductsHot();
                    return view('home.collection.index',[
                        'listProduct' => $listProduct,
                        'key' => $key
                    ]);
                }
                if($key == 'men'){
                    $listProduct= $this->products->getProductsMen();
                    return view('home.collection.index',[
                        'listProduct' => $listProduct,
                        'key' => $key
                    ]);
                }
                if($key == 'women'){
                    $listProduct= $this->products->getProductsWomen();
                    return view('home.collection.index',[
                        'listProduct' => $listProduct,
                        'key' => $key
                    ]);
                }
                $listProductHot= $this->products->getProductsHot();
                return view('home.index',[
                    'listProductHot' => $listProductHot
                ]);
            }else{
                $listProductHot= $this->products->getProductsHot();
                return view('home.index',[
                    'listProductHot' => $listProductHot
                ]);
            }
        }
    }
    
}

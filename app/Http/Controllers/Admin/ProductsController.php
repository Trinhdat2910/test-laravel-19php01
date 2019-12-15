<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductsRequest;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\ProductDetails;

class ProductsController extends Controller
{
    protected $products;
    protected $productsType;
    protected $productsDetail;
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";

    public function __construct(Products $_products = null, ProductType $_productsType = null, ProductDetails $_productsDetail = null)
      {
        $this->middleware('auth');
        $this->products = $_products;
        $this->productsType = $_productsType;
        $this->productsDetail = $_productsDetail;
      }
      /**
	 * Show all products in View
     *
     * @param
     *
	 * @return view template
	*/
    public function index()
    {
      $listProducts = $this->products->getAllProducts();
      return view('admin.products.index',[
        'listProducts' => $listProducts
      ]);
    }
    public function getAdd(){
      $listProductsType = $this->productsType->getAllProductsType();
      return view('admin.products.add',[
        'listProductsType' => $listProductsType
      ]);
    }
    public function postAdd(ProductRequest $request){
      $newProducts = $this->products->addNewProduct($request);

      if($newProducts == self::RETURN_STR_ZERO){
        return redirect('/admin/products/add')->with([
          'message' => 'Thêm Sản phẩm lỗi',
          'class' => 'error'
      ]);
      }
      return redirect('/admin/products/list')->with([
        'message' => 'Thêm thành công',
        'class' => 'success'
    ]);
    }
    public function delete($id){
      $oProduct = $this->products->deleteProducts($id);
      if($oProduct == self::RETURN_STR_ZERO){
          return redirect()->back()->with([
            'message' => 'Xoá lỗi',
            'class' => 'error'
        ]);
      }
      return redirect('/admin/products/list')->with([
        'message' => 'Xoá thành công',
        'class' => 'success'
    ]);
    }
    public function getEdit($id){
      $oProduct = $this->products->getProductById($id);
      $listProductsType = $this->productsType->getAllProductsType();
      return view('admin.products.edit',[
          'oProduct' => $oProduct,
          'listProductsType' => $listProductsType
      ]);
    }
    public function postEdit(EditProductsRequest $request, $id){
      $oProduct = $this->products->updateProduct($request, $id);
      if($oProduct == self::RETURN_STR_ZERO){
          return redirect()->back()->with([
            'message' => 'Cập nhật lỗi',
            'class' => 'error'
        ]);
      }
      return redirect('/admin/products/list')->with([
        'message' => 'Cập nhật thành công',
        'class' => 'success'
    ]);
    }
    public function detail($id){
      $oProduct = $this->products->getProductById($id);
      $listProductDetail = $this->productsDetail->getProductDetailById($id);
      if($listProductDetail == self::RETURN_STR_ZERO){
        return redirect('/admin/products/list');
      }
      $listProductsType = $this->productsType->getAllProductsType();
      return view('admin.productDetail.index',[
          'oProduct' => $oProduct,
          'listProductDetail' => $listProductDetail,
          'listProductsType' => $listProductsType
      ]);
    }
}

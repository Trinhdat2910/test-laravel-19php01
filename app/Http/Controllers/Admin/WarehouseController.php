<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehousing;
use App\Models\Products;
use App\Models\ProductDetails;
use App\Models\Supplier;
use App\Http\Requests\AddWarehouseRequest;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    protected $warehouse;
    protected $products;
    protected $supllier;
    protected $productDetail;
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";

    public function __construct(Warehousing $_warehouse = null, Products $_products = null, ProductDetails $_productDetail = null, Supplier $_supplier = null)
    {
        $this->middleware('auth');
        $this->warehouse = $_warehouse;
        $this->products = $_products;
        $this->productDetail = $_productDetail;
        $this->supllier = $_supplier;
    }
    public function index()
    {
      $listWarehouse = $this->warehouse->getAllWarehouse();
      return view('admin.warehouse.index',[
        'listWarehouse' => $listWarehouse
      ]);
    }
    public function getAdd(){
        $listProducts = $this->products->getAllProducts();
        $listSupplier = $this->supllier->getAllSupplier();
        return view('admin.warehouse.add',[
            'listSupplier' => $listSupplier,
            'listProducts' => $listProducts
        ]);
    }
    public function postAdd(AddWarehouseRequest $request){
        $newWarehouse = $this->warehouse->addNewWarehouse($request);
        if($newWarehouse == self::RETURN_STR_ZERO){
          return redirect('/admin/warehouse/add');
        }
        return redirect('/admin/warehouse/list');
    }
    public function getEdit($id){
        $oWarehouse = $this->warehouse->getWarehouseById($id);
        $listProducts = $this->products->getAllProducts();
        $listSupplier = $this->supllier->getAllSupplier();
        return view('admin.warehouse.edit',[
            'oWarehouse' => $oWarehouse,
            'listSupplier' => $listSupplier,
            'listProducts' => $listProducts
        ]);
    }
    public function postEdit(AddWarehouseRequest $request, $id){
        $oWarehosue = $this->warehouse->updateWarehouse($request, $id);
        if($oWarehosue == self::RETURN_STR_ZERO){
            return redirect()->back();
        }
        return redirect('/admin/warehouse/list');
    }
    public function delete($id){
        $oWarehouse = $this->warehouse->deleteWarehouse($id);
        if($oWarehouse == self::RETURN_STR_ZERO){
            return redirect()->back();
        }
        return redirect('/admin/warehouse/list');
    }
    public function approved($id){
        DB::beginTransaction();
        try {
            $oWarehouse = $this->warehouse->find($id);
            $productDetail = $this->productDetail->where('size','=',$oWarehouse->size)->first();
            if(empty($productDetail)){
                $productDetail = $this->productDetail->addNewProductDetails($oWarehouse);
                if($productDetail == self::RETURN_STR_ZERO){
                    return redirect('/admin/warehouse/list');
                }
                $oWarehouse->approved = self::RETURN_STR_ONE;
                $oWarehouse->save();
            }
            else{
                $productDetail->quantity = $productDetail->quantity + $oWarehouse->quantity;
                $productDetail->products_id = $oWarehouse->products_id;
                if(! $productDetail->save()){
                    return redirect('/admin/warehouse/list');
                }
                $oWarehouse->approved = self::RETURN_STR_ONE;
                $oWarehouse->save();
            }
        }  catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('/admin/warehouse/list');
        }
        DB::commit();
        return redirect('/admin/warehouse/list');
    }
}

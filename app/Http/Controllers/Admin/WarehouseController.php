<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehousing;
use App\Models\Products;
use App\Models\ProductDetails;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Http\Requests\AddWarehouseRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WarehouseController extends Controller
{
    protected $warehouse;
    protected $products;
    protected $supllier;
    protected $productDetail;
    protected $transaction;
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";

    public function __construct(Warehousing $_warehouse = null, Products $_products = null, ProductDetails $_productDetail = null, Supplier $_supplier = null,
    Transaction $_transaction = null
    )
    {
        $this->middleware('auth');
        $this->warehouse = $_warehouse;
        $this->products = $_products;
        $this->productDetail = $_productDetail;
        $this->supllier = $_supplier;
        $this->transaction = $_transaction;
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
          return redirect('/admin/warehouse/add')->with([
            'message' => 'Thêm Nhập kho Lỗi',
            'class' => 'error'
        ]);
        }
        return redirect('/admin/warehouse/list')->with([
            'message' => 'Thêm thành công',
            'class' => 'success'
        ]);;
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
            return redirect()->back()->with([
                'message' => 'Cập nhật lỗi',
                'class' => 'error'
            ]);
        }
        return redirect('/admin/warehouse/list')->with([
            'message' => 'cập nhật thành công',
            'class' => 'success'
        ]);
    }
    public function delete($id){
        $oWarehouse = $this->warehouse->deleteWarehouse($id);
        if($oWarehouse == self::RETURN_STR_ZERO){
            return redirect()->back()->with([
                'message' => 'Xoá Lỗi',
                'class' => 'error'
            ]);
        }
        return redirect('/admin/warehouse/list')->with([
            'message' => 'Xoá thành công',
            'class' => 'success'
        ]);
    }
    public function approved($id){
        DB::beginTransaction();
        try {
            $oWarehouse = $this->warehouse->find($id);
            $productDetail = $this->productDetail->where('size','=',$oWarehouse->size)->first();
            if(empty($productDetail)){
                $productDetail = $this->productDetail->addNewProductDetails($oWarehouse);
                if($productDetail == self::RETURN_STR_ZERO){
                    return redirect('/admin/warehouse/list')->with([
                        'message' => 'Phê duyệt lỗi',
                        'class' => 'error'
                    ]);
                }
                $oWarehouse->approved = self::RETURN_STR_ONE;
                $oWarehouse->save();
            }
            else{
                $productDetail->quantity = $productDetail->quantity + $oWarehouse->quantity;
                $productDetail->products_id = $oWarehouse->products_id;
                if(! $productDetail->save()){
                    return redirect('/admin/warehouse/list')->with([
                        'message' => 'Phê duyệt lỗi',
                        'class' => 'error'
                    ]);
                }
                $oWarehouse->approved = self::RETURN_STR_ONE;
                $oWarehouse->save();
            }
        }  catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('/admin/warehouse/list')->with([
                'message' => 'Phê duyệt lỗi',
                'class' => 'error'
            ]);
        }
        DB::commit();
        return redirect('/admin/warehouse/list')->with([
            'message' => 'Phê duyệt thành công',
            'class' => 'success'
        ]);
    }
    public function payment($id){
        DB::beginTransaction();
        try {
            $oWarehouse = $this->warehouse->find($id);
            $oTransaction = $this->transaction->where('warehousing_id','=',$oWarehouse->id)->first();
            if(!empty($oTransaction)){
                DB::rollback();
                return redirect('/admin/warehouse/list')->with([
                    'message' => 'Thanh toán lỗi',
                    'class' => 'error'
                ]);
            }
            else{
                $oTransaction = $this->transaction;
                $oTransaction->tittle = 'Chi' ;
                $oTransaction->amount = -($oWarehouse->quantity * $oWarehouse->price);
                $oTransaction->warehousing_id = $id ;
                $oTransaction->note = 'Thanh toán cho Nhà cung cấp '. $oWarehouse->supplier->name;
                $oTransaction->created_at = Carbon::now();
                if(!($oTransaction->save())){
                    DB::rollback();
                    return redirect('/admin/warehouse/list')->with([
                        'message' => 'Thanh toán lỗi',
                        'class' => 'error'
                    ]);
                }

            }
        }  catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/warehouse/list')->with([
                'message' => 'Thanh toán lỗi',
                'class' => 'error'
            ]);
        }
        DB::commit();
        return redirect('/admin/warehouse/list')->with([
            'message' => 'Thanh toán thành công',
            'class' => 'success'
        ]);
    }
}

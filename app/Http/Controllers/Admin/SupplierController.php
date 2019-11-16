<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSupplierRequest;
use App\Models\Supplier;

class SupplierController extends Controller
{
    protected $supplier;
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";

    public function __construct(Supplier $_supplier = null)
    {
        $this->middleware('auth');
        $this->supplier = $_supplier;
    }
    public function index()
    {
      $listSupplier = $this->supplier->getAllSupplier();
      return view('admin.supplier.index',[
        'listSupplier' => $listSupplier
      ]);
    }
    public function getAdd(){

        return view('admin.supplier.add');
    }
    public function postAdd(AddSupplierRequest $request){
      $newSupplier = $this->supplier->addNewSupplier($request);
      if($newSupplier == self::RETURN_STR_ZERO){
        return redirect('/admin/supplier/add');
      }
      return redirect('/admin/supplier/list');
    }
    public function getEdit($id){
        $oSupplier = $this->supplier->getSupplierById($id);
        
        return view('admin.supplier.edit',[
            'oSupplier' => $oSupplier
        ]);
    }
    public function postEdit(AddSupplierRequest $request, $id){
        $oSupplier = $this->supplier->updateSupplier($request, $id);
        if($oSupplier == self::RETURN_STR_ZERO){
            return redirect()->back();
        }
        return redirect('/admin/supplier/list');
    }
    public function delete($id){
        $oSupplier = $this->supplier->deleteSupplier($id);
        if($oSupplier == self::RETURN_STR_ZERO){
            return redirect()->back();
        }
        return redirect('/admin/supplier/list');
    }
}

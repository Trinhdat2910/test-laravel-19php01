<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\ProductDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orders;
    protected $status;
    protected $transaction;
    protected $productdetails;
    
    public function __construct(Orders $_orders = null, Status $_status = null,
    Transaction $_transaction = null,
    ProductDetails $_productdetails = null)
    {
        $this->middleware('auth');
        $this->orders = $_orders;
        $this->status = $_status;
        $this->transaction = $_transaction;
        $this->productdetails = $_productdetails;
    }
    public function index(){
        $listOrder = $this->orders->getListOrder();
        return view('admin.order.index',[
            'listOrder' => $listOrder
        ]);
    }
    public function detail($id){
        $oOrder = $this->orders->getOrderById($id);
        return view('admin.order.detail',[
            'oOrder' => $oOrder
        ]);
    }
    public function edit($id){
        $oOrder = $this->orders->getOrderById($id);
        if($oOrder->approved == 0){
            $status = $this->status->where('id','<=', 2)->get();
        }else{
            $checkTransaction = $this->transaction->where('order_id', $oOrder->id)->first();
            if(!isset($checkTransaction)){
                $status = $this->status->where('id','>=', 2)->get();
            }else{
                $status = $this->status->where('id','>', 2)->get();
            }
           
        }
        
        return view('admin.order.edit',[
            'oOrder' => $oOrder,
            'status' => $status
        ]);
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'total' => ['required'],
            
        ],[
            'name.required' => 'Vui lòng nhập tên người nhận',
            'phone.required' => 'Vui lòng nhập số điện thoại người nhận',
            'address.required' => 'Vui lòng nhập địa chỉ người nhận',
            'total.required' => 'Vui lòng nhập tổng tiền',
            
        ]);
        $oOrder = $this->orders->getOrderById($id);
        if($request->status == 2 && $oOrder->approved == 0){
            foreach($oOrder->orderdetails as $key => $orderdetail)
            {
                $status= $this->productdetails->getStatusById($orderdetail->product_detail_id);
                if($status->quantity <= 0){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Sản phẩm đã hết hàng',
                        'class' => 'error'
                    ]);
                }elseif($status->quantity < $oOrder->quantity){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Sản phẩm không đủ số lượng cho đơn hàng này',
                        'class' => 'error'
                    ]);
                }else{
                    $status->quantity = $status->quantity - $orderdetail->quantity;
                    if(!($status->save())){
                        DB::rollback();
                        return redirect()->back()->with([
                            'message' => 'Cập nhật lỗi',
                            'class' => 'error'
                        ]);
                    }
                }
            }
            DB::beginTransaction();
            try {
                $oOrder = $this->orders->getOrderById($id);
                $oOrder->recipient = $request->name;
                $oOrder->phone_number = $request->phone;
                $oOrder->address = $request->address;
                $oOrder->total = $request->total;
                $oOrder->payment_type = $request->payment;
                $oOrder->tracking_number = $request->tracking_number;
                $oOrder->status_id = $request->status;
                
                if($request->status == 2 && $oOrder->approved == 1){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Đơn hàng đã được phê duyệt',
                        'class' => 'error'
                    ]);
                }
                $oOrder->approved = '1';
                if(!($oOrder->save())){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Cập nhật lỗi',
                        'class' => 'error'
                    ]);
                }
            }  catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with([
                    'message' => 'Cập nhật lỗi',
                    'class' => 'error'
                ]);
            }
            DB::commit();
            return redirect()->back()->with([
                'message' => 'Cập nhật thành công',
                'class' => 'success'
            ]);
        }else{
            DB::beginTransaction();
            try {
                $oOrder = $this->orders->getOrderById($id);
                $oOrder->recipient = $request->name;
                $oOrder->phone_number = $request->phone;
                $oOrder->address = $request->address;
                $oOrder->total = $request->total;
                $oOrder->payment_type = $request->payment;
                $oOrder->tracking_number = $request->tracking_number;
                if($request->status == 3){
                    $oOrder->status_id = $request->status;
                    $oTransaction = $this->transaction;
                    $checkTransaction = $oTransaction->where('order_id', $oOrder->id)->first();
                    if(isset($checkTransaction)){
                        DB::rollback();
                        return redirect()->back()->with([
                            'message' => 'Đơn hàng đã được thanh toán',
                            'class' => 'error'
                        ]);
                        
                    }
                    $oTransaction->tittle = 'Thu' ;
                    $oTransaction->amount = $oOrder->total;
                    $oTransaction->order_id = $oOrder->id ;
                    $oTransaction->note = $oOrder->user->name.' thanh toán cho đơn hàng ';
                    $oTransaction->created_at = Carbon::now();
                    if(!($oTransaction->save())){
                        DB::rollback();
                        return redirect()->back()->with([
                            'message' => 'Cập nhật lỗi',
                            'class' => 'error'
                        ]);
                    }
                }else{
                    $oOrder->status_id = $request->status;
                }
                if($request->status == 2 && $oOrder->approved == 1){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Đơn hàng đã được phê duyệt',
                        'class' => 'error'
                    ]);
                }
                if(!($oOrder->save())){
                    DB::rollback();
                    return redirect()->back()->with([
                        'message' => 'Cập nhật lỗi',
                        'class' => 'error'
                    ]);
                }
            }  catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with([
                    'message' => 'Cập nhật lỗi',
                    'class' => 'error'
                ]);
            }
            DB::commit();
            return redirect()->back()->with([
                'message' => 'Cập nhật thành công',
                'class' => 'success'
            ]);
        }

    }
    public function delete($id){
        $oOrder = $this->orders;
        if(!($oOrder->destroy($id))){
            return redirect()->back()->with([
                'message' => 'Xoá đơn hàng lỗi',
                'class' => 'error'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Xoá đơn hàng thành công',
            'class' => 'success'
        ]);
    }
}

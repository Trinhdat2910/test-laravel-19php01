<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $transaction;
    protected $orders;
    public function __construct(Transaction $_transaction = null, Orders $_orders = null)
    {
        $this->middleware('auth');
        $this->transaction = $_transaction;
        $this->orders = $_orders;
    }
    public function index(){
        $quantityOrder = $this->orders->count();
        $totalChiThisMonth = $this->transaction->getValueChiThisMonth();
        $totalThuThisMonth = $this->transaction->getValueThuThisMonth();
        $listTransaction = $this->transaction->getAllTransaction();
        return view('admin.index',[
            'listTransaction' => $listTransaction,
            'totalChiThisMonth' => $totalChiThisMonth,
            'totalThuThisMonth' => $totalThuThisMonth,
            'quantityOrder' => $quantityOrder,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    protected $users;
    public function __construct(User $_users = null)
    {
        $this->middleware('auth');
        $this->users = $_users;
    }
    public function getProfile($id)
    {
        $oUser = $this->users->find($id);
        return view('home.user.edit',[
            'oUser' => $oUser
        ]); 
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'address' => ['required'],
            
        ],[
            'name.required' => 'Vui lòng nhập tên người dùng',
            'phone.required' => 'Vui lòng hập số điện thoại người dùng',
            'address.required' => 'Vui lòng hập địa chỉ người dùng',
            
        ]);
        $oUser = $this->users->find($id);
        $oUser->name = $request->name;
        $oUser->phone_number = $request->phone;
        $oUser->address = $request->address;
        if(!$oUser->save()){
            return redirect()->back()->with([
                'message' => 'Cập nhật Lỗi',
                'class' => 'error'
            ]);
        }
        return redirect('/')->with([
            'message' => 'Cập nhật thành công',
            'class' => 'success'
        ]);
    }
}

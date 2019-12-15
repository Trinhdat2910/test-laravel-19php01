<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersController extends Controller
{
    protected $users;
    public function __construct(User $_users = null)
    {
        $this->middleware('auth');
        $this->users = $_users;
    }
    public function index()
    {
      $listUsers = $this->users->getAllUsers();
      return view('admin.users.index',[
        'listUsers' => $listUsers
      ]);
    }
    public function getAdd()
    {
      return view('admin.users.add');
    }
    public function getEdit($id)
    {
      $oUser = $this->users->find($id);
      return view('admin.users.edit',[
        'oUser' => $oUser
      ]);
    }
    public function postAdd(Request $request)
    {
      $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone' => ['required', 'numeric'],
        'address' => ['required', 'string'],
        'role_id' => ['not_in:10'],
      ]);
      $oUser = $this->users;
      $oUser->name = $request->name;
      $oUser->email = $request->email;
      $oUser->password = Hash::make($request->password);
      $oUser->phone_number = $request->phone;
      $oUser->address = $request->address;
      $oUser->role_id = $request->role_id;
      $oUser->email_verified_at = Carbon::now();
      if(!$oUser->save()){
        return redirect('/admin/users/add')->with([
            'message' => 'Thêm lỗi',
            'class' => 'error'
        ]);;
      }
      return redirect('/admin/users/list')->with([
        'message' => 'Thêm thành công',
        'class' => 'success'
      ]);
    }
    public function postEdit(Request $request, $id)
    {
      $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'numeric'],
        'address' => ['required', 'string'],
        'role_id' => ['not_in:10'],
      ]);
      $oUser = $this->users->find($id);
      $oUser->name = $request->name;
      $oUser->phone_number = $request->phone;
      $oUser->address = $request->address;
      $oUser->role_id = $request->role_id;
      if(!$oUser->save()){
        return redirect('/admin/users/edit')->with([
            'message' => 'Cập nhật lỗi',
            'class' => 'error'
        ]);;
      }
      return redirect('/admin/users/list')->with([
        'message' => 'cập nhật thành công',
        'class' => 'success'
      ]);
    }
    public function delete($id){
      $users = $this->users;
      if(!($users->destroy($id))){
          return redirect()->back()->with([
              'message' => 'Xoá lỗi',
              'class' => 'error'
          ]);
      }
      return redirect('/admin/users/list')->with([
          'message' => 'Xoá thành công',
          'class' => 'success'
      ]);
  }
}

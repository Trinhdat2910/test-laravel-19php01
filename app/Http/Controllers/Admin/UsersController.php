<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
      $listUsers = $this->users->getAllUsers();
      return view('admin.users.index',[
        'listUsers' => $listUsers
      ]);
    }
}

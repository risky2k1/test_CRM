<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $data = User::query()->latest()->paginate();
        return view('admin.user.index',[
            'data'=>$data,
        ]);
    }
}

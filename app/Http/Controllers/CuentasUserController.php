<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CuentasUserController extends Controller
{
    public function index(){


        $users = User::paginate(10);

        return view('CuentasUser.index', compact('users'));
    }

    public function destroy(User $users){

        $users->delete();

        return redirect()->route('CuenUser.index');
    }
}

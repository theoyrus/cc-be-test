<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $customers = User::paginate(5);
        $impersonatedUserId = $request->session()->get('impersonated_user');
        $impersonatedUser = User::find($impersonatedUserId);
        return view('home.index', compact('customers', 'impersonatedUserId', 'impersonatedUser'));
    }
}

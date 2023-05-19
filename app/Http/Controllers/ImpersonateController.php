<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function impersonate(Request $request, User $user)
    {
        // set user id ke session impersonate
        $request->session()->put('impersonated_user', $user->id);

        // Redirect ke home
        return redirect()->route('transactions.index');
    }
}

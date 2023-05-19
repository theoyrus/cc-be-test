<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $impersonatedUserId = $request->session()->get('impersonated_user');
        $impersonatedUser = User::find($impersonatedUserId);
        $transactions = Transaction::where('user_id', $impersonatedUserId)->paginate(10);
        return view('transactions.index', compact('transactions', 'impersonatedUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function deposit()
    {
        return view('transactions.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function withdraw()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'order_id' => 'required|string',
                'amount' => 'required|numeric',
            ]
        );

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

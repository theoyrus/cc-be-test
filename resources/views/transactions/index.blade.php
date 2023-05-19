@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Transaction List</h1>
            <a href="{{ route('transactions.deposit') }}" class="btn btn-primary">Deposit</a>
            <a href="{{ route('transactions.withdraw') }}" class="btn btn-danger">Withdraw</a>
            <br><br>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->order_id }}</td>
                        <td>{{ $transaction->type == 'deposit' ? 'Deposit' : 'Withdrawal' }}</td>
                        <td class="text-right">{{ number_format($transaction->amount, 2, ',', '.') }}</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                    {{-- @empty
                    <tr class="text-center">
                        <td colspan="5">Empty :'( Let's make a transaction :)</td>
                    </tr> --}}
                    @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection

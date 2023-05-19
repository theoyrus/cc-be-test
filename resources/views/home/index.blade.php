@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Select Customers</h1>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $cust)
                            <tr>
                                <td>
                                    <form action="{{ route('impersonate.impersonate', $cust) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning" type="submit">Impersonate</button>
                                    </form>
                                </td>
                                <td>{{ $cust->id }}</td>
                                <td>{{ $cust->name }}</td>
                                <td>{{ $cust->email }}</td>
                                <td class="text-right">{{ number_format($cust->wallet_balance, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection

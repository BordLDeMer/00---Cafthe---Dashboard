@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->amount }}</td>
                    <td>{{ $sale->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

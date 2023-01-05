@extends('layouts/back')

@section('title')
Orders
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-md-12">
        <div class="w-75 text-center m-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">user</th>
                        <th scope="col">products_id</th>
                        <th scope="col">products</th>
                        <th scope="col">product_code</th>
                        <th scope="col">paid</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->product_id}}</td>
                        <td>{{$order->product_name}}</td>
                        <td>{{$order->code}}</td>
                        <td>paid</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $orders -> links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
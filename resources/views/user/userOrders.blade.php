@extends('user.layout.master')
@section('css')
@endsection
@section('content')
<div class="mainTitle">
    <h3>My Orders</h3>
</div>
<div class="themeTable">
    <table>
        <thead>
            <tr>
                <th>S.no</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordersDB as $i => $ordersDBItem)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $ordersDBItem['orderNo'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($ordersDBItem['created_at'] )); }}</td>
                    <td>{{ date('d-m-Y', strtotime($ordersDBItem['deliveryDate']) );   }}</td>                     
                    <td>3</td>
                    <td>&dollar;{{ $ordersDBItem['subTotal'] }}</td>
                        @php
                            if ($ordersDBItem['status'] == 'Payment Pending') {
                                $status = "pending";
                            } elseif($ordersDBItem['status'] == 'Payment Successful'){
                                $status = "delivered";
                            }elseif($ordersDBItem['status'] == 'Canceled'){
                                $status = "cancelled";
                            }
                            else {
                                $status = "";
                            }
                            
                        @endphp
                    <td><span class="badge {{ $status }}">{{ $ordersDBItem['status'] }}</span></td>
                    <td><a href="{{ route('user.order_details',[ $ordersDBItem['Id'] ]) }}">View Order</a></td>
                </tr>
            @endforeach           
        </tbody>
    </table>
</div>
@endsection


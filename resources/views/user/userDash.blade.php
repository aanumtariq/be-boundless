@extends('user.layout.master')
@section('css')
@endsection
@section('content')
<div class="mainTitle">
    <h3>Dashboard</h3>
</div>
<div class="orderSingle">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="orderSingle__card" style="padding-bottom: 2.1rem; ">
                <div style="    margin-bottom: 2.5rem;" class="orderSingle__cardTitle">
                    <h4>Profile
                        <a style="float: right;" href="{{ route('user.profile') }}"><button class="btn themeBtn" >Edit Profile</button></a>
                    </h4>                    
                </div>
                <ul style="padding: 1rem;" class="orderSingle__details">	
                    <li>
                        <p>Full Name: </p> <span>{{ $userDB['name'] }} </span>
                    </li>
                    <li>                    
                        <p>Email: </p> <span>{{ $userDB['email'] }}</span>
                    </li>
                    <li>                       
                        <p>Phone No: </p> <span>{{ $userDB['phoneNo'] }}</span>
                    </li>
                    <li>                       
                        <p>DOB: </p> <span>{{ $userDB['dOB'] }}</span>
                    </li>
                    <li>                       
                        <p>Gender: </p> <span>{{ $userDB['gender'] }}</span>
                    </li>
                </ul>  
            </div>
        </div>          
        <div class="col-12 col-lg-8">
            <div class="orderSingle__card">
                <div class="orderSingle__cardTitle">
                    <h4>My Address
                        <a style="float: right;" href="{{ route('user.addressBook') }}"><button class="btn themeBtn" >Manage</button></a>
                    </h4>
                </div>
                <div class="orderSingle__address">
                    <div class="row">                        
                        @if ($address_bookDB != null)
                         <div class="col-6" style="border-right: 1px solid gray">
                                <ul class="orderSingle__details">
                                    <li>
                                        <p>Full Name: </p> <span>{{ $address_bookDB['firstName'].' '.$address_bookDB['lastName'] }} </span>
                                    </li>
                                    <li>                    
                                        <p>Phone Number: </p> <span>{{ $address_bookDB['phoneNumber'] }}</span>
                                    </li>
                                    <li>               
                                        <p>Street: </p> <span>{{ $address_bookDB['street'] }}</span>
                                    </li>
                                    <li>               
                                        <p>Area: </p> <span>{{ $address_bookDB['area'] }}</span>
                                    </li>
                                    <li>               
                                        <p>City: </p> <span>{{ $address_bookDB['city'] }}</span>
                                    </li>
                                    <li>               
                                        <p>Country: </p> <span>{{ $address_bookDB['country'] }}</span>
                                    </li>
                                    <li>               
                                        <p>Zip Code: </p> <span>{{ $address_bookDB['zipCode'] }}</span>
                                    </li>                                
                                </ul>                                                        
                            </div>
                            <div class="col-6">
                                <h4>Complete Address</h4>
                                <address>
                                    {{ $address_bookDB['address'] }}
                                </address>
                            </div>
                        @else
                            <div class="col-6">
                                <h4>No Address Available</h4>                                
                            </div>
                        @endif 
                    </div>                   
                </div>
            </div>
        </div>               
    </div>  
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="orderSingle__card">
                <div class="orderSingle__cardTitle">
                    <h4>Recent Order
                        <a style="float: right;" href="{{ route('user.orders') }}"><button class="btn themeBtn" >View All</button></a>
                    </h4>                        
                    </h4>
                </div>
                <div class="orderSingle__details">
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
                </div>
            </div>           
        </div>
    </div>
</div>
@endsection


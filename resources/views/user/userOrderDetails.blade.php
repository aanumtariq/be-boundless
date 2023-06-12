@extends('user.layout.master')
@section('css')
@endsection
@section('content')
<div class="mainTitle">
    <h3><span>{{ $orderData['orderNo']}}</span>
    @if ($orderData['status'] == 'Payment Pending') 
        <a style="float: right; margin-bottom:5px; " href="{{ route('ecommerce.payment',[ Crypt::encrypt($orderData['Id']) ]) }} ">
            <button class="btn themeBtn" >Pay Now</button>
        </a>
    @endif        
    </h3>
</div>
<div class="orderSingle">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="orderSingle__card">
                <div class="orderSingle__cardTitle">
                    <h4>Ordered Products</h4>
                </div>
                <ul class="orderSingle__cart">
                    @if (is_array($ordPro))
                        @foreach ($ordPro as $i => $ordProItem)
                        <li class="product">
                            <div class="productInfo">
                                <div class="productImg">
                                    <img src="{{  asset($ordProItem['pImage']) }}" alt="image">
                                </div>
                                <div class="productDescription">
                                    <h6>{{ $ordProItem['pName'] }}</h6>
                                    <span>Quantity: <b>x{{ $orderDetailsDB[$i]['orderQty'] }}</b></span>
                            @if($ordProItem['discount']>0)                                                
                                        <span>Price: <ins>&dollar;{{ App\Helpers\Helper::discountedValue($ordProItem['pPrice'], $ordProItem['discount'],true) }}</ins> <del>&dollar;{{ $ordProItem['pPrice'] }}</del></span>  
                                    </div>
                                </div>
                                <div class="productPrice"><b>&dollar;{{ App\Helpers\Helper::discountedValue($ordProItem['pPrice'], $ordProItem['discount'],true) }}</b></div>
                            @else                                                
                                        <span>Price: <ins>&dollar;{{ $ordProItem['pPrice'] }}</ins></span>   
                                    </div>
                                </div>
                                <div class="productPrice"><b>&dollar;{{ $ordProItem['pPrice'] }}</b></div>
                            @endif                                                            
                        </li>
                        @endforeach
                    @else
                        <li class="product">
                            <div class="productInfo">
                                <div class="productImg">
                                    <img src="{{  asset($ordPro['pImage']) }}" alt="image">
                                </div>
                                <div class="productDescription">
                                    <h6>{{ $ordPro['pName'] }}</h6>
                                    <span>Quantity: <b>x{{ $orderDetailsDB[0]['orderQty'] }}</b></span>
                            @if($ordPro['discount']>0)                                                
                                        <span>Price: <ins>&dollar;{{ App\Helpers\Helper::discountedValue($ordPro['pPrice'], $ordPro['discount'],true) }}</ins> <del>&dollar;{{ $ordPro['pPrice'] }}</del></span>  
                                    </div>
                                </div>
                                <div class="productPrice"><b>&dollar;{{ App\Helpers\Helper::discountedValue($ordPro['pPrice'], $ordPro['discount'],true) }}</b></div>
                            @else                                                
                                        <span>Price: <ins>&dollar;{{ $ordPro['pPrice'] }}</ins></span> 
                                    </div>
                                </div>
                                <div class="productPrice"><b>&dollar;{{ $ordPro['pPrice'] }}</b></div>  
                            @endif                                                            
                        </li>
                    @endif                                                          
                </ul>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="orderSingle__card">
                        <div class="orderSingle__cardTitle">
                            <h4>Billing Address</h4>
                        </div>
                        <div class="orderSingle__address">
                            <address>
                                <?php print $orderData['address'].', '.$orderData['city'].', <br>'.$orderData['country'].', '.$orderData['postalCode'] ?>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="orderSingle__card">
                        <div class="orderSingle__cardTitle">
                            <h4>Shipping Address</h4>
                        </div>
                        <div class="orderSingle__address">                        
                            <address>
                                <?php print $orderData['address'].', '.$orderData['city'].', <br>'.$orderData['country'].', '.$orderData['postalCode'] ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="orderSingle__card">
                <div class="orderSingle__cardTitle">
                    <h4>Order Details</h4>
                </div>
                <ul class="orderSingle__details">
                    <li>
                        <p>Order Date</p> <span>{{ date('d-m-Y', strtotime($orderData['created_at'] )); }} </span>
                    </li>
                    <li>                    
                        <p>Delivery Date</p> <span>{{ date('d-m-Y', strtotime($orderData['deliveryDate']) );   }}</span>
                    </li>
                    <li>
                        @php
                        if ($orderData['status'] == 'Payment Pending') {
                            $status = "pending";
                        } elseif($orderData['status'] == 'Payment Successful'){
                            $status = "delivered";
                        }elseif($orderData['status'] == 'Canceled'){
                            $status = "cancelled";
                        }
                        else {
                            $status = "";
                        }
                        
                    @endphp
                        <p>Order Status</p> <span class="badge {{ $status }}">{{ $orderData['status'] }}</span>                      
                    </li>

                    

                </ul>
            </div>
            <div class="orderSingle__card">
                <div class="orderSingle__cardTitle">
                    <h4>Cart Summary</h4>
                </div>
                <ul class="orderSingle__cartSummary">
                    <li>
                        <p>Subtotal</p> <span>&dollar;{{ $orderData['subTotal'] }}</span>
                    </li>
                    <li>
                        <p>Shipping</p> <span>&dollar;{{ $orderData['shipCharge'] }}</span>
                    </li>
                    {{-- <li>
                        <p>Tax</p> <span>&dollar;{{ $orderData['status'] }}</span>
                    </li> --}}
                    <li class="total">
                        <p>Total</p> <span>&dollar;{{ $orderData['total'] }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection


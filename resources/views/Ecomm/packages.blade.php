@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="body booking-sec">
           
        <section class="bookings-container">
            <h2 style="text-align: center; padding-bottom: 20px;">Book your slots now! </h2>
            <div class="book-line"></div>
            <div class="bookings-wrap">
           
                @foreach ($packages->chunk(3) as $chunkedValue)
                <div class="flex-wrap"> 
                    
                    @foreach ($chunkedValue as $packageValue)
                        <div class="bok-main-wrap">
                            <img src="{{ asset($packageValue->pImage) }}"  class="book-img">
                            <div class="content-slide book-content">
                                <h3 class="s-heading">{{$packageValue->pName}}</h3>
                                    <p class="slide-p"><i class="fa fa-clock-o">{{ $packageValue->noOfDays }} days</i></p>
                                    @php
                                        print($packageValue->pDescription)
                                    @endphp
                                    <p class="slide-p">Price: {{$packageValue->pPrice}}</p>
                                    <p class="slide-p"><i class="fa fa-portrait">Booking Id: {{$packageValue->pBookingId}}</i></p>
                                    <button class="btn"><a href="{{ route('reservation',[$packageValue->pSlug]) }}">CLICK HERE FOR RESERVATION</a></button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
                

               

                
            </div>
        </section>

    </section>
@endsection
@section('js')

@endsection
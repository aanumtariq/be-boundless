@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <div class="contactWrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact">
                        <div class="row">            
                            <div class="col-12 col-lg-4">
                                <div class="contact__content">
                                    <a href="{{ url('index') }} " class="mb-4">
                                        <img src="images/logo.png" alt="image" class="imgFluid">
                                    </a>
                                    <div class="sectionHeading">
                                        <h2>Compare the <span> price</span>, it could save you <span> $$$ </span></h2>
                                        <p>Liked the ring/Jewelry in store or online? Send us pictures or a link. We will send you a quote for the exact same ring/Jewelry with the same diamond.</p>
                                        <ul>
                                            <li>
                                                <div>Step <span> 1</span> </div>
                                                <p>Fill out this inquiry form</p>
                                            </li>
                                            <li>
                                                <div>Step <span> 2</span> </div>
                                                <p>You'll receive a quote on your email within 48 hours.</p>
                                            </li>
                                            <li>
                                                <div>Step <span> 3</span> </div>
                                                <p>Compare the price and Order it.
                                                    <span class="color-primary font-sm">
                                                        Your custom order delivered within 21 business days!!
                                                    </span>
                                                </p>
    
                                            </li>
                                        </ul>
                                        <ul class="socialLinks">
                                            <li><a href="https://www.facebook.com/riviere.jewelry"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/riviere.jewelry/"><i class="fa-brands fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                            <div class=" col-lg-8 col-12 ">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            <form method="POST" action="{{ route('contact-form.storecompare') }}" id="contactUs" class="contact__form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="inputFields">
                                            <label>Name
                                                <input type="text" class="form-control" name="name" placeholder="Full Name">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="inputFields">
                                            <label>E-MAIL
                                                <input type="text" class="form-control" placeholder="Email" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="col-12 col-lg-6">
                                        <div class="inputFields">
                                            <label>Phone <span>(Optional)</span>
                                                <input type="text" class="form-control" placeholder="Phone" name="phone">
                                                <!--@if ($errors->has('phone'))-->
                                                <!--    <span class="text-danger">{{ $errors->first('phone') }}</span>-->
                                                <!--@endif-->
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="inputFields">
                                            <label>LINK<span>(Optional)</span>
                                                <input type="text" class="form-control" name="link">
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="col-12 col-lg-6">
                                        <div class="inputFields">
                                            <label> BUDGET  <span>(Optional)</span>
                                                <input type="text" class="form-control" name="budget">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="inputFields">
                                            <!--<label>Subject<span>(Optional)</span>-->
                                            <!--    <input type="text" class="form-control" placeholder="Subject" name="subject">-->
                                                <!--@if ($errors->has('subject'))-->
                                                <!--    <span class="text-danger">{{ $errors->first('subject') }}</span>-->
                                                <!--@endif-->
                                            <!--</label>-->
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="inputFields">
                                            <label>message<span>(Optional)</span>
                                                <textarea class="form-control hight140" placeholder="Message" name="message" rows="4"></textarea>
                                                <!--@if ($errors->has('message'))-->
                                                <!--    <span class="text-danger">{{ $errors->first('message') }}</span>-->
                                                <!--@endif-->
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 ">
                                        <div class="inputFields inputFields--file">
                                            <h6>ATTACHMENTS</h6>
                                            <label for="file">
                                                <input type="file" id="file" name="file">
                                            </label>
                                            <div>
                                                <span>Add File</span> or Drop files here
                                            </div>
                                        </div>
                                    </div>
                                <button type="submit" class="themeBtn themeBtn--center mt-4 w-45 py-3">Submit </button>
                            </form>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

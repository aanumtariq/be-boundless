@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="body booking-sec">
          
            <section class="sec2">
                <div class="abt-container">
                    
                    <div class="row-div about-div">
                        
                        <div  id="sep-text-abt">
                            <h2 class="sub-head abt ">About Us</h2>
                            <div class="abt-line-2"></div>
                            @php
                                print($about['description'])
                            @endphp                            
                        </div>                      
                    </div>
                </div>
            </section>


          <!----------------------- faq sec start ------------------------>
            <section class="sec6" style="width: 65%;">
                <h2 class="demoHeaders">Frequently Asked Questions:</h2>
                <h3>Booking & Payments:</h3>
                <div id="accordion" class="faq-opt">
                    
                    @foreach ($faqs as $faqAcc )
                        

                    <h3 class="f-name">{{$faqAcc->question   }}</h3>	
                    <div class="f-name">{{ $faqAcc->answer }}</div>
                    

                    @endforeach
                 </div>
            </section>
    </section>
@endsection
@section('js')
<script src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>
    <script>
    $( "#accordion" ).accordion();
</script>
@endsection
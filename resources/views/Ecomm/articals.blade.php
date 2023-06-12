@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <div class="page-bg booking-sec">
       
        <!----------------------- articals sec start ------------------------>
        <section class="full-width sec3 ">
        <div class="abt-container" id="art-sep-page">
            <h2 class="sub-head" >Latest Articals</h2>
            <div class="art-line "></div>
            <div class="row">
                <div class="slider-row">
                    @php
                        $flag = 1;
                    @endphp
                    @forelse ($articals as $articalsValue)

                        <div class="img-div {{ $flag % 2 == 0 ? 'to-move' : '' }}">
                            <img src="{{ asset($articalsValue->bImage) }}" alt="eagle" class="sec3-img">
                            <div class="img-content">
                                <h3 class="art-p">{{ $articalsValue->btitle }}</h3>
                                <span class="divider"></span>
                                <p class="content-para sub-p">{{ $articalsValue->bdiscription }}</p>
                            </div>
                        </div>
                        @php
                            $flag++;
                        @endphp
                    @empty    
                        
                    @endforelse
                </div>
                
            </div>
        </div>
        </section>
    </div>
@endsection
@section('js')

@endsection
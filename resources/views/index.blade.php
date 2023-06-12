@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <main class="full-width main-web">

        <section class="full-width banner ">

            <div class="container">
                <div class="main-div">
                    <div class="div-para">
                    <h4 class="main-sub-head">BE-BOUNDLESS</h4>
                    <div class="line"></div>
                    <h1 class="travel">Travel</h1>
                    <h3 class="main-sub-head main-p" >The inspirational adventures around the Pakistan</h3>
                    </div>
                </div>
            </div>

            <!----------------------- about sec start ------------------------>
            <section class="sec2 ">
                <div class="abt-container">
                    <div class="row-div about-div">
                        <div class="text-abt ">
                            <h2 class="sub-head-abt abt">About Us</h2>
                            <div class="abt-line"></div>
                            @php
                                print($about['short_description'])
                            @endphp
                            <button class="btn"><a href="{{ url('about') }}">READ MORE</a></button>
                        </div>
                        <div class="abt-img">
                        <img src="{{ asset($about['image']) }}" alt="usimg" class="img-in">
                        </div>
                    </div>
                </div>
            </section>

        </section>

        <!----------------------- articals sec start ------------------------>
        <section class="full-width sec3">
            <div class="abt-container">
                <h2 class="sub-head">Latest Articals</h2>
                <div class="art-line "></div>

                <div class="artRow">

                    @php
                        $i = 1
                    @endphp

                    @foreach ($blogs as $articals )    
                        <div class="img-div {{ $i % 2 == 0 ? 'to-move' : ' ' }}">
                            
                                {{-- @dd($blogs); --}}
                                    <img src="{{asset ($articals->bImage)}}" alt="eagle" class="sec3-img"> 
                                    <div class="img-content">
                                        <h3 class="art-p">{{ $articals->btitle }}</h3>
                                        <div class="line-art"></div>
                                        <p class="content-para sub-p">{{ $articals->bcaption }}</p>
                                    </div> 
                        </div>

                    @php
                        $i++;
                    @endphp
                    @endforeach 

                 
                        
                </div>
            </div>
        </section>

        <!----------------------- gallery sec start ------------------------>
        <section class="full-width sec4 ">
            <div class="gallery-container">
                <h2>Gallery</h2>
                <div class="glry-line"></div>
                
                <div  class="massonary-layout  gallery">
                        @foreach ($studios as $img)
                            <div class="massonary-img">
                                {{-- @dd($studios); --}}
                                <img src="{{ asset($img->orgImg)}}" class="g-img">
                            </div>
                        @endforeach

                </div>
            </div>
            
        </section>

        <!----------------------- form sec start ------------------------>
        <section id="sec5" class="full-width ">
            <div class="con-container">
                <div class="row-div">
                    <div class="abt-img">
                        <img src="{{ asset('images/book.png')}}" alt="usimg" class="img-form">
                        </div>
                    <div class="text-abt">
                        <h2 class="sub-head-con">Contact</h2>
                        <div class="con-line"></div>
                         @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            </div>
                        @endif
                        <form method="POST" action="{{ route('contact-form.store') }}" id="contactUs" class="contact-form">
                            @csrf
                            <div class="half">
                                <label class="label f-name" >Name:</label>
                                <input type="text"  class="field" name="name" id="name"  required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            
                            <span class="divider"></span>
                            <div class="right-half">
                                <label class="label f-name">Email:</label>
                                <input type="email" class="field"  name="email" id="email" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <span class="divider"></span>
                            <div class="half">
                                <label class="label f-name" >Phone:</label>
                                <input type="number" class="field" name="phone" id="phone" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            
                            <span class="divider"></span>
                            <div class="right-half">
                                <label class="label f-name">Subject:</label>
                                <input type="text" class="field"  name="subject" id="subject" required>
                                @if ($errors->has('subject'))
                                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>

                            <span class="divider"></span>
                            <div class="full">
                                <label class="label message f-name">Message:</label>
                                <textarea name="message" id="message" class="field msgBox" required></textarea>
                            </div>
                            <span class="divider"></span>
                            <div class="full">
                                <button class="btn" type="submit">SEND MESSAGE</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>       

    </main>
@endsection
@section('js')
    <script>
        $(document).on('submit', '#contactUs', function(e) {
            e.preventDefault();
            var _thisForm = $(this);
            var validationAllowed = true;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: $(this).attr('method'),
                data: formData,
                async: true,
                contentType: false,
                processData: false,
                url: $(this).attr('action'),
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr(
                        'content'));
                },
                success: function(result) {
                    
                    if (result['status'] == 'success') {
                         generateNotification('1', 'We have recieved your query');
                        $('#contactUs')[0].reset();
                    } else {
                        $('#contactUs')[0].reset();
                    }
                },
                error: function(error) {
                    generateNotification('0', 'Some Error Occured');
                }
            });
            return false;
        });
    </script>
@endsection
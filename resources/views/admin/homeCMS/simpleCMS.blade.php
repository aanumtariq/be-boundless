@extends('admin.layouts.master')
@section('content')
<section class="content">   
    <div class="card">
        <div class="card-body">           
            <button style="width: 120px;" class="btn btn-success btn--action" data-placement="left" title="Save Changes" data-toggle="tooltip" onclick="$('#addAboutForm').submit()" >Update</button>            
            <div class="container-fluid">                              
            <?php $data = DB::table($tableName)->get(); ?>
			@if($data)
                <form class="row" action="{{ route('admin.'.$tableName) }}" method="POST" enctype="multipart/form-data" id="addAboutForm">  
                    @csrf
                    <div class="col-md-12">      
                        <div class="row">                      
                        @foreach($data as $itemsKey => $items)
                            
                                <div class="{{ $items->var_readonly == 1 || $items->is_banner == 1 ? 'col-sm-12 col-md-12' : (($items->has_image == 1) || ($items->is_video == 1) ? 'col-sm-3 col-md-3' : 'col-sm-6 col-md-6') }}">
                                    <div class="form-group">                                         
                                        @if ($items->var_readonly == 0)    
                                        <label for="form-field-6"> {{$items->var_show_text}}</label>                            
                                            @if ($items->is_editor == 1)

                                                <textarea name="{{$items->var_text}}" id="descripton_{{ $items->var_text }}" class="form-control descripton_{{ $items->var_text }} textarea-autosize">{{$items->var_value}}</textarea>
                                                <i class="form-group__bar"></i>                                      

                                            @elseif($items->is_video == 1)                                                                                            
                                                <div class="imgUp_{{ $items->var_text }} imgUp">
                                                    <div class="imagePreview">
                                                        <video width="100%" height="250px" id="video_{{ $items->var_text }}" src="{{$items->var_value}}" controls></video>
                                                    </div>
                                                    <label class="btn btn-warning displayImgBtn">Add Video
                                                        <input id="file_{{ $items->var_text }}" name="is_video-{{$items->var_text}}" type="file" value="{{$items->var_value}}" class="form-control {{$items->var_text}}" accept="video/mp4,video/mkv, video/x-m4v,video/*" style="width: 0px;height: 0px;overflow: hidden;">
                                                    </label>
                                                </div>
                                            @elseif($items->has_image == 1)
                                                <div class="imgUp_{{ $items->var_text }} imgUp">
                                                    <div class="imagePreview_{{ $items->var_text }} imagePreview" style="background-image:url(../{{$items->var_value}})">
                                                        <input type="hidden" id="pDisplayImg" name="" value="">
                                                    </div>
                                                    <label class="btn btn-secondary displayImgBtn">Add
                                                        <input type="file" id="{{$items->var_text}}" class="uploadFile_{{ $items->var_text }} img" value="Upload Image" name="is_image-{{$items->var_text}}" style="width: 0px;height: 0px;overflow: hidden;" >
                                                    </label>
                                                </div> 
                                            @elseif($items->is_banner == 1)

                                                <div class="imgUp_{{ $items->var_text }} imgUp">
                                                    <div class="imagePreview_{{ $items->var_text }} imagePreview" style="background-image:url(../{{$items->var_value}})">
                                                        <input type="hidden" id="pDisplayImg" name="" value="">
                                                    </div>
                                                    <label class="btn btn-secondary displayImgBtn">Add
                                                        <input type="file" id="{{$items->var_text}}" class="uploadFile_{{ $items->var_text }} img" value="Upload Image" name="is_banner-{{$items->var_text}}" style="width: 0px;height: 0px;overflow: hidden;" >
                                                    </label>
                                                </div> 

                                            @else

                                                <input name="{{$items->var_text}}" type="text" value="{{$items->var_value}}" class="form-control {{$items->var_text}}" placeholder="" >
                                                <i class="form-group__bar"></i>  

                                            @endif
                                        @else
                                           
                                            <div class="row" style="margin-bottom:5rem;">
                                                <div class="col-12 hSeperator">
                                                    <span>{{$items->var_show_text}}</span>
                                                </div>
                                            </div>  
                                        @endif                                                                    
                                    </div>  
                                </div>                                                     
                           
                        @endforeach     
                    </div>                                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-success float-right" value="Update" />
                                </div>
                            </div>
                        </div>                                                               
                    </div>
                </form>  
                @endif
            </div>           
        </div>
    </div>    
</section>
@endsection   
@section('js')
<script src="{{asset('admin/vendors/summernote/summernote.min.js')}}"></script>
@php
	$editor_data =  DB::table($tableName)->where('is_editor', 1)->get();
@endphp
@if ($editor_data)
    @foreach ($editor_data as $dataKey => $editor_item)
        <script> 
            $(document).ready(function() {
                $("#descripton_{{ $editor_item->var_text }}").summernote({
                placeholder: "Write description.....",
                    tabsize: 2,        
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['codeview']],
                    ]
                });
            });
        </script>
    @endforeach
@endif


@php
	$image_data = DB::table($tableName)->where('has_image', 1)->orWhere('is_banner', 1)->get();
@endphp
@if ($image_data)
    @foreach ($image_data as $imageKey => $image_item)         
        <script type="text/javascript">
            $(function() {
                $(document).on("change",".uploadFile_{{ $image_item->var_text }}", function()
                {
                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return;
                    if (/^image/.test( files[0].type)){ 
                        var reader = new FileReader();
                        reader.readAsDataURL(files[0]);
                        reader.onloadend = function(){                
                            uploadFile.closest(".imgUp_{{ $image_item->var_text }}").find('.imagePreview_{{ $image_item->var_text }}').css("background-image", "url("+this.result+")");
                            uploadFile.closest(".imgUp_{{ $image_item->var_text }}").find('.imagePreview_{{ $image_item->var_text }}').css("background-size", "contain");
                        }
                    }    
                });
            });
        </script>

    @endforeach
@endif
@php
	$image_data = DB::table($tableName)->where('is_video', 1)->get();
@endphp
@if ($image_data)
    @foreach ($image_data as $imageKey => $image_item)  
        <script type="text/javascript">
            const inputFile = document.getElementById("file_{{ $image_item->var_text }}");
            const video = document.getElementById("video_{{ $image_item->var_text }}");
            inputFile.addEventListener("change", function(){
                const file = inputFile.files[0];
                const videourl = URL.createObjectURL(file);
                video.setAttribute("src", videourl);
                video.play();
            })
        </script>       
    @endforeach
@endif
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}"> 
<link rel="stylesheet" href="{{asset('admin/vendors/summernote/summernote.min.css')}}">
 <style>
.hSeperator{
        width: 100%; 
        height: 20px; 
        border-bottom: 10px solid #eceff1; 
        text-align: center;
    }
    .hSeperator > span{
        font-size: 20px; 
        background-color: #FFF; 
        padding: 0 10px;
    }

 </style>

        <style>
        .imagePreview {
            width: 100%;
            height: 250px;
            background-position: center center;    
            background-color:transparent;
            background-size: contain;
            background-repeat:no-repeat;
            display: inline-block;
            box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
        }
        .displayImgBtn
        {
        display:block;
        border-radius:0px;
        box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
        margin-top:-5px;
        }
        .imgUp
        {
        margin-bottom:15px;
        }

        </style>
   
@endsection
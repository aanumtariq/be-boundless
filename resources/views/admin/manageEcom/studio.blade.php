@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/nouislider/nouislider.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/trumbowyg/ui/trumbowyg.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/vendors/rateyo/jquery.rateyo.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/demo/css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
<link rel="stylesheet" href="{{asset('admin/vendors/summernote/summernote.min.css')}}">
<style>
.dropzoneDragArea {
		    background-color: #fbfdff;
		    border: 1px dashed #c0ccda;
		    border-radius: 6px;
		    padding: 60px;
		    text-align: center;
		    margin-bottom: 15px;
		    cursor: pointer;
		}
		.dropzone{
			box-shadow: 0px 2px 20px 0px #f2f2f2;
			border-radius: 10px;
		}

        .imagePreview {
    width: 100%;
    height: 300px;
    background-position: center center;
  background-image:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
  background-color:#fff;
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

button.btn.zmdi.zmdi-delete.delMStud {
    float: right;
    font-size: 1.4rem;
    color: #a9adb1;
    margin-top: 1rem;
    border-bottom: 1px solid #eceff1 !important;
    padding: 5px;
}

</style>
@endsection
@section('content')


<section class="content">
    <header class="content__title">
        <h1>Gallery</h1>        
    </header>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Gallery
                
            </h2>
            <h6 class="card-subtitle">All Images</h6>    
            
            {{-- <button data-toggle="tooltip" data-placement="left" title="Sort Records" style="right: 90px !important;" class="btn btn-info btn--action sortrecord"><i class="zmdi zmdi-sort-asc zmdi-hc-fw"></i></button> --}}
            <button class="btn btn-danger btn--action zmdi zmdi-plus btnAddStud" data-placement="left" onclick="formReset('Add Studio', 'false')" title="Add New Studio"  data-toggle="modal" data-target="#addStudio" ></button>
            {{-- <a href="{{ route('CRUDStudio') }}"><button class="btn btn-danger btn--action zmdi zmdi-plus btnAddStud" data-placement="left" onclick="formReset('Add Studio', 'false')" title="Add New Studio" ></button></a> --}}
            {{-- Table Content Start --}}
            <div class="table-responsive">
                <a onclick="delMStud()">
                    <button class="btn zmdi zmdi-delete delMStud" data-toggle="tooltip" title="Delete Images" ></button>
                </a>
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>Del Multiple</th>
                            <th>S no</th>
                            <th>Image</th>                           
                            <th>Active</th>
                            <th>Feature</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Del Multiple</th>
                            <th>S no</th>
                            <th>Image</th>                           
                            <th>Active</th>
                            <th>Feature</th>                            
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $n = 1;
                        foreach ($studio as $i => $studItem)     {                           
                            if ($studItem['sActive'] == 1 && $studItem['sFeatured'] == 0)
                               { 
                                   $studActive = 'checked data-original-title=Yes';  
                                   $studFeatured = ' data-original-title=No';                
                            
                                }
                            else if ($studItem['sActive'] == 0 && $studItem['sFeatured'] == 1)
                               { 
                                $studFeatured = 'checked data-original-title=Yes';  
                                   $studActive = ' data-original-title=No';                  
                                }
                            else if ($studItem['sActive'] == 1 && $studItem['sFeatured'] == 1)
                               { 
                                $studActive = 'checked data-original-title=Yes';  
                                   $studFeatured = 'checked data-original-title=Yes';                 
                                }                              
                            else
                                {
                                    $studActive = ' data-original-title=No';                                  
                                   $studFeatured = ' data-original-title=No'; 
                                }
                           ?>                                                             
                            <tr id="studrow">
                                <td><input type="checkbox" class="delStudCheck" name="[{{ $studItem['Id'] }}]" value="{{ $studItem['Id'] }}" id="{{ $studItem['Id'] }}"></td>
                                <td>{{ $studItem['Id'] }}</td>
                                <td>
                                    <img src="../{{ $studItem['thumb'] }}" alt="" style="width: 50px; height:60px;">
                                </td>                                                                                                
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" data-column="is_active" id="studActCheckBox{{ $studItem['Id'] }}" class="toggle-switch__checkbox" onclick="studActChecked({{ $studItem['Id'] }})" data-toggle="tooltip" title=""  {{ $studActive }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" data-column="is_featured" id="studFeatCheckBox{{ $studItem['Id'] }}" class="toggle-switch__checkbox" onclick="studFeatChecked({{ $studItem['Id'] }})" data-toggle="tooltip" title="" {{ $studFeatured }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>
                                <td>
                                    <button data-toggle="tooltip" id="studEdit" class="btn btn-outline-success btn--icon" onclick="editStud({{ $studItem['Id'] }})" data-placement="top" title="" data-original-title="Edit Record">
                                        <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                    </button>
                                    {{-- <a href="{{ route('CRUDstudGetEdit',[$studItem['Id']]) }}">
                                        <button data-toggle="tooltip" id="studEdit" class="btn btn-outline-success btn--icon" data-placement="top" title="" data-original-title="Edit Record">
                                            <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                        </button>
                                    </a> --}}
                                    <button data-toggle="tooltip" id="studView" class="btn btn-outline-info btn--icon" onclick="viewStud({{ $studItem['Id'] }})" data-placement="top" title="" data-original-title="View Record">
                                        <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                                    </button>
                                    <button data-toggle="tooltip" id="studDelete" class="btn btn-outline-danger btn--icon" onclick="delStud({{ $studItem['Id'] }})" data-placement="top" title="" data-original-title="Delete Record">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $n += 1; }?>                           
                    </tbody>
                </table>
            </div>
            {{-- Table Content End --}}
        </div>
    </div>    
</section>

{{-- Add Model --}}
<div class="modal fade" id="addStudio" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left modalTitle">Add Studio</h5>
                <h5 class="modal-title pull-right">
                    <a href="javascript:void(0)" data-dismiss="modal" onclick="formReset('Add Studio', 'false')" >
                    <i class="zmdi zmdi-close zmdi-hc-fw"></i>
                </a>
            </h5>
            </div>
            <div class="modal-body">
                <form name='addStudioForm' class="CrudForm row" data-nosubmit="true" method="POST" data-noinfo="true" id="addStudioForm">
                    @csrf
                    <div class="col-sm-12 col-md-12">

                        <input type="hidden" class="studId" name="studId" id="studId" value="">  
                        <input type="hidden" class="formType" name="formType" id="formType" value="add">  
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group"> 
                                    <label>Upload Single:</label>
                                    <div class="imgUp">
                                        <div class="imagePreview">
                                            <input type="hidden" id="pDisplayImg" name="pDisplayImg" value="">
                                        </div>
                                        <label class="btn btn-secondary displayImgBtn">Add
                                            <input type="file" id="studDisplayImg" class="uploadFile img" value="Upload Photo" name="studDisplayImg" style="width: 0px;height: 0px;overflow: hidden;" >
                                        </label>
                                    </div>                                   
                                </div>
                            </div> 
                        </div>
                        <div class="row" >
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group"> 
                                    <label for="dropzoneDragArea2">Upload Multiple:</label>
                                    <div class="dropzone dropzoneDragArea" id="dropzoneDragArea2">
                                        <div class="dz-default dz-message">
                                            <span>Upload Studio Image</span>
                                        </div>                                        
                                        <div class="dropzone-preview"></div>
                                    </div>                                  
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">        
                                            <div class="checkbox">            
                                                <input type="checkbox" name="addStudCheck" class="addStudCheck" id="addStudCheck">            
                                                <label class="checkbox__label" for="addStudCheck">                
                                                    Is Active?            
                                                </label>        
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">        
                                            <div class="checkbox">            
                                                <input type="checkbox" name="addStudFeaCheck" class="addStudFeaCheck" id="addStudFeaCheck">            
                                                <label class="checkbox__label" for="addStudFeaCheck">                
                                                    Featured?            
                                                </label>        
                                            </div>    
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <input style="float: right" type="submit" class="btn btn-outline-success" id="addStudioFormSubmit" value='Add Studio'>                                                                              
                    </div> 
                   
                </form>      
            </div>           
        </div>
    </div>
</div>

@endsection   
@section('js')
<!-- Vendors: Data tables -->
<script src="{{ asset('admin/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('admin/vendors/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
<script src="{{ asset('admin/vendors/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('admin/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendors/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('admin/vendors/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/vendors/rateyo/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jquery-text-counter/textcounter.min.js') }}"></script>
<script src="{{ asset('admin/vendors/autosize/autosize.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>    
<script type="text/javascript">
var count= 0;

function delMStud() {         
    var delMStudId = new Array();
    $("input:checkbox[class=delStudCheck]:checked").each(function(){
        delMStudId.push($(this).val());
    });
    console.log(delMStudId);
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",     
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
            url: "{{ route('delMStud') }}",
            type: "post",
            data: {
                ids: delMStudId
            },
            success: function(data) {
                swal({
                    title: 'Success',
                    text: 'Studduct Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){                       
                        location.reload();
                        });                                    
                },error: function(params) {
                                console.log(params);
                            }             
            });
            }
            else{
                swal({
                title: "Cancelled",
                text: "Your data is safe",
                type: "error",
                timer: 1000,
                showConfirmButton: false                 
                });
            }
        });            
}


function formReset(title, visibility) {  
    $('#formType').val('');
    if (visibility == 'true') {
        $('#addStudioFormSubmit').attr('hidden', visibility);
    } else {
        $('#addStudioFormSubmit').attr('hidden', 'false');
        $('#addStudioFormSubmit').removeAttr("hidden");
    }
    $('.modalTitle').html(title);
    $('#addStudioFormSubmit').val(title);        
    $('#addStudioForm')[0].reset();     
    $('.dropzone-preview').empty();
    var myDropzone =  Dropzone.forElement("div#dropzoneDragArea2");     
    myDropzone.removeAllFiles(true);
    $(".imagePreview").removeAttr("style");
    count= 0;
}

function studActChecked(id){
    var studActive;    
    if(document.getElementById("studActCheckBox"+id).checked == true)
    {
        $("#studActCheckBox"+id).attr('data-original-title', 'Yes');
        studActive = 1;       
    }
    else{
        $("#studActCheckBox"+id).attr('data-original-title', 'No');
        studActive = 0;        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/admin/studActive',
        method: 'post',               
        data: {
            studId : id,
        studActive : studActive                 
        },
        success: function(result){ 
            if (studActive == 1) 
            {
                swal({
                title: 'Success',
                text: 'Studio Activated',
                type: 'success',
                timer: 1000,
                showConfirmButton: false                           
            });
            } else 
            {
                swal({
                title: 'Success',
                text: 'Studio Deactivated',
                type: 'info',
                timer: 1000,
                showConfirmButton: false                         
            });
            }                   
                    
        },error: function(params) {
                    console.log(params);
                }            
        });
}

function studFeatChecked(id){
    var studFeatured;    
    if(document.getElementById("studFeatCheckBox"+id).checked == true)
    {
        $("#studFeatCheckBox"+id).attr('data-original-title', 'Yes');
        studFeatured = 1;       
    }
    else{
        $("#studFeatCheckBox"+id).attr('data-original-title', 'No');
        studFeatured = 0;        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/admin/studFeatured',
        method: 'post',               
        data: {
            studId : id,
        studFeatured : studFeatured                 
        },
        success: function(result){ 
            if (studFeatured == 1) 
            {
                swal({
                title: 'Success',
                text: 'Studio Featured',
                type: 'success',
                timer: 1000,
                showConfirmButton: false                           
            });
            } else 
            {
                swal({
                title: 'Success',
                text: 'Studio Removed From Featured',
                type: 'info',
                timer: 1000,
                showConfirmButton: false                         
            });
            }                   
                    
        },error: function(params) {
                                console.log(params);
                            }            
        });
}

function delStud(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",     
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
            url: "/admin/studDel",
            type: "post",
            data: {
                deleteStudio: id
            },
            success: function(data) {

                swal({
                    title: 'Success',
                    text: 'Studio Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        $( "tbody" ).load( "studio #studrow" );
                        location.reload();
                        });                                    
                },error: function(params) {
                                console.log(params);
                            }             
            });
            }
            else{
                swal({
        title: "Cancelled",
        text: "Your data is safe",
        type: "error",
        timer: 1000,
        showConfirmButton: false                 
        });
            }
        });                           
}

function editStud(id) {
    $(".page-loader").show();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/studGetEdit",
        type: "post",
        data: {
            getStudId : id
        },
        success: function(data) {
            formReset('Update Studio', 'false');
            console.log(data);   
            document.getElementById('studId').value = data.studData['Id'];
            document.getElementById('formType').value = 'update';                 
            if (data.studData['sActive'] == 1 && data.studData['sFeatured'] == 0)
                { 
                    document.getElementById('addStudCheck').checked = true;
                    document.getElementById('addStudFeaCheck').checked = false;            
                }
            else if (data.studData['sActive'] == 0 && data.studData['sFeatured'] == 1)
                { 
                    document.getElementById('addStudCheck').checked = false;
                    document.getElementById('addStudFeaCheck').checked = true;
                }
            else if (data.studData['sActive'] == 1 && data.studData['sFeatured'] == 1)
                { 
                    document.getElementById('addStudCheck').checked = true;
                    document.getElementById('addStudFeaCheck').checked = true;
                }                              
            else
                {
                    document.getElementById('addStudCheck').checked = false;
                    document.getElementById('addStudFeaCheck').checked = false;
                }
            $('.imagePreview').css("background-image", "url(../"+data.studData['sImage']+")");
            $('#pDisplayImg').val(data.studData['sImage']);                      
                                                             
                // var iName = /[^/]*$/.exec(data.studData['sImage']);                 
                // var iPath = '../'+data.studData['sImage'];                                              
                // var file = new File([iPath], iName)
                // file['status'] = "queued";
                // file['status'] = "queued";
                // file['previewElement'] = "div.dz-preview.dz-image-preview";
                // file['previewTemplate'] = "div.dz-preview.dz-image-preview";
                // file['_removeLink'] = "a.dz-remove"+data.studData['Id'];
                // file['webkitRelativePath'] = "";
                // file['width'] = 120;
                // file['height'] = 120;
                // file['accepted'] = true;
                // file['dataURL'] = iPath;
                // file['upload'] = {
                //     bytesSent: 0 ,
                //     filename: iName ,
                //     studgress: 0 ,                           
                // };    
                // Dropzone.autoDiscover = false;            
                // var myDropzone =  Dropzone.forElement("div#dropzoneDragArea2");     
                // myDropzone.addRemoveLinks = true;
	            // myDropzone.autoStudcessQueue = false;                
                // myDropzone.emit("addedfile", file , iPath);
                // myDropzone.emit("thumbnail", file , iPath);                
                // myDropzone.files.push(file);         
                // $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                // let s = $('.dz-image').last().find('img').attr('src');                
                // let result = s.split(/[.-]/).pop();
                // console.log(result);
                // if (result.toUpperCase() == "JPG" || result.toUpperCase() == "JPEG" || result.toUpperCase() == "PNG") {
                       
                // }
                // else{
                //         $('.dz-image').last().find('img').attr('id','dzz-video');
                //     let element = document.getElementById("dzz-video");
                //     element.outerHTML = element.outerHTML.replace(/img/g,"video");               
                // }
                // $('a.dz-remove').attr('onclick', 'sImagesRemove(this)');
                // count = myDropzone.files.length; 
                                                                          
            $('#addStudio').modal('show');     
            $(".page-loader").fadeOut();       
        },error: function(params) {
            console.log(params);
        }            
    });      
}

function sImagesRemove(tag){
    let studId = $('#studId').val();
    console.log(studId);        
    if (tag.parentElement.querySelector(".dz-image img")) {
        var removeURL = $(tag).parent('.dz-preview').children('.dz-image').children('img').attr('src');
    } else {        
        // const thumbnailParent = tag.parentElement;
        // const videoSrc = thumbnailParent.querySelector(".dz-image video").src;
        // console.log("video source",videoSrc);
        // var removeURL = videoSrc;
        var removeURL = $(tag).parent('.dz-preview').children('.dz-image').children('#dzz-video').attr('src');
    }  
    console.log(removeURL);
    var remURL = removeURL.substring(removeURL.indexOf("/") + 1);   
    console.log(remURL);
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",     
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
            url: "/admin/imgDelStud",
            type: "post",
            data: {
                imgRemoveURL: remURL
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: 'Success',
                    text: 'Studio Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    })                 
                    $('#addStudio').modal('hide');      
                    location.reload();
                },error: function(params) {
                                console.log(params);
                            }             
            });
            }
            else{
                swal({
                    title: "Cancelled",
                    text: "Your data is safe",
                    type: "error",
                    timer: 1000,
                    showConfirmButton: false                 
                    });
                  
                    $('#addStudio').modal('hide');  
                    editStud(studId);
            }
        });          
}

function viewStud(id) { 
    $(".page-loader").show();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/studGetEdit",
        type: "post",
        data: {
            getStudId : id
        },
        success: function(data) {
            formReset('Studio Details', 'true');
            console.log(data);                    
            document.getElementById('studId').value = data.studData['Id'];
            document.getElementById('formType').value = 'veiw';
            if (data.studData['sActive'] == 1 && data.studData['sFeatured'] == 0)
                { 
                    document.getElementById('addStudCheck').checked = true;
                    document.getElementById('addStudFeaCheck').checked = false;            
                }
            else if (data.studData['sActive'] == 0 && data.studData['sFeatured'] == 1)
                { 
                    document.getElementById('addStudCheck').checked = false;
                    document.getElementById('addStudFeaCheck').checked = true;
                }
            else if (data.studData['sActive'] == 1 && data.studData['sFeatured'] == 1)
                { 
                    document.getElementById('addStudCheck').checked = true;
                    document.getElementById('addStudFeaCheck').checked = true;
                }                              
            else
                {
                    document.getElementById('addStudCheck').checked = false;
                    document.getElementById('addStudFeaCheck').checked = false;
                }
            $('.imagePreview').css("background-image", "url(../"+data.studData['sImage']+")");    
         
                                                          
                var iName = /[^/]*$/.exec(data.studData['sImage']);                 
                var iPath = '../'+data.studData['sImage'];                                              
                var file = new File([iPath], iName)
                file['status'] = "queued";
                file['status'] = "queued";
                file['previewElement'] = "div.dz-preview.dz-image-preview";
                file['previewTemplate'] = "div.dz-preview.dz-image-preview";
                file['_removeLink'] = "a.dz-remove";
                file['webkitRelativePath'] = "";
                file['width'] = 120;
                file['height'] = 120;
                file['accepted'] = true;
                file['dataURL'] = iPath;
                file['upload'] = {
                    bytesSent: 0 ,
                    filename: iName ,
                    studgress: 0 ,                           
                };                
                var myDropzone =  Dropzone.forElement("div#dropzoneDragArea2");                           
                myDropzone.emit("addedfile", file , iPath);
                myDropzone.emit("thumbnail", file , iPath);                
                myDropzone.files.push(file);                          
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                let s = $('.dz-image').last().find('img').attr('src');                
                let result = s.split(/[.;+-_]/).pop();
                console.log(result);
                if ( result == "jpg" || result == "jpeg" || result == "png") {
                   
                } 
                else{
                     $('.dz-image').last().find('img').attr('id','dzz-video');
                    let element = document.getElementById("dzz-video");
                    element.outerHTML = element.outerHTML.replace(/img/g,"video");
                    $('#dzz-video').attr('controls',true);
                }              
                $('.dz-image').css("width", 200);
                $('.dz-image').css("height", 200);
                $('.dz-studgress').css("display", "none");
                              
            $('#addStudio').modal('show');     
            $(".page-loader").fadeOut();        
        },error: function(params) {
            console.log(params);
        }            
    });   
}

$(function() {
    $(document).on("change",".uploadFile", function()
    {
    	var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
        if (/^image/.test( files[0].type)){ 
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){                
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }    
    });   
});

Dropzone.autoDiscover = false;
let token = $('meta[name="csrf-token"]').attr('content');
$(function() {
var myDropzone = new Dropzone("div#dropzoneDragArea2", { 
	paramName: "studioImages",
    previewsContainer: 'div.dropzone-preview',
	url: "/admin/storeStudImgaes",
	addRemoveLinks: true,
	autoStudcessQueue: false,
	uploadMultiple: false,
    parallelUploads: 1,	   
	params: {
        _token: token
    },
   //  The setting up of the dropzone
	init: function() {
	    var myDropzone = this;
	    //form submission code goes here
	    $("#addStudioForm").submit(function(event) {	    	
	    	event.preventDefault();	    		    
            var form = $('#addStudioForm')[0];
            var formData = new FormData(form);                                     
	    	$.ajax({	    		
	    		url: "{{ route('addStudio') }}",
                method: 'post',	    		 
                processData: false,    
                cache: false,                               
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                studcessData: false, // NEEDED, DON'T OMIT THIS     
                data : formData,         
	    		success: function(result){                   
                   if(result.status == "success"){
	    			console.log(result);
	    				var studId = result.stud_id;
						$("#studId").val(studId); 
                        $("#formType").val(result.formType);
                        var i = 0;                                           
                        if (myDropzone.files.length > count) {
                            myDropzone.studcessQueue();
                        } else {                        
                            swal({
                        title: 'Success',
                        text: 'Successfull',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: false     
                        }).then(function(){
                            $( "tbody" ).load( "studio #studrow" );
                            $('#addStudio').modal('hide');

                            }); 
                        }	    				                      
	    			}else{
	    				console.log(result);
	    			}
	    		},error: function(params) {
                                console.log(params);
                            } 
	    	});
	    });
        this.on("studcessing", function() {
            this.options.autoStudcessQueue = true;
        });
        var i = 0;
	    
		
	    this.on("success", function (file, response) {          
            $('#addStudioForm')[0].reset();           
            $('.dropzone-preview').empty();
            $( "tbody" ).load( "studio #studrow" );        
            i = parseInt(response.i);
            $('#addStudio').modal('hide');   
            console.log('Success:     Response'+JSON.stringify(response));
        });
    
        this.on('sending', function(file, xhr, formData){	   
	      let studId = document.getElementById('studId').value;
          let formType = document.getElementById('formType').value;          
		   formData.append('studId', studId);
           formData.append('i', i);      
		});
        this.on("error", function(files, response) {	    
          console.log('Error: '+files+'/n    Response'+JSON.stringify(response));
	    });

        this.on("queuecomplete", function () {
		
        });		
       
	    this.on("sendingmultiple", function(file, xhr, formData) {	  
          let studId = document.getElementById('studId').value;
          let formType = document.getElementById('formType').value;          
		   formData.append('studId', studId);
           formData.append('i', i);
	    });
		
	    this.on("successmultiple", function(files, response) {
            $('#addStudioForm')[0].reset();           
            $('.dropzone-preview').empty();
            $( "tbody" ).load( "studio #studrow" );        
            i = parseInt(response.i);
            $('#addStudio').modal('hide');   
            console.log('Success:     Response'+JSON.stringify(response));
	    });
		
	    this.on("errormultiple", function(files, response) {
	    
          console.log('Error: '+files+'/n    Response'+JSON.stringify(response));
	    });
	}
	});
});
</script>
@endsection
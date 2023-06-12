@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/select2/css/select2.min.css') }}">
 <!-- Demo only -->
 <link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/css/simple-tags.min.css') }}">
 <link rel="stylesheet" href="{{asset('admin/vendors/summernote/summernote.min.css')}}">
<style>
    .imagePreview {
    width: 100%;
    height: 300px;
    background-position: center center;
  background-image:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
  background-color:#fff;
    background-size: cover;
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

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border:1px transparent !important;
   
}

.select2-container--default .select2-selection--multiple {    
    border:1px transparent !important;
 
}

.imagePreviewEdit {
    width: 100%;
    height: 300px;
    background-position: center center;
  background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
  background-color:#fff;
    background-size: cover;
  background-repeat:no-repeat;
    display: inline-block;
  box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
}
.displayImgBtnEdit
{
  display:block;
  border-radius:0px;
  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
  margin-top:-5px;
}
.imgUpEdit
{
  margin-bottom:15px;
}
</style>
@endsection
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Blogs</h1>
        <div class="actions">            
            <div class="dropdown actions__item">
                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">Refresh</a>
                    <a href="#" class="dropdown-item">Manage Widgets</a>
                    <a href="#" class="dropdown-item">Settings</a>
                </div>
            </div>
        </div>
    </header>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All Blogs</h2>                    
            {{-- <button data-toggle="tooltip" data-placement="left" title="Sort Records" style="right: 90px !important;" class="btn btn-info btn--action ytable-sortrecord"><i class="zmdi zmdi-sort-asc zmdi-hc-fw"></i></button> --}}
            <button class="btn btn-danger btn--action zmdi zmdi-plus ytable-addrecord" data-placement="left" title="Add New Record" data-toggle="modal" onclick="formReset('Add Blog')" data-target="#addBlog" ></button>
            {{-- Table Content Start --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>Date Posted</th>                         
                            <th>Image</th> 
                            <th>Title</th> 
                            <th>Caption</th>
                            <th>Feature</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date Posted</th>                         
                            <th>Image</th> 
                            <th>Title</th> 
                            <th>Caption</th>
                            <th>Feature</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>                      
                        @foreach ($blogs as $blogItem)      
                        <?php
                            if ($blogItem['bFeatured'] == 0)
                               {                                
                                   $blogFeatured = ' data-original-title=No';                                            
                                }                                                                                 
                            else
                                { 
                                    $blogFeatured = 'checked data-original-title=Yes';                                   
                                }
                           ?>   
                            <tr id="blogrow">
                                <td>{{ $blogItem['created_at'] }}</td>                                  
                                <td>
                                    <img src="../{{ $blogItem['bImage'] }}" alt="" style="width: 50px; height:60px;">
                                </td>                          
                                <td>{{ $blogItem['btitle'] }}</td>    
                                <td>{{ $blogItem['bcaption'] }}</td> 
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" data-column="is_featured" id="blogFeatCheckBox{{ $blogItem['Id'] }}" class="toggle-switch__checkbox" onclick="blogFeatChecked({{ $blogItem['Id'] }})" data-toggle="tooltip" title="" {{ $blogFeatured }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>                                                  
                                <td>
                                    <button data-toggle="tooltip" id="edit" class="btn btn-outline-success btn--icon" title="" onclick="editBlog({{ $blogItem['Id'] }});" data-original-title="Edit Record">
                                        <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                    </button>                                 
                                    <button data-toggle="tooltip" id="delete" name="{{ $blogItem['Id'] }}" class="btn btn-outline-danger btn--icon"  title="" onclick="delblog({{ $blogItem['Id'] }});" data-original-title="Delete Record">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </button>
                                    <script>
                                        
                                    </script>
                                </td>
                            </tr>                           
                        @endforeach             
                    </tbody>
                </table>
            </div>
            {{-- Table Content End --}}
        </div>
    </div>    
</section>

<!--Modal -->
<div class="modal fade" id="addBlog" role="dialog">    
    <div class="modal-dialog modal-lg">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title text-center modalTitle">Add Blog</h2>          
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="modal-body">
          <!--Modal body start-->  
              <!-- Begin Page Content -->
              <div class="container-fluid">  
              <!-- Model Content -->                              
                <form class="row" id="addBlogForm">  
                    <div class="col-md-12">                                                                                             
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group"> 
                                    <label>Title</label>  
                                    <input type="hidden" id="bId" name="bId">
                                    <input type="hidden" id="formType" name="formType">
                                        <input name="blogName" type="text" class="form-control blogName" placeholder="" >
                                        <i class="form-group__bar"></i>                                                    
                                </div>  
                            </div>                                                    
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">          
                                    <label>Caption</label>                                                                                                                
                                    <textarea name="caption" id="caption" class="form-control caption textarea-autosize" placeholder="" ></textarea>
                                    <i class="form-group__bar"></i>                                               
                                </div>                                                                 
                            </div>
                            <div class="col-sm-6 col-md-6">                                                            
                                <div class="form-group">    
                                    <label>Add Tags</label>       
                                    <div
                                        id="simple-tag"
                                        class="simple-tags"
                                        name="simple-tag"
                                        data-simple-tags="tags" >
                                    </div>
                                    <i class="form-group__bar"></i>   
                                </div>                                                                                                  
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">          
                                    <label>Description</label>                                                                                                                
                                    <textarea name="descripton" id="descripton" class="form-control descripton textarea-autosize"></textarea>
                                    <i class="form-group__bar"></i>                                               
                                </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group"> 
                                    <label>Blog Image:</label>
                                    <div class="imgUp">
                                        <div class="imagePreview">
                                            <input type="hidden" id="pDisplayImg" name="pDisplayImg" value="">
                                        </div>
                                        <label class="btn btn-secondary displayImgBtn">Add
                                            <input type="file" id="blogDisplayImg" class="uploadFile img" value="Upload Photo" name="blogDisplayImg" style="width: 0px;height: 0px;overflow: hidden;" >
                                        </label>
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
                                                <input type="checkbox" name="addBlogCheck" class="addBlogCheck" id="addBlogCheck">            
                                                <label class="checkbox__label" for="addBlogCheck">                
                                                    Is Featured?            
                                                </label>        
                                            </div>    
                                        </div>
                                    </div>                                 
                                </div>
                            </div>
                        </div>          
                        <button type="" class="btn btn-outline-success addBlog" style="float: right">Add Blog</button>                                               
                    </div>
                </form>  
              </div>
              <!-- /.container-fluid -->  
              </div>
              <!-- End of Main Content -->  
          <!--Modal body end-->
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
<script src="{{ asset('admin/vendors/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/js/simple-tags.js') }}"></script>
<script src="{{asset('admin/vendors/summernote/summernote.min.js')}}"></script>
<script> 
    $(document).ready(function() {
        $('#descripton').summernote({
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
<script type="text/javascript">
function formReset(title, visibility) {  
    if (title == "Add Blog") {
        $('#formType').val('');
        if (visibility == 'true') {
            $('#addBlog').attr('hidden', visibility);       
        } else {
            $('#addBlog').attr('hidden', 'false');
            $('#addBlog').removeAttr("hidden");      
        }
        $("#descripton").summernote("code", '');
        $('.modalTitle').html(title); 
        $('.addBlog').html(title); 
        $('#addBlogForm')[0].reset();        
        $(".imagePreview").removeAttr("style");
        $('.select2').val(null).trigger('change');
        $('#simple-tag').removeAttr('data-simple-tags');
        $('#simple-tag').html("");    
        let tag = new SimpleTags();
        tag.apply();
    } else {
        $('#formType').val('');
        if (visibility == 'true') {
            $('#addBlog').attr('hidden', visibility);       
        } else {
            $('#addBlog').attr('hidden', 'false');
            $('#addBlog').removeAttr("hidden");      
        }
         $("#descripton").summernote("code", '');
        $('.modalTitle').html(title);  
        $('.addBlog').html(title); 
        $('#addBlogForm')[0].reset();        
        $(".imagePreview").removeAttr("style");
        $('.select2').val(null).trigger('change');
        $('#simple-tag').removeAttr('data-simple-tags');
        $('#simple-tag').html("");        
    }
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
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-size", "contain");
            }
        }    
    });
});

function blogFeatChecked(id){
    var blogFeatured;    
    if(document.getElementById("blogFeatCheckBox"+id).checked == true)
    {
        $("#blogFeatCheckBox"+id).attr('data-original-title', 'Yes');
        blogFeatured = 1;       
    }
    else{
        $("#blogFeatCheckBox"+id).attr('data-original-title', 'No');
        blogFeatured = 0;        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/admin/blogFeatured',
        method: 'post',               
        data: {
            blogId : id,
        blogFeatured : blogFeatured                 
        },
        success: function(result){ 
            if (blogFeatured == 1) 
            {
                swal({
                title: 'Success',
                text: 'Blog Featured',
                type: 'success',
                timer: 1000,
                showConfirmButton: false                           
            });
            } else 
            {
                swal({
                title: 'Success',
                text: 'Blog Removed From Featured',
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

$(document).ready(function () {  

//    var simpleTag = new Tags(document.getElementById("simple-tag"));
        let tag = new SimpleTags();
        tag.apply();
    $('#addBlogForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
        });
   

    $('.addBlog').click(function(e){
        e.preventDefault();               
        let form = $('#addBlogForm')[0],
            tags = $('#simple-tag').attr('data-simple-tags'),         
            categor = [],          
            addFormData = new FormData(form);   
            addFormData.append('tags',tags);           
            const ul = document.querySelector('.select2-selection__rendered');   
            const childern = ul.childNodes;    
            let i = 0;   
            childern.forEach(li => {
                categor[i] = li.innerText;
                i++;
            });                      
            addFormData.append('categories',categor);                         
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: '/admin/addBlog',
                method: 'post',               
                data: addFormData,
                contentType: false, 
                processData: false,
                success: function(result){      
                    console.log(result);              
                    swal({
                        title: 'Success',
                        text: result['success'],
                        type: 'success',
                        timer: 1000,
                    showConfirmButton: false 
                    }).then(function(){
                        $('#addBlog').modal('hide');   
                        $( "tbody" ).load( "blogs #blogrow" );
                                });        
                },error: function(params) {
                                        console.log(params);
                                    }
                
                });
    });    

});

function delblog(id) {
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
            url: "/admin/blogDel",
            type: "post",
            data: {
                bId: id
            },
            success: function(data) {
                swal({
                    title: 'Success',
                    text: 'Blog Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        $( "tbody" ).load( "blogs #blogrow" );
                                    });                                    
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

function editBlog(id) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/blogGetEdit",
        type: "post",
        data: {
            getEditBlog : id
        },
        success: function(data) {
            formReset('Update Blog', 'false');                   
            $('#bId').val(data['blogData']['Id']);      
            $('#formType').val("update");                      
            let bcats = data.blogData['bcats'].split(", ");
            $('.select2').val(bcats);
            $('.select2').trigger('change');                                  
            $('.blogName').val(data['blogData']['btitle']);                    
            $('#caption').val(data['blogData']['bcaption']);
            $('#simple-tag').attr('data-simple-tags',data['blogData']['btags']);            
            let tag = new SimpleTags();
            tag.apply();
            $("#descripton").summernote("code", data['blogData']['bdiscription']);
            $('.imagePreview').css("background-image", "url('../"+data['blogData']['bImage']+"')");
            $('.imagePreview').css("background-size", "contain");
            $('#pDisplayImg').val(data['blogData']['bImage']);  
            if (data['blogData']['bFeatured'] == 0)
                {                   
                   document.getElementById('addBlogCheck').checked = false;            
                }
            else
                { 
                   document.getElementById('addBlogCheck').checked = true;
                } 
            $('#addBlog').modal('show');
        }            
    });   
}
</script>
@endsection
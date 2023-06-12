@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/nouislider/nouislider.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/trumbowyg/ui/trumbowyg.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/flatpickr/flatpickr.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/vendors/rateyo/jquery.rateyo.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/demo/css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/app.min.css') }}">
<link rel="stylesheet" href="{{asset('admin/vendors/summernote/summernote.min.css')}}">
<style>
.imagePreview {
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
@section('content')


<section class="content">
    <header class="content__title">
        <h1>Packages</h1>        
    </header>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Packages
                
            </h2>
            <h6 class="card-subtitle">All Packages</h6>    
            <button class="btn btn-danger btn--action zmdi zmdi-plus btnAddPackage" data-placement="left" onclick="formReset('Add Package', 'false')" title="Add New Package"  data-toggle="modal" data-target="#addPackage" ></button>
            {{-- Table Content Start --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>Package Id</th>
                            <th>Booking Id</th>
                            <th>Image</th>
                            <th>Name</th>                         
                            <th>Price</th>
                            <th>Active</th>
                            <th>Feature</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Package Id</th>
                            <th>Booking Id</th>
                            <th>Image</th>
                            <th>Name</th>                        
                            <th>Price</th>
                            <th>Active</th>
                            <th>Feature</th>                            
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $n = 1;
                        foreach ($packages as $i => $packagesItem)     {                           
                            if ($packagesItem['pActive'] == 1 && $packagesItem['pFeatured'] == 0)
                               { 
                                   $packagesActive = 'checked data-original-title=Yes';  
                                   $packagesFeatured = ' data-original-title=No';                
                            
                                }
                            else if ($packagesItem['pActive'] == 0 && $packagesItem['pFeatured'] == 1)
                               { 
                                $packagesFeatured = 'checked data-original-title=Yes';  
                                   $packagesActive = ' data-original-title=No';                  
                                }
                            else if ($packagesItem['pActive'] == 1 && $packagesItem['pFeatured'] == 1)
                               { 
                                $packagesActive = 'checked data-original-title=Yes';  
                                   $packagesFeatured = 'checked data-original-title=Yes';                 
                                }                              
                            else
                                {
                                    $packagesActive = ' data-original-title=No';                                  
                                   $packagesFeatured = ' data-original-title=No'; 
                                }
                           ?>                                                             
                            <tr id="packagerow">
                                <td>{{ $packagesItem['Id'] }}</td>
                                <td>{{ $packagesItem['pBookingId'] }}</td>
                                <td>
                                    <img loading="lazy" src="../{{ $packagesItem['thumb'] }}" alt="" style="width: 50px; height:60px;">
                                </td>
                                <td>{{ $packagesItem['pName'] }}</td>                               
                                <td>PKR {{ $packagesItem['pPrice'] }}</td>
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" data-column="is_active" id="packageActCheckBox{{ $packagesItem['Id'] }}" class="toggle-switch__checkbox" onclick="packageActChecked({{ $packagesItem['Id'] }})" data-toggle="tooltip" title=""  {{ $packagesActive }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" data-column="is_featured" id="packageFeatCheckBox{{ $packagesItem['Id'] }}" class="toggle-switch__checkbox" onclick="packageFeatChecked({{ $packagesItem['Id'] }})" data-toggle="tooltip" title="" {{ $packagesFeatured }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>
                                <td>                                    
                                    <button data-toggle="tooltip" id="packageEdit" class="btn btn-outline-success btn--icon" onclick="editPackage({{ $packagesItem['Id'] }})" data-placement="top" title="" data-original-title="Edit Record">
                                        <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                    </button>                                
                                    <button data-toggle="tooltip" id="packageView" class="btn btn-outline-info btn--icon" onclick="viewPackage({{ $packagesItem['Id'] }})" data-placement="top" title="" data-original-title="View Record">
                                        <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                                    </button>
                                    <button data-toggle="tooltip" id="packageDelete" class="btn btn-outline-danger btn--icon" onclick="delPackage({{ $packagesItem['Id'] }})" data-placement="top" title="" data-original-title="Delete Record">
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
<div class="modal fade" id="addPackage" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left modalTitle">Add Package</h5>
                <h5 class="modal-title pull-right">
                    <a href="javascript:void(0)" data-dismiss="modal" onclick="formReset('Add Package', 'false')" >
                    <i class="zmdi zmdi-close zmdi-hc-fw"></i>
                </a>
            </h5>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" name='addPackageForm' class="CrudForm row" data-nosubmit="true" method="POST" data-noinfo="true" id="addPackageForm">
                    @csrf
                    <div class="col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">     
                                    <input type="hidden" class="packageId" name="packageId" id="packageId" value="">  
                                    <input type="hidden" class="formType" name="formType" id="formType" value="add">  
                                    <label for="packageName" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="packageName" id="packageName" placeholder="Name" required>
                                    <i class="form-group__bar"></i>                                
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">    
                                    <label for="packageModelNo" class="col-form-label">Booking Id</label>                          
                                    <input type="text" class="form-control" id="packageModelNo" name="packageModelNo" placeholder="Model No" required>
                                    <i class="form-group__bar"></i>                                
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">    
                                    <label for="packageNoOfDays" class="col-form-label">No of Days</label>                          
                                    <input type="number" class="form-control" id="packageNoOfDays" name="packageNoOfDays" min="1" step="1" value="1" placeholder="No of Days" required>
                                    <i class="form-group__bar"></i>                                
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="packageDescript" class="col-form-label">Description</label>
                                    <textarea class="form-control" id="packageDescript" name="packageDescript" required></textarea>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>                       
                      
                        <div class="row">
                        
                            <div class="col-sm-6 col-md-6">
                                <label for="packagePrice" class="col-form-label">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" id="packagePrice" name="packagePrice" placeholder="Price" required>                                  
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group"> 
                                    <label for="packageDiscount" class="col-form-label">Discount</label>
                                    <div class="input-group">     
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>                          
                                        <input type="text" class="form-control input-mask" id="packageDiscount" name="packageDiscount" data-mask="00.00" placeholder="Discount eg: 00.00" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group"> 
                                    <label>Display Image:</label>
                                    <div class="imgUp">
                                        <div class="imagePreview">
                                            <input type="hidden" id="pDisplayImg" name="pDisplayImg" value="">
                                        </div>
                                        <label class="btn btn-secondary displayImgBtn">Add
                                            <input type="file" id="packageDisplayImg" class="uploadFile img" value="Upload Photo" name="packageDisplayImg" style="width: 0px;height: 0px;overflow: hidden;" >
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
                                                <input type="checkbox" name="addPackageCheck" class="addPackageCheck" id="addPackageCheck">            
                                                <label class="checkbox__label" for="addPackageCheck">                
                                                    Is Active?            
                                                </label>        
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">        
                                            <div class="checkbox">            
                                                <input type="checkbox" name="addPackageFeaCheck" class="addPackageFeaCheck" id="addPackageFeaCheck">            
                                                <label class="checkbox__label" for="addPackageFeaCheck">                
                                                    Featured?            
                                                </label>        
                                            </div>    
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <input style="float: right" type="submit" class="btn btn-outline-success" id="addPackageFormSubmit" value='Add Package'>                                                                              
                    </div> 
                   
                </form>      
            </div>
            {{-- <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" id="addPackageFormSubmit">Add Package</button>                
            </div> --}}
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
<script src="{{ asset('admin/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendors/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('admin/vendors/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/vendors/rateyo/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jquery-text-counter/textcounter.min.js') }}"></script>
<script src="{{ asset('admin/vendors/autosize/autosize.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>    
<script src="{{asset('admin/vendors/summernote/summernote.min.js')}}"></script>
<script> 
    $(document).ready(function() {
        $('#packageDescript').summernote({
            placeholder: "Write description.....",
            tabsize: 2,
            height: 120
        });
    // $('#packageShortDescript').summernote({
    //     placeholder: "Write short description.....",
    //     tabsize: 2,
    //     height: 120
    // });
    // $('#packageAdditionalInfo').summernote({
    //     placeholder: "Write Additional Information.....",
    //     tabsize: 2,
    //     height: 120
    // });
    });
</script>
<script type="text/javascript">
var count= 0;
function formReset(title, visibility) {  
    $('#formType').val('');
    if (visibility == 'true') {
        $('#addPackageFormSubmit').attr('hidden', visibility);
    } else {
        $('#addPackageFormSubmit').attr('hidden', 'false');
        $('#addPackageFormSubmit').removeAttr("hidden");
    }
    $('.modalTitle').html(title);
    $('#addPackageFormSubmit').val(title);
    $("#packageDescript").summernote("code", '');
    // $("#packageShortDescript").summernote("code", '');
    // $("#packageAdditionalInfo").summernote("code", '');         
    $('#addPackageForm')[0].reset();        
    $(".imagePreview").removeAttr("style");
    count= 0;
}

function packageActChecked(id){
    var packageActive;    
    if(document.getElementById("packageActCheckBox"+id).checked == true)
    {
        $("#packageActCheckBox"+id).attr('data-original-title', 'Yes');
        packageActive = 1;       
    }
    else{
        $("#packageActCheckBox"+id).attr('data-original-title', 'No');
        packageActive = 0;        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/admin/packageActive',
        method: 'post',               
        data: {
            packageId : id,
        packageActive : packageActive                 
        },
        success: function(result){ 
            if (packageActive == 1) 
            {
                swal({
                title: 'Success',
                text: 'Package Activated',
                type: 'success',
                timer: 1000,
                showConfirmButton: false                           
            });
            } else 
            {
                swal({
                title: 'Success',
                text: 'Package Deactivated',
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

function packageFeatChecked(id){
    var packageFeatured;    
    if(document.getElementById("packageFeatCheckBox"+id).checked == true)
    {
        $("#packageFeatCheckBox"+id).attr('data-original-title', 'Yes');
        packageFeatured = 1;       
    }
    else{
        $("#packageFeatCheckBox"+id).attr('data-original-title', 'No');
        packageFeatured = 0;        
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: '/admin/packageFeatured',
        method: 'post',               
        data: {
            packageId : id,
        packageFeatured : packageFeatured                 
        },
        success: function(result){ 
            if (packageFeatured == 1) 
            {
                swal({
                title: 'Success',
                text: 'Package Featured',
                type: 'success',
                timer: 1000,
                showConfirmButton: false                           
            });
            } else 
            {
                swal({
                title: 'Success',
                text: 'Package Removed From Featured',
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

function delPackage(id) {
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
            url: "/admin/packageDel",
            type: "post",
            data: {
                deletePackage: id
            },
            success: function(data) {

                swal({
                    title: 'Success',
                    text: 'Package Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        $( "tbody" ).load( "packages #packagerow" );
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

function editPackage(id) {
    $(".page-loader").show();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/packageGetEdit",
        type: "post",
        data: {
            getPackageId : id
        },
        success: function(data) {
            formReset('Update Package', 'false')
            console.log(data);         
            document.getElementById('packageId').value = data.packageData['Id'];
            document.getElementById('formType').value = 'update';
            
            document.getElementById('packageName').value = data.packageData['pName'];
            $("#packageDescript").summernote("code", data.packageData['pDescription']);    
            document.getElementById('packageModelNo').value = data.packageData['pBookingId'];
            document.getElementById('packageNoOfDays').value = data.packageData['noOfDays'];
            document.getElementById('packagePrice').value = data.packageData['pPrice'];
            document.getElementById('packageDiscount').value = data.packageData['discount'];
            
            if (data.packageData['pActive'] == 1 && data.packageData['pFeatured'] == 0)
                { 
                    document.getElementById('addPackageCheck').checked = true;
                    document.getElementById('addPackageFeaCheck').checked = false;            
                }
            else if (data.packageData['pActive'] == 0 && data.packageData['pFeatured'] == 1)
                { 
                    document.getElementById('addPackageCheck').checked = false;
                    document.getElementById('addPackageFeaCheck').checked = true;
                }
            else if (data.packageData['pActive'] == 1 && data.packageData['pFeatured'] == 1)
                { 
                    document.getElementById('addPackageCheck').checked = true;
                    document.getElementById('addPackageFeaCheck').checked = true;
                }                              
            else
                {
                    document.getElementById('addPackageCheck').checked = false;
                    document.getElementById('addPackageFeaCheck').checked = false;
                }
            $('.imagePreview').css("background-image", "url(../"+data.packageData['pImage']+")");
            $('#pDisplayImg').val(data.packageData['pImage']);                                                                                             
            $('#addPackage').modal('show');            
        },error: function(params) {
            console.log(params);
        }            
    });   

    $(".page-loader").fadeOut();
}

function viewPackage(id) { 
    $(".page-loader").show();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/packageGetEdit",
        type: "post",
        data: {
            getPackageId : id
        },
        success: function(data) {
            formReset('Package Details', 'true');
            console.log(data);         
            document.getElementById('packageId').value = data.packageData['Id'];
            document.getElementById('formType').value = 'veiw';
            
            document.getElementById('packageName').value = data.packageData['pName'];
            $("#packageDescript").summernote("code", data.packageData['pDescription']);
            // $("#packageShortDescript").summernote("code", data.packageData['pShortDescription']);
            // $("#packageAdditionalInfo").summernote("code", data.packageData['pAdditionInfo']);           
            document.getElementById('packageModelNo').value = data.packageData['pBookingId'];
            document.getElementById('packageNoOfDays').value = data.packageData['noOfDays'];
            document.getElementById('packagePrice').value = data.packageData['pPrice'];
            document.getElementById('packageDiscount').value = data.packageData['discount'];
            
            
            if (data.packageData['pActive'] == 1 && data.packageData['pFeatured'] == 0)
                { 
                    document.getElementById('addPackageCheck').checked = true;
                    document.getElementById('addPackageFeaCheck').checked = false;            
                }
            else if (data.packageData['pActive'] == 0 && data.packageData['pFeatured'] == 1)
                { 
                    document.getElementById('addPackageCheck').checked = false;
                    document.getElementById('addPackageFeaCheck').checked = true;
                }
            else if (data.packageData['pActive'] == 1 && data.packageData['pFeatured'] == 1)
                { 
                    document.getElementById('addPackageCheck').checked = true;
                    document.getElementById('addPackageFeaCheck').checked = true;
                }                              
            else
                {
                    document.getElementById('addPackageCheck').checked = false;
                    document.getElementById('addPackageFeaCheck').checked = false;
                }
            $('.imagePreview').css("background-image", "url(../"+data.packageData['pImage']+")");                                              
            $('#addPackage').modal('show');     
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

let token = $('meta[name="csrf-token"]').attr('content');

   
	
//form submission code goes here
$("#addPackageForm").submit(function(event) {	    
    event.preventDefault();	    		    
    var form = $('#addPackageForm')[0];
    var formData = new FormData(form);           
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({	    		
        url: "/admin/addPackages",
        method: 'post',
        data : formData, 
        processData: false, 
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        packagecessData: false, // NEEDED, DON'T OMIT THIS
        success: function(result){                   
            if(result.status == "success"){
            console.log(result);
                var packageId = result.package_id;
                $("#packageId").val(packageId); 
                $("#formType").val(result.formType);
                var i = 0;                                           
                                        
                swal({
                    title: 'Success',
                    text: 'Successfull',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                }).then(function(){
                    $( "tbody" ).load( "packages #packagerow" );
                    $('#addPackage').modal('hide');

                    }); 
                                                                
            }else{
                console.log(result);
            }
        },error: function(params) {
                        console.log(params);
                    } 
    });
});

</script>
@endsection
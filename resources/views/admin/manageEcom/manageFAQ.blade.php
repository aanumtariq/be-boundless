@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
<style>

</style>
<script>

</script>
@endsection
@section('content')


<section class="content">
    <header class="content__title">
        <h1>FAQ</h1>       
    </header>

 
 
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All FAQs</h2>
           {{-- <button data-toggle="tooltip" data-placement="left" title="Sort Records" style="right: 90px !important;" class="btn btn-info btn--action ytable-sortrecord"><i class="zmdi zmdi-sort-asc zmdi-hc-fw"></i></button> --}}
            <button class="btn btn-danger btn--action zmdi zmdi-plus ytable-addrecord" data-placement="left" title="Add New Record" data-toggle="modal" onclick="formReset('Add FAQ')" data-target="#addFAQ" ></button>
            {{-- Table Content Start --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>S.no</th>                         
                            <th>Question</th>
                            <th>Answer</th>              
                            <th>Active</th>                                          
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.no</th>                         
                            <th>Question</th>
                            <th>Answer</th>              
                            <th>Active</th>                                          
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $n = 1;
                        foreach ($faqs as $faqItem)    {

                            if ($faqItem['faqActive'] == 1)
                               { $faqActive = 'checked data-original-title=Yes';}                               
                            else
                                {$faqActive = ' data-original-title=No'; }
                           ?> 
                                                                                  
                            <tr id="faqrow">
                                <td>{{ $n }}</td>
                                <td>{{ $faqItem['question'] }}</td>
                                <td>{{ $faqItem['answer'] }}</td>  
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="FAQCheckBox{{ $faqItem['Id'] }}" data-column="is_active" onclick="checkedFAQ({{ $faqItem['Id'] }})" class="toggle-switch__checkbox" data-toggle="tooltip"   {{ $faqActive }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td>                                                    
                                <td>
                                    <button data-toggle="tooltip" id="edit" class="btn btn-outline-success btn--icon" data-placement="top" title="" onclick="editFAQ({{ $faqItem['Id'] }})" data-original-title="Edit Record">
                                        <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                    </button>                                    
                                    <button data-toggle="tooltip" id="delete" class="btn btn-outline-danger btn--icon" data-placement="top" title="" onclick="delFAQ({{ $faqItem['Id'] }})" data-original-title="Delete Record">
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

<!--Modal -->
<div class="modal fade" id="addFAQ" role="dialog">    
    <div class="modal-dialog modal-md">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title text-center">Add FAQ</h2>          
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="modal-body">
          <!--Modal body start-->  
              <!-- Begin Page Content -->
              <div class="container-fluid">  
              <!-- Model Content -->                              
                <form class="row" id="addFAQForm">  
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">       
                                    <label for="faqQues">Qusetion</label>                             
                                    <input type="hidden" id="fId" name="fId">
                                    <input type="hidden" name="formType" id="formType" class="formType" >
                                    <input type="text" name="faqQues" id="faqQues" class="faqQues form-control" placeholder="Qusetion">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>                                                  
                        </div>                                                                                                              
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">       
                                    <label for="faqAns">Answer</label>                             
                                    <textarea name="faqAns" id="faqAns" class="faqAns form-control" placeholder="Answer" rows="5"></textarea>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>                                                  
                        </div>                                                                                                                                       
                        <div class="form-group">        
                            <div class="checkbox">            
                                <input type="checkbox" name="addFAQCheck" class="addFAQCheck" id="addFAQCheck">            
                                <label class="checkbox__label" for="addFAQCheck">                
                                    Is Active?            
                                </label>        
                            </div>    
                        </div>                     
                        <button type="" class="btn btn-outline-success addFAQ" style="float: right">Add FAQ</button>                                               
                    </div>
                </form>  
              </div>
              <!-- /.container-fluid -->  
              </div>
              <!-- End of Main Content -->  
          <!-- Modal body end-->
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
<script src="{{ asset('admin/vendors/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
<script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
function formReset(title, visibility) {      
    $('#formType').val('');
    if (visibility == 'true') {
        $('#addFAQ').attr('hidden', visibility);       
    } else {
        $('#addFAQ').attr('hidden', 'false');
        $('#addFAQ').removeAttr("hidden");      
    }
    $('.modal-title').html(title);  
    $('.addFAQ').html(title); 
    $('#addFAQForm')[0].reset();           
}


function delFAQ(id) {
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
            url: "/admin/faqDel",
            type: "post",
            data: {
                fId: id
            },
            success: function(data) {
                swal({
                    title: 'Success',
                    text: 'FAQ Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        window.reload();
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

function editFAQ(id) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/faqGetEdit",
        type: "post",
        data: {
            getEditFAQ : id
        },
        success: function(data) {
            formReset('Update FAQ', 'false');                   
            $('#fId').val(data['faqData']['Id']);      
            $('#formType').val("update");                                                                      
            $('.faqQues').val(data['faqData']['question']); 
            $('.faqAns').val(data['faqData']['answer']);                                                                                                       
            if (data['faqData']['faqActive'] == 0)
                {                   
                   document.getElementById('addFAQCheck').checked = false;            
                }
            else
                { 
                   document.getElementById('addFAQCheck').checked = true;
                } 
            $('#addFAQ').modal('show');
        }            
    });   
}

function checkedFAQ(id){
    var faqActive;    
    if(document.getElementById("FAQCheckBox"+id).checked == true)
    {
        $("#FAQCheckBox"+id).attr('data-original-title', 'Yes');
        faqActive = 1;       
    }
    else{
        $("#FAQCheckBox"+id).attr('data-original-title', 'No');
        faqActive = 0;        
    }
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            url: '/admin/faqActive',
            method: 'post',               
            data: {
                faqId : id,
            faqActive : faqActive                 
            },
            success: function(result){ 
                if (faqActive == 1) 
                {
                    swal({
                    title: 'Success',
                    text: 'FAQ Activated',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false                           
                });
                } else 
                {
                    swal({
                    title: 'Success',
                    text: 'FAQ Deactivated',
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


    $('#addFAQForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
   
    
    $('.addFAQ').click(function(e){
        e.preventDefault();               
        let form = $('#addFAQForm')[0],                             
            addFormData = new FormData(form);                                                                                                                              
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: '/admin/addFAQ',
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
                        $('#addFAQ').modal('hide');   
                        $( "tbody" ).load( "FAQs #faqrow" );
                                });        
                },error: function(params) {
                                        console.log(params);
                                    }
                
                });
    });   


});

    

</script>
@endsection
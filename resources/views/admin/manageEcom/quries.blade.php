@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Quries</h1>       
    </header>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All Quries</h2>                      
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>        
                            <th>S.no</th>                                                                                             
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>     
                            <th>Created At</th>                         
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>  
                            <th>S.no</th>                                       
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>                         
                            <th>Created At</th>                                                                                                                        
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($contactDB as $i => $contactDBItem)    {                           
                           ?>                                                                              
                            <tr id="quriesrow"> 

                                <td>{{ $i+1 }}</td>
                                <td>{{ $contactDBItem['name'] }}</td>
                                <td>{{ $contactDBItem['email'] }}</td>
                                <td>{{ $contactDBItem['phone'] }}</td>                                
                                <td>{{ $contactDBItem['subject'] }}</td>
                                <td>{{ $contactDBItem['message'] }}</td>                               
                                <td>{{ $contactDBItem['created_at'] }}</td>                                                                                                                  
                                <td>                                                                     
                                    <button data-toggle="tooltip" id="delete" class="btn btn-outline-danger btn--icon" data-placement="top" title="" onclick="delQuries({{ $contactDBItem['Id'] }})" data-original-title="Delete Record">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </button>
                                </td>                                                                                 
                            </tr>
                            <?php }?>                        
                    </tbody>
                </table>
            </div>
            {{-- Table Content End --}}
        </div>
    </div>    
</section>

@endsection   
@section('js')
<!-- Vendors: Data tables -->
<script src="{{ asset('admin/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
function delQuries(id) {
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
            url: "/admin/quriesDel",
            type: "post",
            data: {
                deleteQuries: id
            },
            success: function(data) {
                swal({
                    title: 'Success',
                    text: 'Quries Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        $( "tbody" ).load( "quries #quriesrow" );
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
 
</script>
@endsection
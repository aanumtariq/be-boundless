@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Users</h1>       
    </header>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All Users</h2>                      
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>                            
                            <th>Users id</th>                         
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Phone No</th>
                            <th>DOB</th>
                            <th>Gender</th> 
                            <th>Created At</th> 
                            <th>Active?</th>                         
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Users id</th>                         
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Phone No</th>
                            <th>DOB</th>
                            <th>Gender</th> 
                            <th>Created At</th> 
                            <th>Active?</th>                                                                                                           
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($users as $usersItem)    {

                            if ($usersItem['uActive'] == 1)
                               { $usersActive = 'checked data-original-title=Active';}                               
                            else
                                {$usersActive = ' data-original-title=Deactivated'; }
                           ?>                                                                              
                            <tr id="usersrow">
                                <td>{{ $usersItem['id'] }}</td>
                                <td>{{ $usersItem['name'] }}</td>
                                <td>{{ $usersItem['email'] }}</td>
                                <td>{{ $usersItem['country'] }}</td>
                                <td>{{ $usersItem['phoneNo'] }}</td>
                                <td>{{ $usersItem['dOB'] }}</td>
                                <td>{{ $usersItem['gender'] }}</td>                               
                                <td>{{ $usersItem['created_at'] }}</td>                               
                                {{-- <td>{{ $usersItem['email_verified_at'] }}</td> --}}                               
                                <td>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="UsersCheckBox{{ $usersItem['id'] }}" data-column="is_active" onclick="checkedUsers({{ $usersItem['id'] }})" class="toggle-switch__checkbox" data-toggle="tooltip"   {{ $usersActive }}>
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </td> 
                                <td>                                                                     
                                    <button data-toggle="tooltip" id="delete" class="btn btn-outline-danger btn--icon" data-placement="top" title="" onclick="delUsers({{ $usersItem['id'] }})" data-original-title="Delete Record">
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
function delUsers(id) {
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
            url: "/admin/usersDel",
            type: "post",
            data: {
                deleteUsers: id
            },
            success: function(data) {
                swal({
                    title: 'Success',
                    text: 'Users Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                        $( "tbody" ).load( "addUsers #usersrow" );
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

function checkedUsers(id){
    var usersActive;    
    if(document.getElementById("UsersCheckBox"+id).checked == true)
    {
        $("#UsersCheckBox"+id).attr('data-original-title', 'Active');
        usersActive = 1;       
    }
    else{
        $("#UsersCheckBox"+id).attr('data-original-title', 'Deactivated');
        usersActive = 0;        
    }
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: '/admin/usersActive',
            method: 'post',               
            data: {
                usersId : id,
                usersActive : usersActive                 
            },
            success: function(result){ 
                console.log(result);
                if (usersActive == 1) 
                {
                    swal({
                    title: 'Success',
                    text: 'User Activated',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false                           
                });
                } else 
                {
                    swal({
                    title: 'Success',
                    text: 'User Deactivated',
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
 
</script>
@endsection
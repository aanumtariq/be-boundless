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
        <h1>Reservations</h1>        
    </header>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">All Reservations</h2>                       
            {{-- Table Content Start --}}
            <div class="table-responsive">
                <table id="data-table" class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>S.no</th>
                            <th>Booking Id</th>                         
                            <th>Reservation Date</th>
                            <th>Departure Date</th>
                            <th>Return Date</th>
                            <th>Customer Name</th>
                            <th>Total</th>              
                            <th>Status</th>                                          
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.no</th>                         
                            <th>Booking Id</th>                         
                            <th>Reservation Date</th>
                            <th>Departure Date</th>
                            <th>Return Date</th>
                            <th>Customer Name</th>
                            <th>Total</th>              
                            <th>Status</th>                                          
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>                                 
                        @foreach($reservations as $i=> $resItem)                                                                                                        
                            <tr id="resrow">             
                                <td> {{ $i+1 }}</td>                   
                                <td>{{ $resItem['bookingId'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($resItem['created_at'] )); }}</td>
                                <td>{{ $resItem['departureDate']   }}</td>  
                                <td>{{ $resItem['returnDate']   }}</td>  
                                <td>{{ $resItem['fullName'] }}</td>
                                <td>PKR {{ $resItem['total'] }}</td>     
                                <td>
                                    <button class="btn btn-outline-success btn--icon-text">                                                                                                                       
                                        {{ $resItem['status'] }}                                    
                                    </button>   
                                    <div class="dropdown actions__item">
                                        <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" id="resEdit" class="dropdown-item" onclick="editRes({{ $resItem['Id'] }})"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit</a>                                           
                                        </div>    
                                    </div>
                                </td>                                 
                                <td>                                                                      
                                    <button data-toggle="tooltip" id="resView" class="btn btn-outline-info btn--icon" onclick="viewRes({{ $resItem['Id'] }})" data-placement="top" title="" data-original-title="View Record">
                                        <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                                    </button>
                                    <button data-toggle="tooltip" id="delete" class="btn btn-outline-danger btn--icon" data-placement="top" title="" onclick="delReservation({{ $resItem['Id'] }})" data-original-title="Delete Record">
                                        <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                    </button>
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
<div class="modal fade" id="editRes" role="dialog">    
    <div class="modal-dialog modal-md">     
        <div class="modal-content">
            <div class="modal-header">
            <h2 class="modal-title text-center">Update Reservation Status</h2>          
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            </div>
            <div class="modal-body">        
                <div class="container-fluid">                            
                    <form class="row"  id="reservationEditForm">  
                        <div class="col-md-12">                                                                     
                            <div class="form-group">                                                                                                       
                                <input name="reservationId" type="hidden" class="resIdEdit">
                                <select id="resStatusEdit" class="form-control " name="resStatusEdit" placeholder="Select Reservation Status" data-style="btn-success" required>                                                                          
                                    <option value="Payment Pending">Payment Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Ready to Ship">Ready to Ship</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Completed">Completed</option>                  
                                    <option value="Canceled">Canceled</option> 
                                    <option value="Payment Successful">Payment Successful</option> 
                                </select>
                                <i class="form-group__bar"></i>                                                                                                               
                            </div>                                                       
                            <button type="" class="btn btn-outline-success updateRes" style="float: right">Update Status</button>                                               
                        </div>
                    </form>                             
                </div>            
            </div>        
        </div>   
    </div>
</div>



<!--Modal -->
<div class="modal fade" id="viewReservation" role="dialog">    
    <div class="modal-dialog modal-lg">     
        <div class="modal-content">
            <div class="modal-header">
            <h2 class="modal-title text-center">Reservation Details</h2>          
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            </div>
            <div class="modal-body"> 

            <div class="card" style="background-color: whitesmoke;">
                <div class="card-body" style="padding: 10px 0px 0px 0px;">
                    <div class="container-fluid">                       
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-3">
                                            <h5 class="font-weight-bold pb-2">Reservation Info</h5>
                                            <div class="table-responsive">
                                                <table class="table table-breservationless mb-0">
                                                    <tbody>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                ID
                                                            </td>
                                                            <td id="bookingId">
                                                                OR-325548
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Date
                                                            </td>
                                                            <td id="reservationDate">
                                                                01 Jan 2021 06:32
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Payment Method
                                                            </td>
                                                            <td id="reservationPM">
                                                                Credit Card
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Status
                                                            </td>
                                                            <td id="resStatus">
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li style="background-color: whitesmoke;" class="list-group-item p-3"></li>
                                        <li class="list-group-item p-3">
                                            <h5 class="font-weight-bold pb-2">Customer Details</h5>
                                            <div class="table-responsive">
                                                <table class="table table-breservationless mb-0">
                                                    <tbody>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Name
                                                            </td>
                                                            <td id="cusName">
                                                                John Lynn
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Email
                                                            </td>
                                                            <td id="cusEmail">
                                                                lynnj34@blueberry.com
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Phone
                                                            </td>
                                                            <td id="cusPhNo">
                                                                +21 11445-2213
                                                            </td>
                                                        </tr>                                                                                                               
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                                Pickup Address
                                                            </td>
                                                            <td id="cusPickupAddress">
                                                                201, Baker Street
                                                            </td>
                                                        </tr>
                                                        <tr class="white-space-no-wrap">
                                                            <td class="text-muted pl-0">
                                                               Destination Address
                                                            </td>
                                                            <td id="cusDestinationAddress">
                                                                201, Baker Street
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-3">
                                            <h5 class="font-weight-bold">Reservation Items</h5>
                                        </li>
                                        <li class="list-group-item p-0">
                                        <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr class="text-muted">
                                                        <th scope="col">Image</th>                                                       
                                                        <th scope="col">Package</th>                                                       
                                                        <th scope="col" class="text-right">Location</th>
                                                        <th scope="col" class="text-right">No of Days</th>                                                        
                                                        <th scope="col" class="text-right">Price</th>                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody id="resPro">                                                                                                           
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </li>                                                                            
                                        <li class="list-group-item p-3">
                                            <div class="d-flex justify-content-end">
                                            Total: <p class="ml-2 mb-0 font-weight-bold" id="subTotal">PKR 1,237.44</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

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
<script src="{{ asset('admin/vendors/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
<script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">

function formReset() {  
    $('#reservationEditForm')[0].reset();     
}

function editRes(id) {
    formReset();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/resGetEdit",
        type: "post",
        data: {
            getEditRes : id
        },
        success: function(data) {
            console.log(data);
                    $('.resIdEdit').val(data['reservationData']['Id']);                     
                    // $('.resStatusEdit').val(data['reservationData']['status']);       
                    document.getElementById('resStatusEdit').value = data['reservationData']['status'];                              
                    $('#editRes').modal('show');
        },error: function(params) {
                                        console.log(params);
                                    }            
    });   
}

function delReservation(id) {
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
            url: "/admin/reservationDel",
            type: "post",
            data: {
                deleteReservation : id
            },
            success: function(data) {               
                swal({
                    title: 'Success',
                    text: 'Reservation Deleted Successfuly',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false     
                    }).then(function(){
                      location.reload();

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

function clearView() {
    $('#bookingId').html('');
    $('#reservationDate').html('');
    $('#reservationPM').html('');
    $('#resStatus').html('');
    $('#cusName').html('');
    $('#cusEmail').html('');
    $('#cusPhNo').html('');
    $('#cusCountry').html('');
    $('#cusCity').html('');
    $('#cusAddress').html('');
    $('#resPro').html('');
}

function viewRes(id) {  
    clearView();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url: "/admin/getViewRes",
        type: "post",
        data: {
            getResId : id
        },
        success: function(data) {
            console.log(data);
            $('#bookingId').html(data.reservationData['bookingId']);
            $('#reservationDate').html(data.reservationData['created_at']);
            $('#reservationPM').html(data.reservationData['paymentMethod']);
            $('#resStatus').html('<p class="mb-0 text-success font-weight-bold d-flex justify-content-start align-items-center" >'+
                                '<small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">'+                                              
                                '<circle cx="12" cy="12" r="8" fill="#3cb72c"></circle></svg>'+data.reservationData['status']+'</small></p>');
            $('#cusName').html(data.reservationData['fullName']);
            $('#cusEmail').html(data.reservationData['email']);
            $('#cusPhNo').html(data.reservationData['phone']);            
            $('#cusPickupAddress').html(data.reservationData['pickupAddress']);
            $('#cusDestinationAddress').html(data.reservationData['destinationAddress']);
            console.log(data.reservationData['reservation_details']['pName'])




            var gTotal = 0;
           
            $('#resPro').append('<tr><td><div class="active-project-1 d-flex align-items-center mt-0 ">'+
                                '<img class="avatar rounded" alt="user-icon" width="60px" height="60px" src="../'+data.reservationData['reservation_details']['thumb']+'"></div></td><td>'+
                                '<div class="data-content"><span class="font-weight-bold">'+data.reservationData['reservation_details']['pName']+'</span>'+
                                '</div></td><td class="text-right">'+data.reservationData['reservation_details']['pDescription']+'</td><td class="text-right">'+data.reservationData['reservation_details']['noOfDays']+'</td><td class="text-right">'+data.reservationData['reservation_details']['pPrice']+'</td>'+
                                '</tr>');
                
           
            $('#subTotal').html('PKR '+data.reservationData['total']);
            $('#viewReservation').modal('show');
        },error: function(params) {
            console.log(params);
        }            
    });   
}

$('.updateRes').click(function(e){  
    var upResId =  $('.resIdEdit').val();                     
    var upReservationStatus =  $('#resStatusEdit').val();

            e.preventDefault();             
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: '/admin/editReservation',
                method: 'post',               
                data: {
                    upResId : upResId,  
                    upReservationStatus : upReservationStatus,                  
                },
                success: function(result){     
                    console.log(result);               
                    swal({
                        title: 'Success',
                        text: 'Reservation Updated Successfuly',
                        type: 'success',
                        timer: 1000,
                        showConfirmButton: false 
                    }).then(function(){
                        $( "tbody" ).load( "Reservations #resrow" );
                        $('#editRes').modal('hide');
                                });        
                },error: function(params) {
                                        console.log(params);
                                    }
                
                });
});
</script>
@endsection
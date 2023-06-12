@extends('user.layout.master')
@section('css')
<style>
.switch {
  display: inline-flex;
  margin: 0 10px;
}
.switch input[type=checkbox] {
  height: 0;
  width: 0;
  visibility: hidden;
}
.switch input[type=checkbox]:checked + label {
    background: var(--color-primary);
}
.switch input[type=checkbox]:checked + label::after {
  left: calc(100% - 4px);
  transform: translateX(-100%);
}
.switch label {
  cursor: pointer;
  width: 48px;
  height: 24px;
  background: grey;
  display: block;
  border-radius: 24px;
  position: relative;
}
.switch label::after {
  content: "";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 16px;
  height: 16px;
  background: white;
  border-radius: 16px;
  transition: 0.3s;
}
a.edit:hover {
    color: wheat !important;
    background: #ff864a6e !important;
    cursor: pointer;
}
a.delete:hover {
    color: #ec0f01 !important;
    background: #ec0f0120 !important;
    cursor: pointer;    
}
</style>




@endsection
@section('content')
<div class="mainTitle">
    <h3>My Address</h3>
</div>
<a style="float: right; margin-bottom:5px; " href="{{ route('user.address') }}"><button class="btn themeBtn" >Add Address</button></a>
<div class="themeTable">
    <table>
        <thead>
            <tr>
                <th>S.no</th>                               	
                <th>Full Name</th>                             
                <th>Phone Number</th>                         
                <th>Full Address</th>              
                <th>Default</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($addressDB as $i => $addressDBItem)
                <tr id="addRow">
                    <td>{{ $i+1 }}</td>                  
                    <td>{{ $addressDBItem['firstName'].' '.$addressDBItem['lastName'] }}</td>                                             
                    <td>{{ $addressDBItem['phoneNumber'] }}</td>                                                           
                    <td style="text-align: left;">{{ $addressDBItem['address'] }}</td>                                                              
                    @php
                        if ($addressDBItem['aDefault'] == 1)
                               { $addDefault = 'checked title=Yes';}                               
                            else
                                {$addDefault = 'title=No'; }        
                    @endphp
                    <td>
                        <div class="switch">
                            <input type="checkbox" name="addDefaultCheck" id="addDefaultCheck{{ $addressDBItem['Id'] }}" data-column="is_active" onclick="defaultCheck({{ $addressDBItem['Id'] }})" class="aDefault"  data-toggle="tooltip" {{ $addDefault }}>                           
                            <label for="addDefaultCheck{{ $addressDBItem['Id'] }}" data-toggle="tooltip" {{ $addDefault }}></label> 
                        </div>
                    </td>  
                    <td>
                        <a class="edit" href="{{ route('user.editAddress',[ $addressDBItem['Id'] ]) }}">Edit</a>
                        <a onclick="delAdd({{ $addressDBItem['Id'] }})" class="delete">Delete</a>
                    </td>
                   
                </tr>
            @endforeach           
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script type="text/javascript">

(() => {
    $('[data-toggle="tooltip"]').tooltip();    
})()

function delAdd(id) {   
    if (window.confirm('Are you sure, You wil not be able to recover this')) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
        url: "{{ route('user.delAddress') }}",
        type: "post",
        data: {
            deleteAddress: id
        },
        success: function(data) {
            generateNotification('1','Success, Address Deleted Successfuly');    
            $( "tbody" ).load( "user_addressBook #addRow" );                                                   
            }            
        });
    }
    else{
        generateNotification('0','Cancelled, Your data is safe');    
        $( "tbody" ).load( "user_addressBook #addRow" );               
    }                             
}

function defaultCheck(id){
    var addDefault;    
    if(document.getElementById("addDefaultCheck"+id).checked == true)
    {
        $("#addDefaultCheck"+id).attr('title', 'Yes');
        addDefault = 1;       
    }
    else{
        $("#addDefaultCheck"+id).attr('title', 'No');
        addDefault = 0;        
    }
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $.ajax({
            url: "{{ route('user.addDefault') }}",
            method: 'post',               
            data: {
                addId : id,
            addDefault : addDefault                 
            },
            success: function(result){ 
                if (addDefault == 1) 
                {
                    generateNotification('1','Address added to default');    
                    $( "tbody" ).load( "user_addressBook #addRow" );                                        
                }
                 else 
                {
                    generateNotification('0','Address removed from default');       
                    $( "tbody" ).load( "user_addressBook #addRow" );                                   
                }
                                  
                        
            },error: function(params) {
                                    console.log(params);
                                }            
            });
}

</script>
@endsection
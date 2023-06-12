@extends('user.layout.master')
@section('css')
<style>

    .checkboxInp{
        width: 15px !important;
    float: left;
    margin-right: 10px;
    margin-top: 5px;
    }
</style>
@endsection
@section('content')
<div class="mainTitle">
    <h3>Add New Address</h3>
</div>
<form method="POST" id="cRUDAddress" action="{{ route('user.cRUDAddress') }}" class="themeForm">
    @csrf
    <input type="hidden" value="{{ $formType == 'update' ? $addId : '' }}" name="aId">
    <input type="hidden" value="{{ $formType == 'update' ? $formType : '' }}" name="formType">
    <div class="row">
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-user bx-sm'></i>
                <label>First Name</label>		
                <input type="text" value="{{ $formType == 'update' ? $addressDB['firstName'] : '' }}" name="firstName" placeholder="First Name">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-user bx-sm'></i>
                <label>Last Name</label>
                <input type="text" value="{{ $formType == 'update' ? $addressDB['lastName'] : '' }}" name="lastName" placeholder="Last Name">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-map bx-sm'></i>
                <label>Country</label>
                {{-- <input type="text" value="{{ $formType == 'update' ? $addressDB['country'] : '' }}" name="country" placeholder="Country"> --}}
                <select name="country" placeholder="Country">
                    @foreach ($countries as $countriesItem)
                        <option value="{{ $countriesItem['id'] }}" <?php if ($formType == 'update') { ?>{{ $countriesItem['id'] == $addressDB['country'] ? 'selected' : ''  }}<?php }?> > 
                            {{ $countriesItem['country_name'] }} (+ {{ $countriesItem['phoneCode'] }} )
                        </option>
                    @endforeach                                    
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-phone bx-sm'></i>
                <label>Phone Number</label>
                <input type="tel" value="{{ $formType == 'update' ? $addressDB['phoneNumber'] : '' }}" name="phoneNumber" placeholder="Phone Number">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-map bx-sm'></i>
                <label>City</label>
                <input type="text" value="{{ $formType == 'update' ? $addressDB['city'] : '' }}" name="city" placeholder="City">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">               
                <i class='bx bx-map bx-sm'></i>
                <label>Zip code</label>
                <input type="number" value="{{ $formType == 'update' ? $addressDB['zipCode'] : '' }}" name="zipCode" placeholder="Zip code">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-map bx-sm'></i>
                <label>Street</label>
                <input type="text" value="{{ $formType == 'update' ? $addressDB['street'] : '' }}" name="street" placeholder="Street">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                <i class='bx bx-map bx-sm'></i>
                <label>State/province/area</label>
                <input type="text" value="{{ $formType == 'update' ? $addressDB['area'] : '' }}" name="area">
            </div>
        </div>                   
        <div class="col-12 col-lg-10">
            <div class="formField">
                <i class='bx bx-map bx-sm'></i>
                <label>Address</label>
                <textarea type="text" value="{{ $formType == 'update' ? $addressDB['address'] : '' }}" name="address" class="autosize" rows="3" placeholder="Address">{{ $formType == 'update' ? $addressDB['address'] : 'Address' }}</textarea>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="formField">
                @php
                    if($formType == 'update'){
                        if ($addressDB['aDefault'] == 1) {
                            $aDefault = 'checked';
                        }
                        else {
                            $aDefault = '';
                        }
                    }
                    else {
                            $aDefault = '';
                        }
                @endphp                           
                <input type="checkbox" name="addDefaultCheck" class="checkboxInp" {{ $aDefault }}>
                <label>Make Default</label>
            </div>
        </div>
        <div class="col-12">
            <div class="formBtnGroup">                
                <button class="themeBtn">Save Changes</button>
            </div>
        </div>
    </div>
</form>
<a href="{{ route('user.addressBook') }}"><button class="themeBtn themeBtn--fade">Cancel</button></a>
@endsection
@section('js')
<script> 
     $(document).on('submit','#cRUDAddress', function(e) {    
          e.preventDefault();
          var _thisForm = $(this);                           
          var validationAllowed = true;     
          var formData = new FormData($(this)[0]);         
          $.ajax({
          type    : $(this).attr('method'),
          data    : formData,
          async: true,
          contentType: false,
          processData: false,
          url     : $(this).attr('action'),
          beforeSend: function (request) {    
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
          },
          success: function (result) {
            console.log(result);   
            if (result['status'] == 'notify_success') {               
              $('#cRUDAddress')[0].reset();                               
              generateNotification('1',result['msg']); 
              setTimeout(() => {
                window.location.href = '/user_addressBook';
              }, 1300); 
            } else { 
              $('#cRUDAddress')[0].reset();   
              generateNotification('0',result['msg']);                 
            } 
          },
          error:function (error) {       
              generateNotification('0','Some Error Occured'); 
              console.log(error);                                         
          }
          });
          return false;
      });
</script>
@endsection

@extends('user.layout.master')
@section('css')

@endsection
@section('content')
 <div class="mainTitle">
                <h3>Edit Profile</h3>
            </div>
            <form action="#" class="themeForm">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="formField">
                            <i class='bx bx-user bx-sm'></i>
                            <label>Full Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" placeholder="First Name">
                        </div>
                    </div>                   
                    <div class="col-12 col-lg-5">
                        <div class="formField">
                            <i class='bx bx-envelope bx-sm'></i>
                            <label>Email Address</label>
                            <input type="email" value="{{ Auth::user()->email }}" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="formField">
                            <i class='bx bx-user bx-sm'></i>
                            <label>Country</label>                           
                            <select>
                                @foreach ($countries as $countriesItem)
                                    <option value="{{ $countriesItem['id'] }}" {{ $countriesItem['id'] == Auth::user()->country ? 'selected' : ''  }}> 
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
                            <input class="input-mask" data-mask="(000) 000-0000" placeholder="eg: (000) 000-0000" maxlength="14" type="tel" value="{{ Auth::user()->phoneNo }}"  placeholder="Phone Number">                                                      
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="formField">
                            <i class='bx bx-cake bx-sm'></i>
                            <label>Birthday</label>
                            <input type="date" value="{{ Auth::user()->dOB }}" placeholder="Birthday">
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="formField">
                            <i class='bx bx-group bx-sm'></i>
                            <label>Gender</label>
                            <select>
                                <option value="male" {{ 'male' == strtolower(Auth::user()->gender) ? 'selected' : ''  }}>
                                    Male
                                </option>
                                <option value="female" {{ 'female' == strtolower(Auth::user()->gender) ? 'selected' : ''  }}>
                                    Female
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"  class="themeBtn">Save Changes</button>
                    </div>
                </div>
            </form>
@endsection
@section('js')
<script src="{{ asset('admin/vendors/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
@endsection

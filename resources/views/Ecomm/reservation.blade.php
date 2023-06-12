@extends('layouts.master')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="body booking-sec">

        <!-------------- reservations sec start ---------------->
        <section id="re-from-sec">
            <h2 class="re-h2">Reservations:</h2>
            <div class="pak-line"></div>
            <div class="re-form-wrap abt-container">

                <form action="{{ route('reservation_submit') }}" method="POST" id="reservationForm">
                    @csrf
                    <input type="text" name="packageId" value="{{ !empty($packageData->Id) ? $packageData->Id : '' }}"
                        class="re-field" hidden>

                    <div class="re-layout">
                        <div class="re-wrap">

                            <label class="re-lable">Package:</label>
                            <input type="text" class="re-field layout-field" value="{{ $packageData->pName }}" readonly>
                        </div>
                        <div class="re-wrap">
                            <label class="re-lable">Booking id:</label>
                            <input type="text" class="re-field layout-field" name="bookingId"
                                value="{{ $packageData->pBookingId }}" readonly>

                        </div>
                    </div>


                    <div class="re-layout">
                        <div class="re-wrap">

                            <label class="re-lable">First Name:</label>
                            <input type="text" name="fName" class="re-field layout-field" placeholder="First" required>

                        </div>
                        <div class="re-wrap">
                            <label class="re-lable">Last Name:</label>
                            <input type="text" name="lName" class="re-field layout-field" placeholder="Last" required>

                        </div>
                    </div>



                    <div class='re-layout'>
                        <div class="re-wrap">
                            <label class="re-lable">Email: <span class="respan">*</span></label>
                            <input type="email" name="email" class="re-field layout-field" required>
                        </div>

                        <div class="re-wrap">
                            <label class="re-lable">Phone: <span class="respan">*</span></label>
                            <input type="text" id="phone" name="phone" class="re-field layout-field" required>
                        </div>

                    </div>

                    <div class='re-layout'>

                        <div class="re-wrap">
                            <label class="re-lable">Pickup Address: <span class="respan">*</span></label>
                            <textarea name="pickupAddress" class="re-msg layout-field" required></textarea>
                        </div>

                        <div class="re-wrap">
                            <label class="re-lable">Destination Address: <span class="respan">*</span></label>
                            <textarea name="destinationAddress" class="re-msg layout-field" required></textarea>
                        </div>

                    </div>

                    <div class='re-layout'>

                        <div class="re-wrap">
                            <label class="re-lable">Departure Date: <span class="respan">*</span></label>
                            <input type="date" id="departureDate" name="departureDate" class="re-field layout-field"
                                required>
                        </div>

                        <div class="re-wrap">
                            <label class="re-lable">Departure Time: <span class="respan">*</span></label>
                            <input type="time" id="departureTime" name="departureTime" class="re-field layout-field"
                                required>
                        </div>

                    </div>

                    <div class='re-layout'>

                        <div class="re-wrap">
                            <label class="re-lable">Return Date: <span class="respan">*</span></label>
                            <input type="date" id="returnDate" name="returnDate" class="re-field layout-field" required>
                        </div>

                        <div class="re-wrap">
                            <label class="re-lable">Return Time: <span class="respan">*</span></label>
                            <input type="time" id="returnTime" name="returnTime" class="re-field layout-field" required>
                        </div>

                    </div>



                    <div class="re-layout">

                        <div class="re-wrap">
                            <label class="re-lable">Number of Passengers: <span class="respan">*</span> </label>
                            <input type="number" name="noOfPassengers" class="re-field layout-field" required>
                        </div>

                        <div class="re-wrap">
                            <label class="re-lable">Number of Days: <span class="respan">*</span></label>
                            <input type="number" id="number" name="noOfDays" class="re-field layout-field"
                                value="{{ $packageData->noOfDays }}" readonly>
                        </div>
                    </div>


                    <div class="re-layout">
                        <div class="re-wrap">
                            <label class="re-lable">Additional Message: <span class="respan">*</span></label>
                            <textarea name="additionalMsg" class="re-msg" required></textarea>
                        </div>
                    </div>



                    <button class="btn re-btn">SUBMIT</button>
            </div>
            </form>
            </div>
        </section>
    </section>
@endsection
@section('js')
@endsection

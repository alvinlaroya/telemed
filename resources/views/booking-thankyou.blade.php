@extends('layouts.home')

@section('content')

<div style="height: 75vh;">
    <div class="container">
        <div class="py-5 text-center">
            @if(session()->has('success'))
            <h2 style="color: #010d6f !important;">Request Successful</h2>
            <br />
            <p>Your request has been submitted.</p>
            <p>{{session()->get('success')}}</p>
            <br />
            @else
            <h2 style="color: #010d6f !important;">Booking Successful</h2>
            <br />
            @endif
        </div>

        <div class="py-5 text-center">
            <a href="/" type="button" class="btn btn-primary"><i class="fa fa-home"></i> Go Back to Home</a>
        </div>
    </div>
</div>



@endsection

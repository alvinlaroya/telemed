@extends('layouts.center')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
@endpush

@section('content')

<div class="page-header">
	<h1 class="h2">Account Settings</h1>
</div>

<form action="{{ route('center.settings.save-account') }}" method="post">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Change Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
                <label for="exampleInputPassword2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        Update Account
    </button>
    <hr>
</form>

<div class="page-header">
	<h1 class="h2">General Settings</h1>
</div>

<form action="{{ route('center.settings.save') }}" method="post">
	@csrf
    @method('put')
    @foreach(auth()->user()->centers as $center)
        <div class="card mb-4">
            <div class="card-header px-3 py-3">
                <h5 class="mb-0"><strong>{{ $center->name }}</strong></h5>
            </div>
            <div class="card-body">
                <div class="form-group @error('centers.'.$center->id.'.emails') is-invalid @enderror">
                    <label for="centers[{{ $center->id }}][emails]">
                        E-mail to Receive Notifications ( For multiple recipients put a comma in between e-mail addresses )
                    </label>
                    <input type="text" name="centers[{{ $center->id }}][emails]" class="form-control @error('centers.'.$center->id.'.emails') is-invalid @enderror"
                    id="centers[{{ $center->id }}][emails]" value="{{ old('centers.'.$center->id.'.emails', $center->email_to_receive_notifications) }}" data-role="tagsinput" >
                    @error('centers.'.$center->id.'.emails')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('centers.'.$center->id.'.mobiles') is-invalid @enderror">
                    <label for="centers[{{ $center->id }}][mobiles]">Mobile to Receive Notifications ( For multiple recipients put a comma in between mobile numbers ) ( Ex. 09171234567 )</label>
                    <input type="text" name="centers[{{ $center->id }}][mobiles]" class="form-control @error('centers.'.$center->id.'.mobiles') is-invalid @enderror"
                    id="centers[{{ $center->id }}][mobiles]" value="{{ old('centers.'.$center->id.'.mobiles', $center->mobile_to_receive_notifications) }}" data-role="tagsinput" >
                    @error('centers.'.$center->id.'.mobiles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endforeach
    <hr>
    <button type="submit" class="btn btn-primary">
        Update Settings
    </button>
</form>

@endsection

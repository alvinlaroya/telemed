@extends('layouts.admin')

@push('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">SMS Notifications</li>
@endpush

@section('content')

    <div class="page-header">
        <h1 class="h2">SMS Notifications</h1>
    </div>

    <form action="" method="post">
        @csrf
        @foreach($cogs as $key => $group)
            <div class="card mb-3">
                <div class="card-header customCardHeader">
                    <h5 class="mb-0">
                        @isset(\App\SmsNotifSettings::$group[$key])
                            {{ \App\SmsNotifSettings::$group[$key] }}
                        @endisset
                        <em style="font-size: .6em;">(Uncheck to disable SMS notification)</em>
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($group as $key => $cog)
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ $cog->id }}" {{ $cog->value ? 'checked' : '' }} name="settings[{{ $cog->name }}]">
                                <label class="form-check-label" for="{{ $cog->id }}">
                                    <h6 class="mb-0">@isset(\App\SmsNotifSettings::$labels[$cog->name])
                                            {{ \App\SmsNotifSettings::$labels[$cog->name] }}
                                        @else
                                            --
                                        @endisset</h6>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection

@extends('layouts.home')

@section('content')

    <div class="error-page">
        <div>
            <h1>403</h1>
            <h3>{{ $exception->getMessage() ? $exception->getMessage() : 'Sorry, you are forbidden to access this page.' }}
            </h3>
        </div>
    </div>


@endsection

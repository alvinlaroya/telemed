@if(session()->has('success'))
    <div class="alert alert-success mb-5" role="alert">
        <h4 class="alert-heading">
            @isset($customHeading)
            {!! $customHeading !!}
            @else
            Booking Successfuly!
            @endisset
        </h4>
        <p>{{session()->get('success')}}</p>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger mb-5" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p>{{ session()->get('error') }}</p>
    </div>
@elseif(session()->has('errors'))
    <div class="alert alert-danger mb-5" role="alert">
        <h4 class="alert-heading">Booking Failed!</h4>
        @foreach (session()->get('errors')->getMessages() as $errors)
            <p>{{ $errors[0] }}</p>
        @endforeach
    </div>
@endif

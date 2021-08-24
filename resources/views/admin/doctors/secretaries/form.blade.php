
{!! Form::model($secretary, [
	'method' => !$secretary->exists ?: 'put',
	'route' => $secretary->exists ? ['admin.doctors.secretaries.update', $doctor, $secretary] : ['admin.doctors.secretaries.store', $doctor]
    ]) !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                id="name" value="{{ old('name', $secretary->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="lastName" value="{{ old('email', $secretary->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="exampleInputPassword2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
    <button type="submit" class="btn btn-primary">
        {{ $secretary->exists ? 'Update' : 'Submit' }}
    </button>

{!! Form::close() !!}


{!! Form::model($user, [
	'method' => !$user->exists ?: 'put',
	'route' => $user->exists ? ['admin.users.update', $user] : 'admin.users.store'
    ]) !!}
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                id="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="lastName" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="custom-select" id="userRolesDropdown">
                    @foreach(App\User::$adminRoles as $value => $label)
                    <option value="{{$value}}"
                        {{ $value == old('role', $user->role) ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group toggleCenters" style="display:none">
                <label for="serviceCategoryDropdown">Assign Centers</label>
                <select name="centers[]" multiple data-multiple="true" class="form-control select2-hidden @error('centers') is-invalid @enderror" id="serviceCategoryDropdown"
                data-action="{{ route('admin.service-categories.index') }}"
                data-value="{{ old('centers') ? implode(',', old('centers')) : $user->centers()->pluck('service_categories.id')->implode(',') }}">
                </select>
                @error('centers')
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
    <div class="row">
        <div class="col-auto pr-1">
            <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
            <button type="submit" class="btn btn-primary">
                {{ $user->exists ? 'Update' : 'Submit' }}
            </button>
        </div>
        <div class="col">
            <div class="col-auto my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" name="status" class="custom-control-input" id="active" value="1" {{ (old('status', $user->status) == 1) || !isset($user->status) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
        </div>
    </div>

{!! Form::close() !!}


{!! Form::model($hmoAccreditation, [
    'id' => 'accreditationForm',
	'method' => !$hmoAccreditation->exists ?: 'put',
	'route' => $hmoAccreditation->exists ? ['admin.hmo-accreditations.update', $hmoAccreditation] : 'admin.hmo-accreditations.store'
    ]) !!}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="accredName">Name</label>
                <input type="text" name="accredName" class="form-control @error('accredName') is-invalid @enderror"
                id="accredName" value="{{ old('accredName', $hmoAccreditation->name) }}">
                <div class="invalid-feedback @if(!$errors->has('accredName')) d-none @endif">
                    @error('accredName')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $hmoAccreditation->description) }}</textarea>
            </div>
        </div> --}}
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
    <button type="submit" class="btn btn-primary">
        {{ $hmoAccreditation->exists ? 'Update' : 'Submit' }}
    </button>

{!! Form::close() !!}


{!! Form::model($specialization, [
    'id' => 'specializationForm',
	'method' => !$specialization->exists ?: 'put',
	'route' => $specialization->exists ? ['admin.specializations.update', $specialization] : 'admin.specializations.store'
    ]) !!}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="specName">Name</label>
                <input type="text" name="specName" class="form-control @error('specName') is-invalid @enderror"
                id="specName" value="{{ old('specName', $specialization->name) }}">
                <div class="invalid-feedback @if(!$errors->has('specName')) d-none @endif">
                    @error('specName')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        @if(count($parents) > 0)
            <div class="col-12">
                <div class="form-group">
                    <label for="parentSpecialization">Parent</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="parentSpecialization">
                        <option value="">-- Select Parent --</option>
                        @foreach($parents as $key => $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $specialization->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        {{-- <div class="col-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $specialization->description) }}</textarea>
            </div>
        </div> --}}
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
    <button type="submit" class="btn btn-primary">
        {{ $specialization->exists ? 'Update' : 'Submit' }}
    </button>

{!! Form::close() !!}

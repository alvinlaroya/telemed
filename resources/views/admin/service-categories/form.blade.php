
{!! Form::model($serviceCategory, [
    'id' => 'serviceCategoryForm',
	'method' => !$serviceCategory->exists ?: 'put',
	'route' => $serviceCategory->exists ? ['admin.service-categories.update', $serviceCategory] : 'admin.service-categories.store'
    ]) !!}
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="categoryName">Name</label>
                <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @enderror"
                id="categoryName" value="{{ old('categoryName', $serviceCategory->name) }}">
                <div class="invalid-feedback @if(!$errors->has('categoryName')) d-none @endif">
                    @error('categoryName')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        @if(count($parents) > 0)
            <div class="col">
                <div class="form-group">
                    <label for="parentCategory">Main Center</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="parentCategory">
                        <option value="">-- Select Main Center --</option>
                        @foreach($parents as $key => $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $serviceCategory->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $serviceCategory->description) }}</textarea>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                id="email" value="{{ old('email', $serviceCategory->email) }}">
                <div class="invalid-feedback @if(!$errors->has('email')) d-none @endif">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                id="telephone" value="{{ old('telephone', $serviceCategory->telephone) }}">
                <div class="invalid-feedback @if(!$errors->has('telephone')) d-none @endif">
                    @error('telephone')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group @error('email_to_receive_notifications') is-invalid @enderror">
                <label for="email_to_receive_notifications">E-mail to Receive Notifications ( For multiple recipients put a comma in between e-mail addresses )</label>
                <input type="text" name="email_to_receive_notifications" class="form-control @error('email_to_receive_notifications') is-invalid @enderror"
                id="email_to_receive_notifications" value="{{ old('email_to_receive_notifications', $serviceCategory->email_to_receive_notifications) }}" data-role="tagsinput" >
                <div class="invalid-feedback @if(!$errors->has('email_to_receive_notifications')) d-none @endif">
                    @error('email_to_receive_notifications')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group @error('mobile_to_receive_notifications') is-invalid @enderror">
                <label for="mobile_to_receive_notifications">Mobile to Receive Notifications | <small style="color:#e3342f">Ex: 09123456789</small> | ( For multiple recipients put a comma in between mobile numbers )</label>
                <input type="text" name="mobile_to_receive_notifications" class="form-control @error('mobile_to_receive_notifications') is-invalid @enderror"
                id="mobile_to_receive_notifications" value="{{ old('mobile_to_receive_notifications', $serviceCategory->mobile_to_receive_notifications) }}" data-role="tagsinput" >
                <div class="invalid-feedback @if(!$errors->has('mobile_to_receive_notifications')) d-none @endif">
                    @error('mobile_to_receive_notifications')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto pr-1">
            <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
            <button type="submit" class="btn btn-primary">
                {{ $serviceCategory->exists ? 'Update' : 'Submit' }}
            </button>
        </div>
        <div class="col">
            <div class="col-auto my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" name="status" class="custom-control-input" id="active" value="1" {{ (old('status', $serviceCategory->status) == 1) || !isset($serviceCategory->status) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
        </div>
    </div>

{!! Form::close() !!}

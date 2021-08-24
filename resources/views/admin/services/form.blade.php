
{!! Form::model($service, [
	'method' => !$service->exists ?: 'put',
	'route' => $service->exists ? ['admin.services.update', $service] : 'admin.services.store'
    ]) !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                id="name" value="{{ old('name', $service->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="productCode">Product Code</label>
                <input type="text" name="productCode" class="form-control @error('productCode') is-invalid @enderror"
                id="productCode" value="{{ old('productCode', $service->product_code) }}">
                @error('productCode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col pr-0">
                    <div class="form-group">
                        <label for="serviceCategoryDropdown">Center</label>
                        <select name="category" class="form-control @error('category') is-invalid @enderror" id="serviceCategoryDropdown" data-action="{{ route('admin.service-categories.index') }}" data-value="{{ old('category', $service->category_id) }}">
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-auto" style="margin-top: 30px">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#serviceCategoryModal" class="btn btn-primary">Add Center</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label for="price">Price</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">₱</div>
                </div>
                <input type="number" name="price" min="0" step="0.01" class="form-control @error('price') is-invalid @enderror"
                id="price" value="{{ old('price', $service->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $service->description) }}</textarea>
            </div>
        </div>
        <div class="col mb-3">
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" name="eligible" class="custom-control-input" id="eligible" value="1"
                {{ (old('eligible', $service->eligible) == 1) ? 'checked' : '' }} {{ ($service->exists) ?: 'checked' }}>
                <label class="custom-control-label" for="eligible">Eligible for Senior/PWD discount.</label>
            </div>
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" name="status" class="custom-control-input" id="active" value="1" {{ (old('status', $service->status) == 1) || !isset($service->status) ? 'checked' : '' }}>
                <label class="custom-control-label" for="active">Active</label>
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
    <button type="submit" class="btn btn-primary">
        {{ $service->exists ? 'Update' : 'Submit' }}
    </button>

{!! Form::close() !!}

<div class="modal fade" id="serviceCategoryModal" tabindex="-1" role="dialog" aria-labelledby="serviceCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceCategoryModalLabel">Add Center</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.service-categories.form', [
                    'serviceCategory' => new App\ServiceCategory,
                    'parents' => $parents
                ])
            </div>
        </div>
    </div>
</div>

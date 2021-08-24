@if(count($settings) > 0)
    <form action="{{ route('admin.update-settings') }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            @foreach($settings as $key => $setting)
                <div class="col-12">
                    <div class="form-group @error("settings.{$setting->name}") is-invalid @enderror">
                        @if($setting->type == 'tags')
                            <label for="{{ $setting->name }}">{!! $setting->title !!}</label>
                            <input type="text" name="settings[{{ $setting->name }}]" id="{{ $setting->name }}" value="{{ old("settings.{$setting->name}", $setting->value) }}" class="form-control @error("settings.{$setting->name}") is-invalid @enderror" data-role="tagsinput" />
                            @error("settings.{$setting->name}")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @elseif($setting->type == 'toggle')
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" name="settings[{{ $setting->name }}]" class="custom-control-input" id="{{ $setting->name }}" value="1" {{ $setting->value == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="{{ $setting->name }}">{{ $setting->title }}</label>
                            </div>
                        @elseif($setting->type == 'textarea')
                            <label for="{{ $setting->name }}">{{ $setting->title }}</label>
                            <textarea name="settings[{{ $setting->name }}]" id="{{ $setting->name }}" class="form-control" rows="5">{{ old("settings.{$setting->name}", $setting->value) }}</textarea>
                        @endif
                        @error($setting->name)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-danger mr-2">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@else
    <p>Ooops. Nothing to update here...</p>
@endif

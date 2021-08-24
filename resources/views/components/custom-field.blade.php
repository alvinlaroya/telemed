@if($field->type == 'field')
    <label for="field_{{ $field->id }}">{{ $field->question }}</label>
    <input type="text" name="answers[{{ $center->id }}][fields][{{ $field->id }}][answer]" class="form-control" id="field_{{ $field->id }}" {{ $field->required ? 'required' : '' }}>
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{$field->id}}][type]"
        value="{{ $field->type }}">
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{$field->id}}][question]"
        value="{{ $field->question }}">
    @if($field->required)
    <div class="invalid-feedback">This field cannot be empty.</div>
    @endif
@endif

@if($field->type == 'text')
    <label for="field_{{ $field->id }}">{{ $field->question }}</label>
    <textarea name="answers[{{ $center->id }}][fields][{{ $field->id }}][answer]" class="form-control" id="field_{{ $field->id }}" rows="3" {{ $field->required ? 'required' : '' }}></textarea>
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][type]" value="{{ $field->type }}">
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][question]" value="{{ $field->question }}">
    @if($field->required)
        <div class="invalid-feedback">This field cannot be empty.</div>
    @endif
@endif

@if($field->type == 'radio')
    <label class="d-block" for="field_{{ $field->id }}">{{ $field->question }}</label>
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][type]" value="{{ $field->type }}">
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][question]" value="{{ $field->question }}">
    @foreach($field->options as $innerKey => $option)
    <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" type="radio" name="answers[{{ $center->id }}][fields][{{ $field->id }}][arr_answer]" id="fieldoption_{{ $field->id . '-' . $innerKey }}" value="{{ $option }}" {{ $field->required ? 'required' : '' }}>
        <label class="custom-control-label" for="fieldoption_{{ $field->id . '-' . $innerKey }}">
            {{ $option }}
        </label>
    </div>
    @endforeach
    @if($field->required)
        <div class="invalid-feedback">This field cannot be empty.</div>
    @endif
@endif

@if($field->type == 'checkbox')
    <label class="d-block" for="field_{{ $field->id }}">
        {{ $field->question }}
    </label>
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][type]" value="{{ $field->type }}">
    <input type="hidden" name="answers[{{ $center->id }}][fields][{{ $field->id }}][question]" value="{{ $field->question }}">
    @foreach($field->options as $innerKey => $option)
    <div class="custom-control custom-checkbox custom-control-inline">
        <input class="custom-control-input" type="checkbox" name="answers[{{ $center->id }}][fields][{{ $field->id }}][arr_answer][]" id="fieldoption_{{ $field->id . '-' . $innerKey }}" value="{{ $option }}">
        <label class="custom-control-label" for="fieldoption_{{ $field->id . '-' . $innerKey }}">
            {{ $option }}
        </label>
    </div>
    @endforeach
    @if($field->required)
        <div class="invalid-feedback">This field cannot be empty.</div>
    @endif
@endif

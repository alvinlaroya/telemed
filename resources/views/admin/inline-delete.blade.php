<form action="{{$action}}" method="post" class="d-inline" title="Delete">
	{!! csrf_field() !!}
	<input type="hidden" name="_method" value="delete">
	<button type="submit" class="btn btn-sm btn-danger confirmDelete {{ isset($icon) && false == $icon ? 'inline-del' : '' }}" data-confirm-text="{{ isset($confirmText) ? $confirmText : '' }}">
		@if(isset($icon) && false == $icon)
		Delete
		@else
		<i class="fa fa-trash" aria-hidden="true"></i>
		@endif
	</button>
</form>
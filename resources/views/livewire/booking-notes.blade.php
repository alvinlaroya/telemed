<div>
	<div class="form-group">
	    <label for="bNotes">Admin Notes</label>
	    <textarea wire:model.lazy="notes" class="form-control" id="bNotes"></textarea>
	</div>
	<div>
		<button wire:click="saveNotes" type="button" class="btn float-right btn-primary"
			wire:loading.attr="disabled">
			Save
		</button>
		<div wire:loading.class.remove="d-none" wire:target="saveNotes"
			class="d-none text-success">
			Saving notes...
		</div>
	</div>
</div>


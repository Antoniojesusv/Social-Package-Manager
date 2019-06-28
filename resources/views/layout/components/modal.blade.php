<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{ $formHeader }}
        <div class="modal-body">
            {{ $body }}
        </div>
        <div class="modal-footer">
            {{ $footer }}
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
        {{ $slot }}
    </div>
</div>
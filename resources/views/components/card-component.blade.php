<div class="card">
    <div class="card-header">{{ __('Drag & Drop') }}</div>

    <div class="card-body">
        {{ $slot }}
            
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div id="trash" class="grid-trash">
                Drag a <b>team</b> or <b>user</b> here to delete it
                </div>
            </div>
        </div>
    </div>
</div>
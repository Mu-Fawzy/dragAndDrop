<div class="card">
    <div class="card-header">{{ __('Admin Menu') }}</div>

    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('admin.home') }}">Home</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.boxes.index') }}">Boxes</a>
            </li>
        </ul>
    </div>
</div>
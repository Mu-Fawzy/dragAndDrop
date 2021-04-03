<div class="card">
    <div class="card-header"><h4 class="content-title mb-0 my-auto">{{ __('القائمة') }}</h4></div>

    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('admin.home') }}">الخطط</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.boxes.index') }}">الاقسام</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.items.index') }}">العناصر</a>
            </li>
        </ul>
    </div>
</div>
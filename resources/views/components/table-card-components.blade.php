<div class="card">
    <div class="card-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ $title }}</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto left-content">{{ $slogan }}</div>
    </div>
    <div class="card-body">
        <div class="btns mb-3">
            <a href="{{ route('admin.'.$pluralModelName.'.create') }}" class="btn btn-primary btn-sm">اضف {{ $lowerModelName }}</a>
        </div>
        {{ $slot }}
    </div>
</div>
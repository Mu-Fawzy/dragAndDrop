<div id='loader'>
    <img src='{{ asset("assets/img/loading.gif") }}'>
</div>
<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">اسم الخطة</th>
            <th scope="col">تاريخ الانشاء</th>
            <th scope="col">العمليات</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <div class="d-flex justify-content-right">
                        @include('backend.inc.buttons.show')
                        @include('backend.inc.buttons.edit')
                        @include('backend.inc.buttons.delete')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">{{ $nothingHere }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
{!! $items->links('pagination::bootstrap-4') !!}
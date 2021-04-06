<div id='loader'>
    <img src='{{ asset("assets/img/loading.gif") }}'>
</div>
<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">اسم العنصر</th>
            <th scope="col">المعلومات</th>
            <th scope="col">حالة العنصر</th>
            <th scope="col">اسم القسم</th>
            <th scope="col">تاريخ الانشاء</th>
            <th scope="col">العمليات</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->info }}</td>
                <td>
                    @if ($item->completed)
                        <span class='font-weight-bold text-success'>مكتمل</span>
                    @else
                        <span class='font-weight-bold text-secondary'>غير مكتمل</span>
                    @endif
                </td>
                <td>{{ $item->box->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <div class="d-flex justify-content-right">
                        @include('backend.inc.buttons.edit')
                        @include('backend.inc.buttons.delete')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ $nothingHere }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
{!! $items->links('pagination::bootstrap-4') !!}
<a href="{{ route('admin.'.$pluralModelName.'.destroy',$item->id) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirm('d-box-{{ $item->id }}');">Delete</a>
<form id="d-box-{{ $item->id }}" action="{{ route('admin.'.$pluralModelName.'.destroy',$item->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
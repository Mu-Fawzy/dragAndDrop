<a href="{{ route('admin.'.$pluralModelName.'.destroy',$item->id) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('d-box-{{ $item->id }}').submit();">Delete</a>
<form id="d-box-{{ $item->id }}" action="{{ route('admin.'.$pluralModelName.'.destroy',$item->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
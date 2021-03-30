{{-- 'box_id' --}}
<div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? old('name') }}" placeholder="{{ $lowerModelName }} name">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">Info</label>
    <input type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $item->info ?? old('info') }}" placeholder="{{ $lowerModelName }} info">
    @error('info')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
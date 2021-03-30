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

<div class="form-group">
    <label for="exampleFormControlInput1">Select Box</label>
    <select class="form-control @error('box_id') is-invalid @enderror" name="box_id">
        <option value="">Select Box</option>
        @foreach ($boxes as $box)
            <option value="{{ $box->id }}" {{ ($item->box_id ?? old('box_id')) == $box->id ? 'selected' : ''  }}>{{ $box->name }}</option>
        @endforeach
    </select>
    @error('box_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


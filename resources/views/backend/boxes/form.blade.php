<div class="form-group">
    <label for="exampleFormControlInput1">اسم القسم</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? old('name') }}" placeholder="{{ 'اسم '.trans_choice('drag.'.$pluralModelName, 1) }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
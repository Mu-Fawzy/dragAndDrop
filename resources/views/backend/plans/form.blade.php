<div class="form-group">
    <label for="exampleFormControlInput1">اسم الخطة</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? old('name') }}" placeholder="{{ 'اسم '.trans_choice('drag.'.$pluralModelName, 1) }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">وصف الخطة</label>
    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $item->description ?? old('description') }}" placeholder="{{ 'اسم '.trans_choice('drag.'.$pluralModelName, 1) }}">
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">اختر الاقسام التى تريدها فى الخطة</label>
    <select class="form-control @error('box_ids') is-invalid @enderror" name="box_ids[]" multiple>
        @foreach ($boxes as $box)
            <option value="{{ $box->id }}" {{ isset($item->boxes) ? ($item->boxes->contains($box->id) ? 'selected' : '') : old('box_id')  }}>
                {{ $box->name }}
            </option>
        @endforeach
    </select>
    @error('box_ids')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">اسم المهمة</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name ?? old('name') }}" placeholder="{{ 'اسم '.trans_choice('drag.'.$pluralModelName, 1) }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">معلومات المهمة</label>
    <input type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $item->info ?? old('info') }}" placeholder="{{ 'معلومات '.trans_choice('drag.'.$pluralModelName, 1) }}"> 
    @error('info')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">اختر صندوق المهام</label>
    <select class="form-control @error('box_id') is-invalid @enderror" name="box_id">
        <option value="">اختر صندوق المهام</option>
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


<form action="{{ route('servers.store') }}" method="post">
    @if($model->id)
        <input type="text" name="id" value="{{ $model->id }}" hidden>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Название: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="hostname" placeholder="Укажите название"
                       value="{{ $model->hostname }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Адрес: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="address" placeholder="Укажите адрес сервера"
                       value="{{ $model->address }}"
                       required>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="form-group">
                <label class="form-control-label">Описание:</label>
                <textarea name="description" rows="16" class="form-control editor">{{ $model->description }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-control-label">Правила:</label>
                <textarea name="rules" rows="16" class="form-control editor">{{ $model->rules }}</textarea>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3 mg-b-10">
            <button type="submit" class="btn btn-teal btn-block">Сохранить</button>
        </div>
    </div>
</form>

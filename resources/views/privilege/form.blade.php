<form action="{{ route('privileges.store') }}" method="post">
    @if($model->id)
        <input type="text" name="id" value="{{ $model->id }}" hidden>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Название: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="title" placeholder="Укажите название"
                       value="{{ $model->title }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Флаги доступа: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="flags" placeholder="Укажите флаги доступа"
                       value="{{ $model->flags }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Сервер: <span class="tx-danger">*</span></label>
                <select class="form-control select2-show-search select2-hidden-accessible" name="server_id" required>
                    @foreach($servers as $server)
                        <option value="{{ $server->id }}"
                                @if(($model->id && $server->id === $model->server_id)) selected @endif
                        >{{ $server->hostname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="ckbox">
                    <input type="checkbox" name="status"
                           value="1"
                           @if ($model->status === 1) checked @endif
                    >
                    <span>Доступно для покупки</span>
                </label>
            </div>

            <div class="form-group">
                <label class="section-title">Тарифы</label>
                <p>Срок - стоимость. Пример: <b>30-199</b> (30 дней за 199 руб)
                    <b>Навсегда = 0</b>
                </p>
                <input type="text" name="rates" value="@foreach($model->rates as $rate)
                {{ $rate->term }}-{{ $rate->price }},
                @endforeach" data-role="tagsinput">
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="form-group">
                <label class="form-control-label">Описание:</label>
                <textarea name="description" rows="16" class="form-control editor">{{ $model->description }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-control-label">Инструкции:</label>
                <textarea name="instruction" rows="16" class="form-control editor">{{ $model->instruction }}</textarea>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3 mg-b-10">
            <button type="submit" class="btn btn-teal btn-block">Сохранить</button>
        </div>
    </div>
</form>

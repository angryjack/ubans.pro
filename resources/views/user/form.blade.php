<form action="{{ route('users.store') }}" method="post">
    @if($form->user->id)
        <input type="text" name="id" value="{{ $form->user->id }}" hidden>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Почта: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="email" placeholder="Укажите почту"
                       value="{{ $form->user->email }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Логин: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nickname" placeholder="Укажите логин"
                       value="{{ $form->user->nickname }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Пароль: @if(!$form->user->id)<span class="tx-danger">*</span> @endif
                </label>
                <input class="form-control" type="text" name="password" placeholder="Укажите пароль"
                       value="{{ $form->user->password }}"
                       @if(!$form->user->id)
                       required
                    @endif
                >
            </div>

            <div class="form-group">
                <label class="form-control-label">Права:</label>
                <select class="form-control select2-show-search select2-hidden-accessible" name="role" required>
                    @foreach($form->user->role_list as $value => $title)
                        <option value="{{ $value }}"
                                @if(($form->user->id && $value === $form->user->role) ||
                                    $value === $form->user::ROLE_USER) selected @endif
                        >{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label">Уникальная ссылка: <span class="tx-danger">*</span></label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon ion-refresh tx-16 lh-0 op-6"></i></span>
                    </div>
                    <input class="form-control" type="text" name="auth_key" placeholder="Укажите ссылку"
                           value="{{ $form->user->auth_key ?? \Illuminate\Support\Str::random(15) }}"
                           disabled>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Тип админки:</label>
                <select class="form-control select2-show-search select2-hidden-accessible" name="flags" required>
                    @foreach($form->user->flag_list as $value => $title)
                        <option value="{{ $value }}"
                                @if(($form->user->id && $value === $form->user->flags) ||
                               $value === $form->user->flags) selected @endif
                        >{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label">Steam ID / IP / Ник: <span
                        class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="steamid" placeholder="Введите Steam ID или Ник:"
                       value="{{ $form->user->steamid }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-control-label">Флаги доступа на всех серверах:</label>
                <input class="form-control" type="text" name="access" placeholder="Введите флаги доступа"
                       value="{{ $form->user->access }}"
                >
            </div>

        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Услуги на серверах:</label>
                @foreach($form->servers as $server)
                    <label class="ckbox">
                        <input type="checkbox"
                               name="servers[{{ $server->id }}][on]"
                               onclick="if($(this).prop('checked')) {
                                   $('.sc-{{ $server->id }}').show();
                                   } else {
                                   $('.sc-{{ $server->id }}').hide();
                                   }"
                               @if($server->pivot) checked @endif
                        >
                        <span>{{ $server->hostname }}</span>
                    </label>
                    <div class="card mb-3 sc-{{ $server->id }}"
                         @if(!$server->pivot) style="display: none;" @endif>
                        <div class="card-body">
                            <h5 class="card-title tx-dark tx-medium mg-b-10">{{ $server->hostname }}</h5>
                            <div class="form-group">
                                <label class="form-control-label">Флаги доступа:</label>
                                <select class="form-control select2-show-search select2-hidden-accessible"
                                        name="servers[{{ $server->id }}][custom_flags]">
                                    @forelse($server->privileges as $privilege)
                                        <option value="{{ $privilege->flags }}"
                                                @if($server->pivot && $server->pivot->custom_flags === $privilege->flags)
                                                selected
                                            @endif
                                        >{{ $privilege->title }}</option>
                                    @empty
                                        <option value="" disabled>На сервере не добавлены услуги.</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Срок:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control fc-datepicker" placeholder="ДД-ММ-ГГГГ"
                                           name="servers[{{ $server->id }}][expire]"
                                           @if($server->pivot)
                                           value="{{ $server->pivot->expire }}"
                                        @endif
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-2 mb-3">
            <button type="submit" class="btn btn-teal btn-block">Сохранить</button>
        </div>
        @if($form->user->id)
            <div class="col-sm-3 col-md-2">
                <a href="{{ route('users.delete', ['id' => $form->user->id]) }}" class="btn btn-danger btn-block">Удалить</a>
            </div>
        @endif
    </div>
</form>

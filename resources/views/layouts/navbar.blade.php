@php

    use Illuminate\Support\Facades\Request;

    $menu = [
        [
            'href' => '',
            'title' => 'Главная',
            'icon' => 'home'
        ],
        [
            'href' => 'bans',
            'title' => 'Бан-лист',
            'icon' => 'list'
        ],
        [
            'href' => 'users',
            'title' => 'Пользователи',
            'icon' => 'people',
            'role' => \App\Models\User::ROLE_ADMIN
        ],
        [
            'href' => 'donations',
            'title' => 'Пожертвования',
            'icon' => 'heart'
        ],
        [
            'href' => 'servers',
            'title' => 'Сервера',
            'icon' => 'game-controller-b'
        ],
        [
            'href' => 'settings',
            'title' => 'Настройки',
            'icon' => 'gear',
            'role' => \App\Models\User::ROLE_ADMIN,
            'sub' => [
                'privileges' => 'Привилегии',
            ]
        ],
    ];

@endphp

<div class="slim-navbar">
    <div class="container">
        <ul class="nav">
            @foreach($menu as $item)
                @isset($item['role'])
                    @guest($item['role'])
                        @continue
                    @endif
                @endif
                <li class="nav-item @if(Illuminate\Support\Facades\Request::is($item['href']) ||
                Illuminate\Support\Facades\Request::is($item['href'] . '/*') ) active @endif @isset($item['sub']) with-sub @endif">
                    <a class="nav-link" href="/{{ $item['href'] }}">
                        <i class="icon ion-ios-{{ $item['icon'] }}-outline"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>
                    @isset($item['sub'])
                        <div class="sub-item">
                            <ul>
                                @foreach($item['sub'] as $link => $submenu)
                                    <li><a href="/{{ $link }}">{{ $submenu }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="//download-cs.net" target="_blank">
                        <i class="icon ion-ios-download-outline"></i>
                        <span>Скачать CS</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

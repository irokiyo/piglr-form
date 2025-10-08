<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gorditas&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Noto+Serif+JP:wght@200..900&family=Oleo+Script:wght@400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    @yield('css')

</head>
<body>
    <header class="admin-header">
        <h1 class="brand">PiGLy</h1>

        <div class="header-actions">
            <a href="" class="btn btn-ghost icon-left">
                <span class="icon">⚙️</span> 目標体重設定
            </a>

            {{-- ログアウト（POST） --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost">ログアウト</button>
            </form>
        </div>
    </header>

    @yield('content')
    </div>
    </div>
</body>
</html>


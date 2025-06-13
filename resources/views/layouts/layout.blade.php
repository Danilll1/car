<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap\css\bootstrap.min.css') }}">
</head>

<body>
    @if(session('success'))
        <div id="flash-message" class="alert alert-success position-fixed top-0 start-50 translate-middle-x"
            style="z-index: 1050; margin-top: 20px; width: fit-content;">
            {{ session('success') }}
        </div>
    @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const message = document.getElementById('flash-message');
            if (message) {
                // Через 2 секунды скрываем сообщение
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    // После исчезновения удаляем элемент из DOM
                    setTimeout(() => message.remove(), 500);
                }, 2000);
            }
        });
    </script>

    <header class="bg-light border-bottom mb-4">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center">
                <!-- Логотип можно вставить сюда -->
                <!-- <img src="path_to_logo.png" alt="Логотип" style="height:40px;"> -->
                <h1 class="h4 mb-0 ms-3" style="color: #6c757d;">
                    Едем, но это не точно
                </h1>
            </div>

            <div class="d-flex gap-2">
                @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                        <form action="{{ route('admin') }}" method="GET" style="display:inline-block;">
                            <button type="submit" class="btn btn-info text-white btn-sm" style="max-width: 100px;">
                                Админка
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-secondary text-white btn-sm" style="min-width: 100px;">
                            Выход
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </header>
    @yield('content')
</body>

</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ユーザー一覧</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-between">
            <div class="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="{{ route('home.index') }}">ホーム画面</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="{{ route('account.index') }}">ユーザー一覧</a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary">ログアウト</button>
            </form>
        </nav>
        <h1>ユーザー一覧画面</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>

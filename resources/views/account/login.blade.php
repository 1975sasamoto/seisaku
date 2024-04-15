<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ログイン</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <!-- セッションにエラーメッセージがある場合、それを表示する -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- セッションにメッセージがある場合、それを表示する -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- URLパラメータに 'error' キーが存在する場合、エラーメッセージを表示する -->
    @if (request('error'))
        <div class="alert alert-danger">
            @if (request('error') == '1')
                ログインしてください。
            @else
                不正な操作が行われました。
            @endif
        </div>
    @endif

    <!-- バリデーションエラーがある場合、それらをリスト形式で表示する -->
    @php
        $excludedErrors = [$errors->first('email'), $errors->first('password')];
        $otherErrors = array_diff($errors->all(), $excludedErrors);
    @endphp
    @if (count($otherErrors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($otherErrors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.doLogin') }}" method="POST">
        @csrf

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group text-center">
                        <h1>商品管理システム</h1>
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス <small class="bg-danger text-white">必須</small></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレスを入力してください" maxlength="255" value="{{ old('email', '') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード <small class="bg-danger text-white">必須</small></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを入力してください" maxlength="255">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-md mt-3" style="width: 50%;">ログイン</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('account.create') }}" method="get">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary btn-md mt-3" style="width: 50%;">アカウント登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

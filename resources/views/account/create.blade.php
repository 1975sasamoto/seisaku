<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>アカウント登録</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>

<body>
    @php
        $excludedErrors = [$errors->first('name'), $errors->first('email'), $errors->first('password')];
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
    <form action="{{ route('account.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group text-center">
                        <h1>商品管理システム</h1>
                    </div>
                    <div class="form-group">
                        <label for="name">名前 <small class="bg-danger text-white">必須</small></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前を入力してください" maxlength="255" value="{{ old('name', '') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                        <input type="password" class="form-control" id="password" name="password" placeholder="半角英数字またはハイフン(-)を入力してください" maxlength="255" autocomplete="new-password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">パスワード（確認） <small class="bg-danger text-white">必須</small></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="もう一度パスワードを入力してください" maxlength="255">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-md mt-3" style="width: 50%;" onclick='return confirm("アカウントを登録しますか？");'>アカウント登録</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('login') }}" method="get">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary btn-md mt-3" style="width: 50%;">戻る</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー編集</title>
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
  @include('parts.nav')

  <!---一覧に戻るボタン-->
  <a href="/user" button type=button class="btn btn-secondary">一覧に戻る</a>

  <div class="form-group text-center">
    <h2>編集画面</h2>
    <form action="/user/update" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">名前</label>
        <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}" required>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>


      <div class="radio-inline">

        <label class="form0label">権限</label><br>

        <input type="radio" name="is_admin" value="0" @if($user->is_admin==0) checked @endif >利用者
        <input type="radio" name="is_admin" value="1" @if($user->is_admin==1) checked @endif >管理者


        @error('radio')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

      </div>
  </div>


  <div class="row  text-center">

    <div class="col-5">

      <input type="hidden" name="id" value="{{$user->id}}">
      <input type="submit" class="btn btn-primary" value="保存">

      </form>
    </div>


    <div class="col-5">
      <form action="/user/{id}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <input type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')" value="削除">
      </form>
    </div>

  </div>

  </div>

</body>



</html>
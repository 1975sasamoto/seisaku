<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー一覧</title>
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>

<body>
    @include('parts.nav')

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <div class="form-group text-center">
        <h2>利用者一覧</h2>


        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>権限</th>
                    <th>登録日</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->id_admin}}
                        @if($user->is_admin == 0)
                        利用者
                        @elseif($user->is_admin == 1)
                        管理者
                        @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td><a href="/user/edit/{{$user->id}}" class="btn btn-primary">編集</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>



</body>

</html>
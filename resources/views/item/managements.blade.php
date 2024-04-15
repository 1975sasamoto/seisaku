<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head th:replace="header::head(~{::title})">
  <title>登録商品一覧</title>
</head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<body>
@include('parts.nav')

@if (session('message'))
            <div class="flash_message bg-success text-center py-3 my-0" style="background-color: rgba(0, 200, 0, 0.5); color: white; padding: 10px; font-size: 20px;">
                {{ session('message') }}
            </div>
        @endif

<div class="form-group text-center">
<h2>登録商品管理画面</h2>
</div>
<div class="text-right">
<button type="button" class="btn btn-primary" onclick="location.href='{{ route('items') }}'" aline="right">商品を登録する</button>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>商品名</th>
      <th>種別</th>
      <th>価格</th>
      <th>登録日時</th>
      <th>更新日時</th>
    </tr>
  </thead>
  <tbody>
              @foreach ($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                @if($item->type == 1)
                    食料品
                @elseif($item->type == 2)
                    衛生用品
                @elseif($item->type == 3)
                    衣類
                @elseif($item->type == 4)
                    医療品
                @elseif($item->type == 5)
                    情報機器
                @elseif($item->type == 6)
                    その他
                @endif
                </td>
                <td>{{ number_format($item->price, 0, '', '') }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td><a href="{{ route('edit', ['id'=>$item->id]) }}" class="btn btn-info">編集</a></td>
                <td>
                <form action="/item/destroy/{{$item->id}}" method="POST">
                @csrf
                <button type="submit"  class="btn btn-danger" onclick='return confirm("登録されたこの商品を削除しますか？");'>削除</button>
                </form>
                </td>
              </tr>
              @endforeach
            </tbody>

  
    </div>

</table>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>商品管理システム</title>
</head>

<body>
@include('parts.nav')

<form action="{{ route('update') }}" method="POST">
    @csrf
    <div class="col-md-6 offset-md-3">
        <div class="form-group text-center">
 
        @if($errors->has('id'))
         @foreach($errors->get('id') as $message)
                    <h6 class="text-danger">{{ $message }}</h6>
        @endforeach
        @endif 

            <h2>登録商品編集画面</h2>
            

            <div class="row" style="margin-top: 50px;">
                <div class="col-md">
                <div><label>商品名</label></div>
                    <div class="form-group">
                        @if($errors->has('name'))
                        @foreach($errors->get('name') as $message)
                        <h6 class="text-danger">{{ $message }}</h6>
                        @endforeach
                        @endif
                        <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}"  maxlength="200" placeholder="商品名を記入してください" value="{{ old('name') }}">
                    </div>
                    <div><label>種別</label></div>
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="type">
                            <option selected value="{{$item->type}}">
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
                            </option>
                            <option value="1">食料品</option>
                            <option value="2">衛生用品</option>
                            <option value="3">衣類</option>
                            <option value="4">医療品</option>
                            <option value="5">情報機器</option>
                            <option value="6">その他</option>
                        </select>
                    </div>
                    <div><label>詳細</label></div>
                    <div class="form-group">
                        @if($errors->has('detail'))
                        @foreach($errors->get('detail') as $message)
                        <h6 class="text-danger">{{ $message }}</h6>
                        @endforeach
                        @endif
                        <textarea class="form-control" id="detail" name="detail" rows="9" placeholder="商品の特徴や値段を記入してください">{{old('detail',$item->detail)}}</textarea>
                    </div>
                    <div><label>価格</label></div> <!-- 価格の入力欄を追加 -->
                    <div class="form-group">
                        @if($errors->has('price'))
                        @foreach($errors->get('price') as $message)
                        <h6 class="text-danger">{{ $message }}</h6>
                        @endforeach
                        @endif
                        <input type="text" class="form-control" id="price" name="price" value="{{$item->price}}" maxlength="200" placeholder="価格を記入してください" value="{{ old('price') }}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md mt-3" style="width: 50%" onclick='return confirm("以下の内容で更新します");'>登録</button>
                    </div>
                    <input type="hidden" name="id" value="{{$item->id}}">
                </div>
                
            </div>
            

            <hr>
            

        </div>
    </div>
</form>
    
<button type="button" class="btn btn-primary" onclick="location.href='{{ route('managements') }}'">一覧に戻る</button>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
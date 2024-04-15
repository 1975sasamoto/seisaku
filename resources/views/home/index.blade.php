<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ホーム画面</title>
    <link rel="stylesheet" href="/css/home.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
@include('parts.nav')
<div class="title">
    <h1>防災グッズホームサイト</h1>
</div>

<div class="container text-center">
    <div class="row">
    <div class=col-4>
            <a class="home-img" href="/home/1">
                <img src="/img/food.jpeg" alt="" class="food">
                <p>食料品</p>
            </a>
        </div>
        <div class=col-4>
            <a class="home-img" href="/home/2">
                <img src="/img/hygiene.jpeg" alt="" class="hygiene">
                <p>衛生用品</p>
            </a>
        </div>
        <div class=col-4>
            <a class="home-img" href="/home/3">
                <img src="/img/clothing.png" alt="" class="clothing">
                <p>衣類</p>
            </a>
        </div>
        <div class=col-4>
            <a class="home-img" href="/home/4">
                <img src="/img/medical.jpeg" alt="" class="medical">
                <p>医療用品</p>
            </a>
        </div>
        <div class=col-4>
            <a class="home-img" href="/home/5">
                <img src="/img/radio.png" alt="" class="radio">
                <p>情報機器</p>
            </a>
        </div>
        <div class=col-4>
            <a class="home-img" href="/home/6">
                <img src="/img/others.jpeg" alt="" class="others">
                <p>その他</p>
            </a>
        </div>
    </div>
    @isset($items)
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>商品名</th>
            <th>種別</th>
            <th>登録日</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>
                @if($item->type==1) 食料品
                @elseif($item->type==2) 衛生用品
                @elseif($item->type==3) 衣類
                @elseif($item->type==4) 医療用品
                @elseif($item->type==5) 情報機器
                @elseif($item->type==6) その他
                @endif

            </td>
            <td>{{$item->created_at}}</td>
        </tr>
        @endforeach
    </table>
    @endisset
    <br>
    <br>
</div>
</body>
</html>

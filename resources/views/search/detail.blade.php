<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細画面</title>
    <style>
        /* ページ全体の背景色を設定 */
        body {
            background-color: #ffdede; /* 薄い青色を設定 */
            margin: 0;
            padding: 0;
        }

        /* テーブルのスタイル */
        table {
            width: 100%; /* 画面いっぱいに広げる */
            border-collapse: collapse;
        }

        /* テーブルヘッダーのスタイル */
        th {
            background-color: #f2f2f2; /* 背景色を設定 */
            padding: 8px; /* セルの余白を設定 */
            text-align: left; /* 文字を左寄せにする */
            border: 1px solid #ddd; /* 境界線を設定 */
        }

        /* テーブルデータのスタイル */
        td {
            padding: 8px; /* セルの余白を設定 */
            text-align: left; /* 文字を左寄せにする */
            border: 1px solid #ddd; /* 境界線を設定 */
        }

        /* 交互に背景色を変えるためのスタイル */
        tr:nth-child(even) {
            background-color: #f9f9f9; /* 背景色を設定 */
        }

        /* 戻るボタンのスタイル */
        .back-button {
            background-color: #007bff; /* ボタンの背景色を青に設定 */
            color: #fff; /* テキスト色を白に設定 */
            border: none;
            border-radius: 5px;
            padding: 10px 20px; /* 上下左右のパディングを追加 */
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* テキストの下線を削除 */
            transition: background-color 0.3s ease; /* ホバー時のアニメーションを追加 */
        }

        /* ホバー時のスタイル */
        .back-button:hover {
            background-color: #0056b3; /* ボタンの背景色を濃い青に変更 */
        }

        /* 詳細記載のセルに上部の余白を追加 */
        .detail-cell {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<table border="1" cellspacing="0" cellpadding="0">
    <h1>商品詳細</h1>

    <tr>
        <td colspan="2">
            <nav>
                <div class="right-align">
                   <!-- <a href="/search/index" class="back-button">戻る</a> -->
                    <a href="javascript:history.back()"  class="back-button">戻る</a>
                </div>
            </nav>
        </td>
    </tr>

    <tr>
        <td>ID</td>
        <td>{{$item->id}}</td>
    </tr>
    <tr>
        <td>名前</td>
        <td>{{$item->name}}</td>
    </tr>
    <tr>
        <td>種別</td>
        <td>
            @if($item->type == 1)
                食料品
            @elseif($item->type == 2)
                衛生品
            @elseif($item->type == 3)
                衣類
            @elseif($item->type == 4)
                医療用品
            @elseif($item->type == 5)
                情報機器
            @elseif($item->type == 6)
                その他
            @else
            @endif
        </td>
    </tr>
    <tr>
        <td>価格</td>
        <td>{{ number_format($item->price, 0, '', '') }}円</td>
    </tr>


    <tr class="detail-cell">
        <td>商品詳細</td>
        <td>
            {!! nl2br($item->detail) !!}
        </td>
    </tr>
    <tr>
        <td>登録日</td>
        <td>{{$item->created_at}}</td>
    </tr>
    <tr>
        <td>更新日</td>
        <td>{{$item->updated_at}}</td>
    </tr>
</table>

</body>
</html>
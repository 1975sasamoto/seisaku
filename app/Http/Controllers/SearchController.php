<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{
    public function detail($id)
    {
        $item = Item::find($id);
        if (!$item) {
            abort(404);
        }
        return view('search.detail', compact('item'));
    }

    public function index(Request $request) 
    {
        // リクエストからキーワード、登録日、更新日の取得
        $keyword = $request->keyword;
        $created_at = $request->created_at;
        $updated_at = $request->updated_at;

        // クエリビルダーを使って検索条件を設定
        $query = Item::query();

        // キーワードがある場合は詳細と名前から検索
        if ($keyword) {
            $query->where('detail', 'LIKE', "%{$keyword}%")
                  ->orWhere('name', 'LIKE', "%{$keyword}%");
        }

        // 登録日が指定された場合は検索条件に追加
        if ($created_at) {
            $query->whereDate('created_at', $created_at);
        }

        // 更新日が指定された場合は検索条件に追加
        if ($updated_at) {
            $query->whereDate('updated_at', $updated_at);
        }

        // ページネーションを適用
        $items = $query->paginate(10);

        // 検索結果をビューに渡す
        return view('search.index', compact('items'));
    }
}
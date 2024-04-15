<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller


{
    //商品登録画面を表示
    public function create(Request $request)
    {
        $items = Item::orderBy('created_at', 'asc')->get();
        return view('item.items', [
            'items' => $items,
        ]);
    }

    //登録商品一覧画面を表示
    public function management(Request $request)
    {
        $items = Item::orderBy('created_at', 'asc')->get();
        return view('item.managements', compact('items'));
    }

    


    //商品登録処理
    public function register(Request $request)
    {      
        //バリデーションの設定
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'type' => 'required',
            'detail' => 'required|string|max:500',
            'price' => 'required|integer', // 価格のバリデーションを修正
        ],
        [   
            //バリデーションエラー時のメッセージ
            'name.required' => '商品名は必ず記入してください。',
            'name.max' => '100文字以内で記入してください。',
            'type.required' => '種別は必ず選択してください。',
            'detail.required' => '詳細は必ず記入してください。',
            'detail.max' => '500文字以内で記入してください'
            
        
        ]);

        //記入した情報をデータベースに保存
        Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'price' => $request->price, // 価格情報を保存
        ]);
        
        if($request) {
            session()->flash('message', '登録しました。');
        } 

        //登録したら一覧画面にリダイレクト
        return redirect()->route('managements');
    }
    
    //登録商品削除処理
    public function destroy(Request $request, $id)
    {  
        //itemsテーブルから指定のIDのレコードを1件取得
        $item = Item::find($id);
        //レコード削除
        $item->delete();
        //削除するときのフラッシュメッセージ
        if($request) {
            session()->flash('message', '削除しました。');
        } 
        //削除したら一覧画面にリダイレクト
        return redirect()->route('managements');
    }
    
    //登録商品の編集画面を表示
    public function edit(Request $request, $id)
    {
        //itemsテーブルから指定のIDのレコードを1件取得
        $item = Item::find($request->id);
        //想定以上の数値が入った場合の処理
        if (!$item) {abort(404);} 
        return view('item.edits',compact('item'));
    }

    //編集処理
    public function update(Request $request)
    {   
        //バリデーションの設定
        $this->validate($request, [
            'name' => 'required|max:100',
            'detail' => 'required|max:500',
            'price' => 'required|numeric',
        ],
        [   //バリデーションエラー時のメッセージ
            'name.required' => '商品名は必ず記入してください。',
            'name.max' => '100文字以内で記入してください。',
            'detail.required' => '詳細は必ず記入してください。',
            'detail.max' => '500文字以内で記入してください'
            

           
        ]);

            //itemsテーブルから指定のIDのレコードを1件取得
            $item = Item::find($request->id);
            // フォームから送信された情報でデータを更新
            $item->name = $request->input('name');
            $item->type = $request->input('type');
            $item->detail = $request->input('detail');
            $item->price = $request->input('price'); // フォームから送信された価格の入力値を取得してpriceカラムに代入
        
            //データを保存
        $item->save();
        
        //編集した時のフラッシュメッセージ
        if($request) {
            session()->flash('message', '更新しました。');
        } 
                // ページネーションを適用
                $items = $query->paginate(10);

        //編集完了後のリダイレクト
        return redirect()->route('managements');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; //ユーザーモデルを使用

class UserController extends Controller
{
    /**
     * 利用者一覧を表示する
     */
    public function index(Request $request)
    {
        $users = User::all(); //すべてのユーザーを取得
        return view('users.index', compact('users')); //viewにユーザーを渡す
    }

    /**
     * ユーザー編集画面を表示する
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * ユーザー編集処理
     */
    public function update(Request $request)
    {
        $ValidatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'is_admin' => 'required',
        ]);

        $user = User::find($request->id);
        $user->update($request->all());

        return redirect('/user')->with('status', '保存しました');
    }

    /**
     * ユーザー削除処理
     */
    public function delete(Request $request)
    {

        $user = User::find($request->id);
        $user->delete();
        return redirect('/user')->with('status', '削除しました');
    }
}

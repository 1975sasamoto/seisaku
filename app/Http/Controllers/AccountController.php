<?php

namespace App\Http\Controllers;

use App\Models\User;
// use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * アカウント登録画面を表示する
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * 新規アカウントの登録し、ログイン画面にリダイレクトする
     *
     * @param  Request  $request  リクエストオブジェクト
     * @return \Illuminate\Http\RedirectResponse ログイン画面へのリダイレクトレスポンス
     */
    public function store(Request $request)
    {
        // バリデーションルールを定義
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|max:255|regex:/^[A-Za-z0-9\-]+$/',
        ]);

        // アカウントの登録
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->is_admin = config('constants.user_roles.general'); // 利用者
        $user->save();

        // 成功した場合のフラッシュメッセージ
        session()->flash('message', 'アカウントの登録に成功しました。');

        // ログイン画面にリダイレクト
        return redirect()->route('login');
    }

    /**
     * ログイン画面を表示する
     */
    public function showLogin()
    {
        return view('account.login');
    }

    /**
     * アカウントをログインさせる
     *
     * @param  Request  $request  リクエストオブジェクト
     * @return \Illuminate\Http\RedirectResponse ホーム画面へのリダイレクトレスポンス
     */
    public function doLogin(Request $request)
    {
        // バリデーションルールを定義
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt($credentials)) {
            // 認証に成功したときの処理
            $request->session()->regenerate();
            return redirect()->intended('/home');
        } else {
            // 認証に失敗したときの処理
            return back()->withErrors([
                'login' => 'メールアドレスまたはパスワードが間違っています。',
            ]);
        }
    }

    /**
     * アカウントをログアウトする
     *
     * @param  Request  $request  リクエストオブジェクト
     */
    public function doLogout(Request $request)
    {
        // ログアウト
        Auth::logout();

        // フラッシュメッセージをセッションに保存
        session()->flash('message', 'ログアウトしました。');

        // ログイン画面にリダイレクト
        return redirect()->route('login');
    }
}

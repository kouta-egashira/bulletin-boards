<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 一覧表示
    public function index() {
        $posts = Post::all(); // PostModelから全て取ってくる
        $posts->load('user'); // load(‘user’)で$postsに紐ずくuserにアクセスできる

        return view('posts.index', compact('posts')); // compactで$postsをviewに渡す
    }

    // データ保存
    public function create() {
        return view('posts.create');
    }
    
    // 入力してきた情報を受け取り保存
    public function store(PostRequest $request) { // PostRequest = Request/PostRequestで作成したバリデーションを使う

        // dd($request);

        // インスタンスを作成
        $post = new Post;

        $post->title = $request->title; // postの中にtitleを保存する。titleはrequestに来ていたtitle
        $post->body = $request->body;
        $post->user_id = Auth::id(); // ログイン中のユーザのidを入れられる

        $post->save(); // インスタンスを作成したら保存しないといけない

        return redirect()->route('posts.index'); 
    }

    // 作成データを個別表示
    public function show($id) {  //$id = どの詳細かわかるようにidで受け取るように記載
        $post = Post::find($id); // PostModelからidを見つける

        return view('posts.show', compact('post')); // show.bladeに送る
    }

    // 作成データを編集
    public function edit($id) {  //$id = どの詳細かわかるようにidで受け取るように記載
        $post = Post::find($id); // PostModelからidを見つける

        // 別のユーザがURLから編集をできなくする
        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        return view('posts.edit', compact('post')); // show.bladeに送る
    }

    // 編集したデータを保存
    public function update(PostRequest $request, $id) { //$id = idをいどを受け取るとどのpostか分かり、変更したい内容が来る

        $post = Post::find($id); // PostModelからidを見つける

        // もし、ログイン中のidとPost_user_idが違ったら404エラーへ飛ばす。
        // これを記述することで、ログインユーザ以外が勝手に編集や削除をできなくする
        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save(); // セーブする

        return redirect()->route('posts.index'); //indexにもどす
    }

    // データを削除
    public function destroy($id) {  //$id = どの詳細かわかるようにidで受け取るように記載

        // PostModelからidを見つける
        $post = Post::find($id);

        // もし、ログイン中のidとPost_user_idが違ったら404エラーへ飛ばす。
        // これを記述することで、ログインユーザ以外が勝手に編集や削除をできなくする
        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        $post->delete(); // 削除

        return redirect()->route('posts.index');
    }

}

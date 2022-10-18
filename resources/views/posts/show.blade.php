@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>一覧ページ</h2>
                <a href="{{route('posts.create')}}" class="btn btn-primary">新規投稿</a>
                <div class="card text-center">
                    <div class="card-header">
                        掲示板
                    </div>
                        <div class="card-body">
                            <h5 class="card-title">タイトル：{{$post->title}}</h5>
                            <p class="card-text">内容：{{$post->body}}</p>
                            {{-- $post->user->name = 投稿に紐ずくuserの名前を取得することができる --}}
                            <p class="card-text">投稿者：{{ $post->user->name }}</p>

                            {{-- ログイン中のuser_idとPostsのuser_idとAuthのidが一致したら、削除のボタンを表示する --}}
                            @if ($post->user_id === Auth::id())
                                {{-- $post->idでパラメーターを渡す事で表示される投稿にidが振られる --}}
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">編集画面へ</a>
                                <form action='{{ route('posts.destroy', $post->id) }}' method='post'>
                                    {{ csrf_field() }}
                                    {{-- HTMLフォームはPUT、PATCH、DELETEアクションをサポートしてしていない為、擬似フォームメソッドを用いて送る --}}
                                    {{ method_field('DELETE') }}
                                    <br>
                                    <input type='submit' value='削除' class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                                </form>
                            @endif

                        </div>
                        <div class="card-footer text-muted">
                            投稿日：{{$post->created_at}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
@endsection

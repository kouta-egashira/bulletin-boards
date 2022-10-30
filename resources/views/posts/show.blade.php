@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>詳細ページ</h2>
                <br>
                <div>
                    <a href="{{route('posts.create')}}" class="btn btn-primary">新規投稿</a>
                </div>
                <br>
                <div class="card text-center">
                    <div class="card-header">
                        掲示板
                    </div>
                        <div class="card-body">
                            <h5 class="card-title">タイトル：{{$post->title}}</h5>
                            <p class="card-text">内容：{{$post->body}}</p>

                            {{-- @if~@endif = 画像があれば表示する --}}
                            @if ($post->image)
                                <div>
                                    <img src="{{asset('storage/images/'.$post->image)}}" style="height:200px">
                                </div>
                            @endif
                            <br>
                            {{-- $post->user->name = 投稿に紐ずくuserの名前を取得することができる --}}
                            <p class="card-text">投稿者：{{ $post->user->name }}</p><br>
                            {{-- ログイン中のuser_idとPostsのuser_idとAuthのidが一致したら、削除のボタンを表示する --}}
                            @if ($post->user_id === Auth::id())
                                {{-- $post->idは、パラメーターを渡す事により表示される投稿にidが振られる --}}
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

        {{-- コメントフォーム --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('comments.store')}}" method="POST">
                    {{csrf_field()}} {{-- csrf_field() 悪意のあるユーザが来ないように保護 --}}
                    <input type="hidden" name="post_id" value="{{$post->id}}"> {{-- $post->idは、パラメーターを渡す事により表示される投稿にidが振られる --}}
                    <div class="form-group">
                        <br>
                        <label>コメント</label>
                        <textarea class="form-control" placeholder="内容" rows="3" name="body"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">コメントする</button>
                </form>
            </div>
        </div>

        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-8">
                {{csrf_field()}} {{-- csrf_field() 悪意のあるユーザが来ないように保護 --}}
                <div class="card text-center">
                    <div class="card-header">コメント一覧</div>
                    <div class="card-body">
                        @foreach ($post->comments as $comment)
                            <h5>コメント：{{ $comment->body }}</h5>
                            <p>投稿者：{{$comment->user->name}}</p>
                            @if ($comment->user_id === Auth::id()) {{-- ログイン中のuser_idとCommentsのuser_idとAuthのidが一致したら、削除のボタンを表示する --}}
                                <form action='{{route('comments.destroy', $comment)}}' method='post'>
                                {{ csrf_field() }}
                                {{-- HTMLフォームはPUT、PATCH、DELETEアクションをサポートしてしていない為、擬似フォームメソッドを用いて送る --}}
                                {{ method_field('DELETE') }}
                                <div>
                                    <input type='submit' value='削除' class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                                </div>
                                <br>
                                <br>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



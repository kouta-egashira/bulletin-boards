@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>投稿一覧</h2>
                <a href="{{route('posts.create')}}" class="btn btn-primary">新規投稿</a>
                <div class="card text-center">
                    <div class="card-header">
                        掲示板
                    </div>

                    {{-- foreachで回すことで一覧で投稿を取得できる --}}
                    @foreach ($posts as $post)

                        <div class="card-body">
                            <h5 class="card-title">タイトル：{{$post->title}}</h5>
                            <p class="card-text">内容：{{$post->body}}</p>

                            {{-- @if~@endif = 画像があれば表示する --}}
                            @if ($post->image)
                                <div>
                                    <img src="{{asset('storage/images/'.$post->image)}}" style="height:200px">
                                </div>
                            @endif

                            {{-- $post->user->name = 投稿に紐ずくuserの名前を取得することができる --}}
                            <p class="card-text">投稿者：{{ $post->user->name }}</p>
                            {{-- $post->idでパラメーターを渡す事で表示される投稿にidが振られる --}}
                            <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary">詳細</a>
                        </div>

                        <div class="card-footer text-muted">
                             投稿日：{{$post->created_at}}
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

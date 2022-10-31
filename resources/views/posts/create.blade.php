@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Request/PostRequestで作成したバリデーションメッセージを表示 --}}
                @if ($errors->any())
                    <div class="alert alert-danger"> {{-- エラーがあれば赤色で表示 --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>新規投稿</h2>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}  {{-- csrf_field() 悪意のあるユーザが来ないように保護 --}}
                    <div class="form-group">
                        <label>タイトル</label>
                        <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
                    </div>
                    <br>
                    {{-- 画像アップロード --}}
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">作成する</button>
                    </div>
                    <br>
                    <div>
                        <a href="{{route('posts.index')}}" class="btn btn-danger">一覧へ戻る</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

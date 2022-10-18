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
                {{-- $post->id どのpostの更新をするのか --}}
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    {{csrf_field()}}  {{-- csrf_field() 悪意のあるユーザが来ないように保護 --}}
                    {{method_field('PATCH')}} {{-- htmlでPATCHは使えない為、method_field('PATCH')と記載 --}}
                    <div class="form-group">
                        <label>タイトル</label>
                        {{-- value="{{$post->title}} 編集時に前入力文字が表示されている --}}
                        <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title" value="{{$post->title}}">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea class="form-control" placeholder="内容" rows="5" name="body">{{$post->body}}</textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">更新する</button>
                </form>
            </div>
        </div>
    </div>
@endsection

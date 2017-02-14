@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="title_wrap">
                            <p class="title">{{$question->title}}</p>
                            <p class="topic_wrap">
                                @foreach($question->topics as $v)
                                    <span>{{$v->name}}</span>
                                @endforeach
                            </p>
                        </div>

                    </div>

                    <div class="panel-body">
                        <div>{!!$question->body!!}</div>
                        @if(Auth::check() && Auth::user()->owner($question))
                            <div class="edit"><a href="/questions/{{$question->id}}/edit">编辑</a></div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="title_wrap">
                            <p class="title">{{$question->answers_counts}}问题</p>
                        </div>

                    </div>
                    <div class="panel-body">

                        @foreach($question->answer as $v)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object answerUserAnwer" src="{{$v->user->avatar}}" alt="{{$v->user->name}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="javascript:void()">{{$v->user->name}}</a></h4>
                                    {!! $v->body !!}
                                </div>
                            </div>
                        @endforeach

                        <form action="/answer/{{$question->id}}" method="post">
                        {!! csrf_field() !!}

                        <!-- 编辑器容器 -->
                            <div class="from-group {{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">输入您要描述的问题</label>
                                <script id="container" name="body" type="text/plain">{!!old('body')!!}</script>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" value="回答问题" class="btn btn-primary btn-block">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

    </script>
@endsection
@endsection

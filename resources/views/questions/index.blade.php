@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($questions as $v)
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object indexUserAvatar" src="{{$v->user->avatar}}" alt="{{$v->user->name}}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="/questions/{{$v->id}}">{{$v->title}}</a></h4>
                        {{--{{$v->body}}--}}
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->


@endsection

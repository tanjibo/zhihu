@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">修改问题</div>

                    <div class="panel-body">
                        <form action="/questions/{{$question->id}}" method="post">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题</label>
                                <input type="text" name='title' value="{{$question->title}}" class="form-control"
                                       placeholder="请输入您的标题">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('topics') ? ' has-error' : '' }}">
                                <label for="">选择话题</label>

                                <select name="topics[]" class="js-example-basic-single form-control" multiple="multiple">
                                  @foreach($question->topics as $topic)
                                       <option value="{{$topic->id}}" selected>{{$topic->name}}</option>
                                      @endforeach
                                </select>
                                @if ($errors->has('topics'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topics') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- 编辑器容器 -->
                            <div class="from-group {{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">输入您要描述的问题</label>
                                <script id="container" name="body" type="text/plain">{!!$question->body!!}</script>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" value="修改问题" class="btn btn-primary btn-block">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 实例化编辑器 -->
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

        $(document).ready(function () {
//            $(".js-example-basic-single").select2();
            $(".js-example-basic-single").select2({
                tags:true,
                placeholder:'选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: "/api/topic",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data, params) {
                        // console.log(data,params);
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work

                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        })

        function formatRepo(topic){
            return "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" +
            topic.name ? topic.name : "Laravel"   +
            "</div></div></div>";

        }

        function formatRepoSelection(topic){
            return topic.name || topic.text;
        }

    </script>
@endsection

@endsection

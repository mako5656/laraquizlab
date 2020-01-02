{{--http://localhost:8888/laraquiz/public/tests--}}
@extends('layouts.app')

@section('content')
    {{--    <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>--}}
    <h3 class="page-title">New Differential equation question</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}
    <?php //dd($questions)
    $level1 =-2.0;
    $level2 =-0.4;
    $level3 =1.2;
    $level4 =3.05;
    $level5 = 4;
    $level6 = 6;
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
{{--            @lang('quickadmin.quiz')--}}
            Answer these 5 questions.

            {{--ability表示追加--}}
            <br><div>ユーザの能力値：
                @if(Auth::user()->ability < $level1)
                    ☆☆☆☆☆
                @elseif(Auth::user()->ability >= $level1 and Auth::user()->ability < $level2)
                    ★☆☆☆☆
                @elseif(Auth::user()->ability >= $level2 and Auth::user()->ability < $level3)
                    ★★☆☆☆
                @elseif(Auth::user()->ability >= $level3 and Auth::user()->ability < $level4)
                    ★★★☆☆
                @elseif(Auth::user()->ability >= $level4 and Auth::user()->ability < $level5)
                    ★★★★☆
                @elseif(Auth::user()->ability >= $level5 and Auth::user()->ability < $level6)
                    ★★★★★
                @elseif(Auth::user()->ability >= $level6)
                    ★★★★★★
                @endif
            </div>

        </div>
        @if(count($questions) > 0)
            <div class="panel-body">
                <?php $i = 1; ?>
                @foreach($questions as $question)
                    @if ($i > 1) <hr /> @endif
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="form-group">
                                <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong><br>
                                難易度：
                                @if($question->item_difficulty < $level1)
                                    ☆☆☆☆☆
                                @elseif($question->item_difficulty >= $level1 and $question->item_difficulty < $level2)
                                    ★☆☆☆☆
                                @elseif($question->item_difficulty >= $level2 and $question->item_difficulty < $level3)
                                    ★★☆☆☆
                                @elseif($question->item_difficulty >= $level3 and $question->item_difficulty < $level4)
                                    ★★★☆☆
                                @elseif($question->item_difficulty >= $level4 and $question->item_difficulty < $level5)
                                    ★★★★☆
                                @elseif($question->item_difficulty >= $level5 and $question->item_difficulty < $level6)
                                    ★★★★★
                                @elseif($question->item_difficulty >= $level6)
                                    ★★★★★★
                                @endif

                                @if ($question->code_snippet != '')
                                    <div class="code_snippet"> <label class="radio-inline">{!! $question->code_snippet !!}</label></div>
                                @endif

                                <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">
                                @if($question->category_name != 0000)
                                    @if($question->category_name != 0001)
                                        <strong>一般解</strong>
                                    @endif
                                @endif
                                @foreach($question->options as $option)
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                                        {!! $option->option !!}
                                    </label>
                                @endforeach
                                {{--書き加え--}}
                                @if($question->category_name != 0000)
                                    @if($question->category_name != 0001)
                                        <br><br>
                                        <strong>特殊解</strong>
                                        @foreach($question->optionss as $options)
                                            <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="answerss[{{ $question->id }}]" value="{{ $options->id }}">
                                                {!! $options->options !!}
                                            </label>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        @endif
    </div>

    {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>
@stop

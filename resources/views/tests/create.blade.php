{{--http://localhost:8888/laraquiz/public/tests--}}
@extends('layouts.app')

@section('content')
{{--    <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>--}}
    <h3 class="page-title">New Differential equation quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz')

            {{--ability表示追加--}}
            <br><div>ユーザの能力値 {{ Auth::user()->ability }}</div>

        </div>
        <?php //dd($questions) ?>
    @if(count($questions) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($questions as $question)
            @if ($i > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong><br>
{{--                        <img src="https://quickchart.io/chart?width=200&height=30&c=--}}
{{--                        {--}}
{{--                          type: 'horizontalBar',--}}
{{--                          data: {--}}
{{--                            labels: ['能力値'],--}}
{{--                            datasets: [{--}}
{{--                              data: [12]--}}
{{--                            }, {--}}
{{--                              data: [4]--}}
{{--                            }]--}}
{{--                          },options: {--}}
{{--                            responsive: true,--}}
{{--                            legend: {--}}
{{--                                display: false--}}
{{--                            }--}}
{{--                           }--}}
{{--                        }"--}}
{{--                        >--}}


                    @if ($question->code_snippet != '')
                            <div class="code_snippet"> <label class="radio-inline">{!! $question->code_snippet !!}</label></div>
                        @endif

                        <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">
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
                                <strong>特殊解を選んでください</strong>
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

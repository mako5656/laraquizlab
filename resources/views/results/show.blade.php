
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view-result')
            <p>
{{--                {{$results}}--}}
{{--                送られてきた配列の要素1は{{$results[0]->question->item_difficulty}}<br>--}}
{{--                送られてきた配列の要素1は{{$results[0]->question->discrimination_power}}<br>--}}
{{--                送られてきた配列の要素1は{{$results[0]->correct}}<br>--}}
{{--                {{$userability}}<br>--}}
{{--                {{$p}}--}}
            </p>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        @if(Auth::user()->isAdmin())
                        <tr>
                            <th>@lang('quickadmin.results.fields.user')</th>
                            <td>{{ $test->user->name or '' }} ({{ $test->user->email or '' }})</td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('quickadmin.results.fields.date')</th>
                            <td>{{ $test->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.results.fields.result')</th>
                            <td>{{ $test->result }}/5</td>
                        </tr>
                    </table>
                <?php $i = 1 ?>
                @foreach($results as $result)
                    <table class="table table-bordered table-striped">
                        <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                            <th style="width: 10%">Question #{{ $i }}</th>
                            <th>{{ $result->question->question_text or '' }}</th>
                        </tr>
                        @if ($result->question->code_snippet != '')
                            <tr>
                                <td>Code snippet</td>
                                <td><div class="code_snippet"><label class="radio-inline">{!! $result->question->code_snippet !!}</label></div></td>
                            </tr>
                        @endif
                        <tr>
                            <td>Options</td>
                            <td>
                                <ul>
                                    @if($result->question_id > 160)
                                        <p>一般解</p>
                                    @endif
                                    <label class="radio-inline">
                                        @foreach($result->question->options as $option)
                                            <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                                @if ($result->option_id == $option->id) text-decoration: underline @endif">
                                                {!! $option->option!!}
                                                @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                                @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                                            </li>
                                        @endforeach
                                    </label>
                                    @if($result->question_id > 160)
                                        <p></p><p>特殊解</p>
                                        <label class="radio-inline">
                                        @foreach($result->question->options as $option)
                                            <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                                @if ($result->options_id == $option->id) text-decoration: underline @endif">
                                                {!! $option->options!!}
                                                @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                                @if ($result->options_id == $option->id) <em>(your answer)</em> @endif
                                            </li>
                                        @endforeach
                                        </label>
                                    @endif
                                </ul>
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Answer Explanation</td>--}}
{{--                            <td>--}}
{{--                            {!! $result->question->answer_explanation  !!}--}}
{{--                                @if ($result->question->more_info_link != '')--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    Read more:--}}
{{--                                    <a href="{{ $result->question->more_info_link }}" target="_blank">{{ $result->question->more_info_link }}</a>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                    </table>
                <?php $i++ ?>
                @endforeach
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('tests.index') }}" class="btn btn-default">Take another quiz</a>
            <a href="{{ route('results.index') }}" class="btn btn-default">See all my results</a>
        </div>
    </div>
@stop

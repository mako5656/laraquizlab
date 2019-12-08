@extends('layouts.app')

@section('content')
    <?php $abilitynumber=1 ?>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome! Here are some numbers about Practice problem.</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h1>{{ $questions }}</h1>
                            questions in our database
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ $users }}</h1>
                            users registered
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ $quizzes }}</h1>
                            quizzes taken
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ number_format($average, 2) }} / 5</h1>
                            average score
                        </div>
                </div>
            </div>
            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>
        </div>
    </div>
        <div class="row">
            <div class="col-md-10">
                <?php $stack = ''; $goal = ''; ?>
                @foreach($sabilitys as $sbility)
                    {{$abilitynumber}}回目の能力値：{{$sbility}}
                    <?php
                        $stack   = sprintf('%s"%s回目", ', $stack, $abilitynumber);
                        print_r($stack);
                        $goal   = sprintf('%s"%s", ', $goal, 1.8);
                    ?><br>
                    <?php $abilitynumber++?>
                @endforeach
{{--                    $sabilitys--}}
                    <canvas id="myLineChart"></canvas>
                    <script>
                        var ctx = document.getElementById("myLineChart");
                        var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: [<?php echo $stack;?>],
                                datasets: [
                                    {
                                        label: '受験者能力値',
                                        data:{{$sabilitys}},
                                        borderColor: "rgba(255,0,0,1)",
                                        backgroundColor: "rgba(0,0,0,0)",
                                        lineTension: 0, // draw straightline
                                    },
                                    {
                                        label: '目標値',
                                        data:[<?php echo $goal;?>],
                                        borderColor: "rgba(0,0,255,1)",
                                        backgroundColor: "rgba(0,0,0,0)",
                                        pointRadius: 0, // hide points
                                    }
                                ],
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: '能力推移'
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            suggestedMax: 3.0,
                                            suggestedMin: 0,
                                            stepSize: 0.5,
                                            // callback: function(value, index, values){
                                                // return  value +  '度'
                                            // }
                                        }
                                    }]
                                },
                            }
                        });
                    </script>
                    <!--  グラフの描画エリア -->
                    <div id="chart_div" style="width: 100%; height: 350px"></div>
{{--                    <img src="https://quickchart.io/chart?c={type:'line',data:{labels:['January','February', 'March','April', 'May'], datasets:[{label:'Dogs',data:[50,60,70,180,190]}]}}">--}}
                    <body>
            </div>
        </div>
@endsection



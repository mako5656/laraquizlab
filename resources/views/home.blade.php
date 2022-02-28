@extends('layouts.app')

@section('content')
    <?php $abilitynumber=1 ?>
    {{--    <div class="row">--}}
    {{--        <div class="col-md-10">--}}
    {{--            <div class="panel panel-default">--}}
    {{--                <div class="panel-heading">Welcome! Here are some numbers about Practice problem.</div>--}}

    {{--                <div class="panel-body">--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-md-3 text-center">--}}
    {{--                            <h1>{{ $questions }}</h1>--}}
    {{--                            questions in our database--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 text-center">--}}
    {{--                            <h1>{{ $users }}</h1>--}}
    {{--                            users registered--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 text-center">--}}
    {{--                            <h1>{{ $quizzes }}</h1>--}}
    {{--                            quizzes taken--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 text-center">--}}
    {{--                            <h1>{{ number_format($average, 2) }} / 5</h1>--}}
    {{--                            average score--}}
    {{--                        </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="row">
        <div class="col-md-10">
            <?php $stack = ''; $goal = ''; $level1 = ''; $level2 = ''; $level3 = ''; $level4 = ''; $level5 = '';?>
            @foreach($sabilitys as $sbility)
                <?php
                $stack   = sprintf('%s"%s回目", ', $stack, $abilitynumber);
                $goal   = sprintf('%s"%s", ', $goal, 1.8);
                $level1   = sprintf('%s"%s", ', $level1, -2.0);
                $level2   = sprintf('%s"%s", ', $level2, -0.4);
                $level3   = sprintf('%s"%s", ', $level3, 1.2);
                $level4   = sprintf('%s"%s", ', $level4, 3.05);
                $level5   = sprintf('%s"%s", ', $level5, 4);
                $abilitynumber++;
                ?>
            @endforeach
            {{--                    $sabilitys--}}
                <canvas id="myLineChart" style="width: 100%; height: 600px"></canvas>
            <script>
                var ctx = document.getElementById("myLineChart").getContext('2d');
                ctx.canvas.height = 280;
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    // type: 'scatter',
                    data: {
                        labels: [<?php echo $stack;?>],
                        datasets: [
                            {
                                label: '受験者能力値',
                                data:<?php echo $sabilitys;?>,
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
                                borderDash: [10, 4],
                            },
                            {
                                label: '1',
                                data:[<?php echo $level1;?>],
                                borderColor: "rgba(0,0,0,0.2)",
                                backgroundColor: "rgba(0,0,0,0)",
                                pointRadius: 0, // hide points
                                borderDash: [5, 5],
                            },
                            {
                                label: '1',
                                data:[<?php echo $level2;?>],
                                borderColor: "rgba(0,0,0,0.2)",
                                backgroundColor: "rgba(0,0,0,0)",
                                pointRadius: 0, // hide points
                                borderDash: [5, 5],
                            },
                            {
                                label: '1',
                                data:[<?php echo $level3;?>],
                                borderColor: "rgba(0,0,0,0.2)",
                                backgroundColor: "rgba(0,0,0,0)",
                                pointRadius: 0, // hide points
                                borderDash: [5, 5],
                            },
                            {
                                label: '1',
                                data:[<?php echo $level4;?>],
                                borderColor: "rgba(0,0,0,0.2)",
                                backgroundColor: "rgba(0,0,0,0)",
                                pointRadius: 0, // hide points
                                borderDash: [5, 5],
                            },
                            {
                                label: '1',
                                data:[<?php echo $level5;?>],
                                borderColor: "rgba(0,0,0,0.2)",
                                backgroundColor: "rgba(0,0,0,0)",
                                pointRadius: 0, // hide points
                                borderDash: [5, 5],
                            },

                        ],
                    },
                    options: {
                        esponsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            text: '能力推移',
                            fontSize: 22             //フォントサイズ
                        },
                        legend:{
                            display: true,
                            labels:{
                                filter: function(items, chartData) {
                                    //dataに設定したlabelが〇〇の凡例を非表示にするなら
                                    return items.text != '1';
                                    //data配列の0番目の凡例を非表示
                                    return items.datasetIndex != 0;
                                },
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: false,
                                ticks: {
                                    suggestedMax: 3.0,
                                    suggestedMin: 0,
                                    stepSize: 0.5,
                                    // callback: function(value, index, values){
                                    // return  value +  '度'
                                    // }
                                },
                                gridLines: {
                                    display:false,
                                },
                                stacked: false,
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 15, //値の最大表示数
                                    fontSize: 14             //フォントサイズ
                                }
                            }]
                        },
                    }
                });
            </script>
            <!--  グラフの描画エリア -->
{{--            <div id="chart_div" style="width: 100%; height: 350px"></div>--}}
            {{--                    <img src="https://quickchart.io/chart?c={type:'line',data:{labels:['January','February', 'March','April', 'May'], datasets:[{label:'Dogs',data:[50,60,70,180,190]}]}}">--}}
            <body>
{{--        </div>--}}
    </div>
@endsection



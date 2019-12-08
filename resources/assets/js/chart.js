(function() {
    const ctx = document.getElementById("abilityChart");
    const abilityChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ["作業スピード", "応用力", "仕事の丁寧さ", "コミュニケーション能力", "声の大きさ"],
            datasets: [{
                data: [ability1, ability2, ability3, ability4, ability5],
                backgroundColor: 'RGBA(244,77,77, 1)',
                borderColor: 'RGBA(225,95,150, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'RGB(46,106,177)'
            }],
        },
        options: {
            title: {
                display: false,
            },
            legend: {
                display: false
            },
            scale: {
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 5,
                    stepSize: 1,
                    display:false,
                    // callback: function (value, index, values) {
                    //     return value + '点'
                    // }
                }
            }
        }
    });
})();

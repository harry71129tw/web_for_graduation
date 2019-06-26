$(document).ready(function() {

    $("#submit1").click(function() {
        var Mission_num = $("#mission_num1").val();
        var dataString = "Mission_num=" + Mission_num + "&submit1=";

        $.ajax({
            type: "POST",
            url: "barChart.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var sendnum = data[0];
                var opennum = data[1];
                var clicknum = data[2];
                var dopennum = data[0] - data[1];
                var dclicknum = data[0] - data[2];

                var ctx = document.getElementById("barChart");
                var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["總計", "有開啟(預覽)信件", "沒開啟(預覽)信件" , "有點擊連結", "沒點擊連結"],
                        datasets: [{
                            label: '# of mails',
                            data: [sendnum, opennum, dopennum, clicknum, dclicknum],
                            backgroundColor: [
                                "#FF0000",
                                "#00FF00",
                                "#0000EE",
                                "#FFFF00",
                                "#7700BB"
                            ],
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
                alert("Load Error.");
            }
        });
    });

    $("#submit2").click(function() {
        var Mission_num = $("#mission_num2").val();
        var dataString = "Mission_num=" + Mission_num + "&submit2=";

        $.ajax({
            type: "POST",
            url: "horizontalChart.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var time00 = 0;
                var time01 = 0;
                var time02 = 0;
                var time03 = 0;
                var time04 = 0;
                var time05 = 0;
                var time06 = 0;
                var time07 = 0;
                var time08 = 0;
                var time09 = 0;
                var time10 = 0;
                var time11 = 0;
                var time12 = 0;
                var time13 = 0;
                var time14 = 0;
                var time15 = 0;
                var time16 = 0;
                var time17 = 0;
                var time18 = 0;
                var time19 = 0;
                var time20 = 0;
                var time21 = 0;
                var time22 = 0;
                var time23 = 0;
                
                for (var i = 0; i < data.length; i++) {
                    var time = data[i][0];
                    time = time.replace(/-/g, ':').replace(' ', ':');
                    time = time.split(':');
                    var time1 = new Date(time[0], (time[1] - 1), time[2], time[3], time[4], time[5]);
                    
                    if(time1.getHours() == 00){
                        time00++;
                    }
                    if(time1.getHours() == 01){
                        time01++;
                    }
                    if(time1.getHours() == 02){
                        time02++;
                    }
                    if(time1.getHours() == 03){
                        time03++;
                    }
                    if(time1.getHours() == 04){
                        time04++;
                    }
                    if(time1.getHours() == 05){
                        time05++;
                    }
                    if(time1.getHours() == 06){
                        time06++;
                    }
                    if(time1.getHours() == 07){
                        time07++;
                    }
                    if(time1.getHours() == 08){
                        time08++;
                    }
                    if(time1.getHours() == 09){
                        time09++;
                    }
                    if(time1.getHours() == 10){
                        time10++;
                    }
                    if(time1.getHours() == 11){
                        time11++;
                    }
                    if(time1.getHours() == 12){
                        time12++;
                    }
                    if(time1.getHours() == 13){
                        time13++;
                    }
                    if(time1.getHours() == 14){
                        time14++;
                    }
                    if(time1.getHours() == 15){
                        time15++;
                    }
                    if(time1.getHours() == 16){
                        time16++;
                    }
                    if(time1.getHours() == 17){
                        time17++;
                    }
                    if(time1.getHours() == 18){
                        time18++;
                    }
                    if(time1.getHours() == 19){
                        time19++;
                    }
                    if(time1.getHours() == 20){
                        time20++;
                    }
                    if(time1.getHours() == 21){
                        time21++;
                    }
                    if(time1.getHours() == 22){
                        time22++;
                    }
                    if(time1.getHours() == 23){
                        time23++;
                    }
                }
                


                var ctx = document.getElementById("horizontalChart");
                var barChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: ["00:00-00:59", "01:00-01:59", "02:00-02:59", "03:00-03:59", "04:00-04:59", "05:00-05:59", "06:00-06:59", "07:00-07:59", "08:00-08:59", "09:00-09:59", "10:00-10:59", "11:00-11:59", "12:00-12:59", "13:00-13:59", "14:00-14:59", "15:00-15:59", "16:00-16:59", "17:00-17:59", "18:00-18:59", "19:00-19:59", "20:00-20:59", "21:00-21:59", "22:00-22:59", "23:00-23:59"],
                        datasets: [{
                            label: '# of time',
                            data: [time00, time01, time02, time03, time04, time05, time06, time07, time08, time09, time10, time11, time12, time13, time14, time15, time16, time17, time18, time19, time20, time21, time22, time23],
                            backgroundColor: [
                                "#FF0000",
                                "#FF4000",
                                "#FF8000",
                                "#FFBF00",
                                "#FFFF00",
                                "#BFFF00",
                                "#80FF00",
                                "#40FF00",
                                "#00FF00",
                                "#00FF40",
                                "#00FF80",
                                "#00FFBF",
                                "#00FFFF",
                                "#00BFFF",
                                "#0080FF",
                                "#0040FF",
                                "#0000FF",
                                "#4000FF",
                                "#8000FF",
                                "#BF00FF",
                                "#FF00FF",
                                "#FF00BF",
                                "#FF0080",
                                "#FF0040"
                            ],
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
                alert("Load Error.");
            }
        });
    });

});
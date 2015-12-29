var getStatisticheTest = function (str){
    var n = document.getElementById("qui").value;
        
    if (n == 5){
        if (str == "Best")
            get5BestTest();
    }
    if (n == 10){
        if (str == "Best")
            get10BestTest();
    }
    if (n == 15){
        if (str == "Best")
            get15BestTest();
    }
    
    if (n == 20){
        if (str == "Best")
            get20BestTest();
    }
}


var get5BestTest = function(){
    $.get("/docente/getTestforStat?corso_id=120&num=5&type=scelto&mod=best",function(data){
      //  Metronic.unblockUI();
        //Metronic.stopPageLoading({animate: true});

        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        AmCharts.makeChart("testSupBest", {
          "type": "serial",
          "theme": "light",
          "marginRight": 70,
          "dataProvider": [{
            "test": "Test "+x[0],
            "perc": y[0],
            "color": "#04D215"
          }, {
            "test": "Test "+x[1],
            "perc": y[1],
            "color": "#04D215"
          }, {
            "test": "Test "+x[2],
            "perc": y[2],
            "color": "#04D215"
          }, {
            "test": "Test "+x[3],
            "perc": y[3],
            "color": "#04D215"
          }, {
            "test": "Test "+x[4],
            "perc": y[4],
            "color": "#04D215"
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "Superato il <b>[[value]]%</b> delle volte",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "perc"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "test",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": true
          }

        });
    });
};

var get10BestTest = function(){
    $.get("/docente/getTestforStat?corso_id=120&num=10&type=scelto&mod=best",function(data){
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        AmCharts.makeChart("testSupBest", {
          "type": "serial",
          "theme": "light",
          "marginRight": 70,
          "dataProvider": [{
            "test": "Test "+x[0],
            "perc": y[0],
            "color": "#04D215"
          }, {
            "test": "Test "+x[1],
            "perc": y[1],
            "color": "#04D215"
          }, {
            "test": "Test "+x[2],
            "perc": y[2],
            "color": "#04D215"
          }, {
            "test": "Test "+x[3],
            "perc": y[3],
            "color": "#04D215"
          }, {
            "test": "Test "+x[4],
            "perc": y[4],
            "color": "#04D215"
            }, {
            "test": "Test "+x[5],
            "perc": y[5],
            "color": "#04D215"
          }, {
            "test": "Test "+x[6],
            "perc": y[6],
            "color": "#04D215"
          }, {
            "test": "Test "+x[7],
            "perc": y[7],
            "color": "#04D215"
          }, {
            "test": "Test "+x[8],
            "perc": y[8],
            "color": "#04D215"
          }, {
            "test": "Test "+x[9],
            "perc": y[9],
            "color": "#04D215"
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "Superato il <b>[[value]]%</b> delle volte",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "perc"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "test",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": true
          }

        });
    });
};

var get15BestTest = function(){
    $.get("/docente/getTestforStat?corso_id=120&num=15&type=scelto&mod=best",function(data){
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        AmCharts.makeChart("testSupBest", {
          "type": "serial",
          "theme": "light",
          "marginRight": 70,
          "dataProvider": [{
            "test": "Test "+x[0],
            "perc": y[0],
            "color": "#04D215"
          }, {
            "test": "Test "+x[1],
            "perc": y[1],
            "color": "#04D215"
          }, {
            "test": "Test "+x[2],
            "perc": y[2],
            "color": "#04D215"
          }, {
            "test": "Test "+x[3],
            "perc": y[3],
            "color": "#04D215"
          }, {
            "test": "Test "+x[4],
            "perc": y[4],
            "color": "#04D215"
            }, {
            "test": "Test "+x[5],
            "perc": y[5],
            "color": "#04D215"
          }, {
            "test": "Test "+x[6],
            "perc": y[6],
            "color": "#04D215"
          }, {
            "test": "Test "+x[7],
            "perc": y[7],
            "color": "#04D215"
          }, {
            "test": "Test "+x[8],
            "perc": y[8],
            "color": "#04D215"
          }, {
            "test": "Test "+x[9],
            "perc": y[9],
            "color": "#04D215"
            }, {
            "test": "Test "+x[10],
            "perc": y[10],
            "color": "#04D215"
          }, {
            "test": "Test "+x[11],
            "perc": y[11],
            "color": "#04D215"
          }, {
            "test": "Test "+x[12],
            "perc": y[12],
            "color": "#04D215"
          }, {
            "test": "Test "+x[13],
            "perc": y[13],
            "color": "#04D215"
          }, {
            "test": "Test "+x[14],
            "perc": y[14],
            "color": "#04D215"
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "Superato il <b>[[value]]%</b> delle volte",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "perc"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "test",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": true
          }

        });
    });
};

var get20BestTest = function(){
    $.get("/docente/getTestforStat?corso_id=120&num=20&type=scelto&mod=best",function(data){
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        AmCharts.makeChart("testSupBest", {
          "type": "serial",
          "theme": "light",
          "marginRight": 70,
          "dataProvider": [{
            "test": "Test "+x[0],
            "perc": y[0],
            "color": "#04D215"
          }, {
            "test": "Test "+x[1],
            "perc": y[1],
            "color": "#04D215"
          }, {
            "test": "Test "+x[2],
            "perc": y[2],
            "color": "#04D215"
          }, {
            "test": "Test "+x[3],
            "perc": y[3],
            "color": "#04D215"
          }, {
            "test": "Test "+x[4],
            "perc": y[4],
            "color": "#04D215"
            }, {
            "test": "Test "+x[5],
            "perc": y[5],
            "color": "#04D215"
          }, {
            "test": "Test "+x[6],
            "perc": y[6],
            "color": "#04D215"
          }, {
            "test": "Test "+x[7],
            "perc": y[7],
            "color": "#04D215"
          }, {
            "test": "Test "+x[8],
            "perc": y[8],
            "color": "#04D215"
          }, {
            "test": "Test "+x[9],
            "perc": y[9],
            "color": "#04D215"
            }, {
            "test": "Test "+x[10],
            "perc": y[10],
            "color": "#04D215"
          }, {
            "test": "Test "+x[11],
            "perc": y[11],
            "color": "#04D215"
          }, {
            "test": "Test "+x[12],
            "perc": y[12],
            "color": "#04D215"
          }, {
            "test": "Test "+x[13],
            "perc": y[13],
            "color": "#04D215"
          }, {
            "test": "Test "+x[14],
            "perc": y[14],
            "color": "#04D215"
            }, {
            "test": "Test "+x[15],
            "perc": y[15],
            "color": "#04D215"
          }, {
            "test": "Test "+x[16],
            "perc": y[16],
            "color": "#04D215"
          }, {
            "test": "Test "+x[17],
            "perc": y[17],
            "color": "#04D215"
          }, {
            "test": "Test "+x[18],
            "perc": y[18],
            "color": "#04D215"
          }, {
            "test": "Test "+x[19],
            "perc": y[19],
            "color": "#04D215"
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "Superato il <b>[[value]]%</b> delle volte",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "perc"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "test",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": true
          }

        });
    });
};
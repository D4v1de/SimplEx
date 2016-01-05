var getStatisticheTest = function (idC,str,modal) {
    idCorso = idC;
    if (modal == "Best"){
            color = "#16ce6d";
            mod = "best";
        }
        else if (modal == "Worst"){
            color = "#e14e4e";
            mod = "worst";
        }
    if (str == "Successo"){
        if ($('#valTestSup').is(":checked"))
            kind = "val";
        else kind = "ese";
        var n = document.getElementById("numberTestSuccesso").value;
        id = "testSup";
        type = "successo";
        text = "<span style='font-size:13px;'>Superato dal <b>[[value]]%</b> degli Studenti</span>";
    }
    if (str == "Scelto"){
        if ($('#valTestSce').is(":checked"))
            kind = "val";
        else kind = "ese";
        var n = document.getElementById("numberTestScelto").value;
        id = "testSce";
        type = "scelto";
        text = "<span style='font-size:13px;'>Scelto nel <b>[[value]]%</b> delle Sessioni</span>";
    }
    if (n == 5) {
        get5Test();
    }
    if (n == 10) {
        get10Test();
    }
    if (n == 15) {
        get15Test();
    }

    if (n == 20) {
        get20Test();
    }
}
var getStatisticheDomande = function (idC,str,modal) {
    idCorso = idC;
    if (modal == "Best"){
            color = "#16ce6d";
            mod = "best";
        }
        else if (modal == "Worst"){
            color = "#e14e4e";
            mod = "worst";
        }
    if (str == "Successo"){
        if ($('#valDomSup').is(":checked"))
            kind = "val";
        else kind = "ese";
        var n = document.getElementById("numberDomSup").value;
        id = "domSup";
        type = "successo";
        text = "<span style='font-size:13px;'>Risposta correttamente il <b>[[value]]%</b> delle volte</span>";
    }
    if (str == "Scelto"){
        if ($('#valDomSce').is(":checked"))
            kind = "val";
        else kind = "ese";
        var n = document.getElementById("numberDomSce").value;
        id = "domSce";
        type = "scelto";
        text = "<span style='font-size:13px;'>Scelta nel <b>[[value]]%</b> dei Test</span>";
    }
    if (n == 5) {
        get5Dom();
    }
    if (n == 10) {
        get10Dom();
    }
    if (n == 15) {
        get15Dom();
    }

    if (n == 20) {
        get20Dom();
    }
}

var get5Test = function () {
    $.post("/docente/getTestforStat?corso_id="+idCorso+"&num=5&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":"Test "+x[0],
                    "perc": (y[0] === "")? "0":y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": (x[1] === "")? "//":"Test "+x[1],
                    "perc": (y[1] === "")? "0":y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": (x[2] === "")? "//":"Test "+x[2],
                    "perc": (y[2] === "")? "0":y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": (x[3] === "")? "//":"Test "+x[3],
                    "perc": (y[3] === "")? "0":y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": (x[4] === "")? "//":"Test "+x[4],
                    "perc": (y[4] === "")? "0":y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": text,
                    "fillAlphas": 0.8,
                    "lineAlpha" : 0.2,
                    "type": "column",
                    "valueField": "perc",
                    "urlField" : "url"
                }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "test",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get10Test = function () {
    $.post("/docente/getTestforStat?corso_id="+idCorso+"&num=10&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":"Test "+x[0],
                    "perc": (y[0] === "")? "0":y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": (x[1] === "")? "//":"Test "+x[1],
                    "perc": (y[1] === "")? "0":y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": (x[2] === "")? "//":"Test "+x[2],
                    "perc": (y[2] === "")? "0":y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": (x[3] === "")? "//":"Test "+x[3],
                    "perc": (y[3] === "")? "0":y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": (x[4] === "")? "//":"Test "+x[4],
                    "perc": (y[4] === "")? "0":y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": (x[5] === "")? "//":"Test "+x[5],
                    "perc": (y[5] === "")? "0":y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": (x[6] === "")? "//":"Test "+x[6],
                    "perc": (y[6] === "")? "0":y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": (x[7] === "")? "//":"Test "+x[7],
                    "perc": (y[7] === "")? "0":y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": (x[8] === "")? "//":"Test "+x[8],
                    "perc": (y[8] === "")? "0":y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": (x[9] === "")? "//":"Test "+x[9],
                    "perc": (y[9] === "")? "0":y[9],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[9]+"/visualizzatest"
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
                    "type": "column",
                    "valueField": "perc",
                    "urlField" : "url"
                }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "test",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get15Test = function () {
    $.post("/docente/getTestforStat?corso_id="+idCorso+"&num=15&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":"Test "+x[0],
                    "perc": (y[0] === "")? "0":y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": (x[1] === "")? "//":"Test "+x[1],
                    "perc": (y[1] === "")? "0":y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": (x[2] === "")? "//":"Test "+x[2],
                    "perc": (y[2] === "")? "0":y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": (x[3] === "")? "//":"Test "+x[3],
                    "perc": (y[3] === "")? "0":y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": (x[4] === "")? "//":"Test "+x[4],
                    "perc": (y[4] === "")? "0":y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": (x[5] === "")? "//":"Test "+x[5],
                    "perc": (y[5] === "")? "0":y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": (x[6] === "")? "//":"Test "+x[6],
                    "perc": (y[6] === "")? "0":y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": (x[7] === "")? "//":"Test "+x[7],
                    "perc": (y[7] === "")? "0":y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": (x[8] === "")? "//":"Test "+x[8],
                    "perc": (y[8] === "")? "0":y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": (x[9] === "")? "//":"Test "+x[9],
                    "perc": (y[9] === "")? "0":y[9],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[9]+"/visualizzatest"
                }, {
                    "test": (x[10] === "")? "//":"Test "+x[10],
                    "perc": (y[10] === "")? "0":y[10],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[10]+"/visualizzatest"
                }, {
                    "test": (x[11] === "")? "//":"Test "+x[11],
                    "perc": (y[11] === "")? "0":y[11],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[11]+"/visualizzatest"
                }, {
                    "test": (x[12] === "")? "//":"Test "+x[12],
                    "perc": (y[12] === "")? "0":y[12],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[12]+"/visualizzatest"
                }, {
                    "test": (x[13] === "")? "//":"Test "+x[13],
                    "perc": (y[13] === "")? "0":y[13],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[13]+"/visualizzatest"
                }, {
                    "test": (x[14] === "")? "//":"Test "+x[14],
                    "perc": (y[14] === "")? "0":y[14],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[14]+"/visualizzatest"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
                    "type": "column",
                    "valueField": "perc",
                    "urlField" : "url"
                }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "test",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get20Test = function () {
    $.post("/docente/getTestforStat?corso_id="+idCorso+"&num=20&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":"Test "+x[0],
                    "perc": (y[0] === "")? "0":y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": (x[1] === "")? "//":"Test "+x[1],
                    "perc": (y[1] === "")? "0":y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": (x[2] === "")? "//":"Test "+x[2],
                    "perc": (y[2] === "")? "0":y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": (x[3] === "")? "//":"Test "+x[3],
                    "perc": (y[3] === "")? "0":y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": (x[4] === "")? "//":"Test "+x[4],
                    "perc": (y[4] === "")? "0":y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": (x[5] === "")? "//":"Test "+x[5],
                    "perc": (y[5] === "")? "0":y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": (x[6] === "")? "//":"Test "+x[6],
                    "perc": (y[6] === "")? "0":y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": (x[7] === "")? "//":"Test "+x[7],
                    "perc": (y[7] === "")? "0":y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": (x[8] === "")? "//":"Test "+x[8],
                    "perc": (y[8] === "")? "0":y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": (x[9] === "")? "//":"Test "+x[9],
                    "perc": (y[9] === "")? "0":y[9],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[9]+"/visualizzatest"
                }, {
                    "test": (x[10] === "")? "//":"Test "+x[10],
                    "perc": (y[10] === "")? "0":y[10],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[10]+"/visualizzatest"
                }, {
                    "test": (x[11] === "")? "//":"Test "+x[11],
                    "perc": (y[11] === "")? "0":y[11],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[11]+"/visualizzatest"
                }, {
                    "test": (x[12] === "")? "//":"Test "+x[12],
                    "perc": (y[12] === "")? "0":y[12],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[12]+"/visualizzatest"
                }, {
                    "test": (x[13] === "")? "//":"Test "+x[13],
                    "perc": (y[13] === "")? "0":y[13],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[13]+"/visualizzatest"
                }, {
                    "test": (x[14] === "")? "//":"Test "+x[14],
                    "perc": (y[14] === "")? "0":y[14],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[14]+"/visualizzatest"
                }, {
                    "test": (x[15] === "")? "//":"Test "+x[15],
                    "perc": (y[5] === "")? "0":y[15],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[15]+"/visualizzatest"
                }, {
                    "test": (x[16] === "")? "//":"Test "+x[16],
                    "perc": (y[16] === "")? "0":y[16],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[16]+"/visualizzatest"
                }, {
                    "test": (x[17] === "")? "//":"Test "+x[17],
                    "perc": (y[17] === "")? "0":y[17],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[17]+"/visualizzatest"
                }, {
                    "test": (x[18] === "")? "//":"Test "+x[18],
                    "perc": (y[18] === "")? "0":y[18],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[18]+"/visualizzatest"
                }, {
                    "test": (x[19] === "")? "//":"Test "+x[19],
                    "perc": (y[19] === "")? "0":y[19],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[19]+"/visualizzatest"
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
                    "type": "column",
                    "valueField": "perc",
                    "urlField" : "url"
                }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "test",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};


var get5Dom = function () {
    $.post("/docente/getDomforStat?corso_id="+idCorso+"&num=5&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":1,
                    "perc": (y[0] === "")? 0:y[0],
                    "color": color,
                    "txt" : (x[0] === "")? "":x[0]
                }, {
                    "test": (x[1] === "")? "//":2,
                    "perc": (y[1] === "")? 0:y[1],
                    "color": color,
                    "txt" : (x[1] === "")? "":x[1]
                }, {
                    "test": (x[2] === "")? "//":3,
                    "perc": (y[2] === "")? 0:y[2],
                    "color": color,
                    "txt" : (x[2] === "")? "":x[2]
                }, {
                    "test": (x[3] === "")? "//":4,
                    "perc": (y[3] === "")? 0:y[3],
                    "color": color,
                    "txt" : (x[3] === "")? "":x[3]
                }, {
                    "test": (x[4] === "")? "//":5,
                    "perc": (y[4] === "")? 0:y[4],
                    "color": color,
                    "txt" : (x[4] === "")? "":x[4]
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": "[[txt]]\n"+text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
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
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get10Dom = function () {
    $.post("/docente/getDomforStat?corso_id="+idCorso+"&num=10&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":1,
                    "perc": (y[0] === "")? 0:y[0],
                    "color": color,
                    "txt" : (x[0] === "")? "":x[0]
                }, {
                    "test": (x[1] === "")? "//":2,
                    "perc": (y[1] === "")? 0:y[1],
                    "color": color,
                    "txt" : (x[1] === "")? "":x[1]
                }, {
                    "test": (x[2] === "")? "//":3,
                    "perc": (y[2] === "")? 0:y[2],
                    "color": color,
                    "txt" : (x[2] === "")? "":x[2]
                }, {
                    "test": (x[3] === "")? "//":4,
                    "perc": (y[3] === "")? 0:y[3],
                    "color": color,
                    "txt" : (x[3] === "")? "":x[3]
                }, {
                    "test": (x[4] === "")? "//":5,
                    "perc": (y[4] === "")? 0:y[4],
                    "color": color,
                    "txt" : (x[4] === "")? "":x[4]
                }, {
                    "test": (x[5] === "")? "//":6,
                    "perc": (y[5] === "")? 0:y[5],
                    "color": color,
                    "txt" : (x[5] === "")? "":x[5]
                }, {
                    "test": (x[6] === "")? "//":7,
                    "perc": (y[6] === "")? 0:y[6],
                    "color": color,
                    "txt" : (x[6] === "")? "":x[6]
                }, {
                    "test": (x[7] === "")? "//":8,
                    "perc": (y[7] === "")? 0:y[7],
                    "color": color,
                    "txt" : (x[7] === "")? "":x[7]
                }, {
                    "test": (x[8] === "")? "//":9,
                    "perc": (y[8] === "")? 0:y[8],
                    "color": color,
                    "txt" : (x[8] === "")? "":x[8]
                }, {
                    "test": (x[9] === "")? "//":10,
                    "perc": (y[9] === "")? 0:y[9],
                    "color": color,
                    "txt" : (x[9] === "")? "":x[9]
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": "[[txt]]\n"+text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
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
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get15Dom = function () {
    $.post("/docente/getDomforStat?corso_id="+idCorso+"&num=15&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":1,
                    "perc": (y[0] === "")? 0:y[0],
                    "color": color,
                    "txt" : (x[0] === "")? "":x[0]
                }, {
                    "test": (x[1] === "")? "//":2,
                    "perc": (y[1] === "")? 0:y[1],
                    "color": color,
                    "txt" : (x[1] === "")? "":x[1]
                }, {
                    "test": (x[2] === "")? "//":3,
                    "perc": (y[2] === "")? 0:y[2],
                    "color": color,
                    "txt" : (x[2] === "")? "":x[2]
                }, {
                    "test": (x[3] === "")? "//":4,
                    "perc": (y[3] === "")? 0:y[3],
                    "color": color,
                    "txt" : (x[3] === "")? "":x[3]
                }, {
                    "test": (x[4] === "")? "//":5,
                    "perc": (y[4] === "")? 0:y[4],
                    "color": color,
                    "txt" : (x[4] === "")? "":x[4]
                }, {
                    "test": (x[5] === "")? "//":6,
                    "perc": (y[5] === "")? 0:y[5],
                    "color": color,
                    "txt" : (x[5] === "")? "":x[5]
                }, {
                    "test": (x[6] === "")? "//":7,
                    "perc": (y[6] === "")? 0:y[6],
                    "color": color,
                    "txt" : (x[6] === "")? "":x[6]
                }, {
                    "test": (x[7] === "")? "//":8,
                    "perc": (y[7] === "")? 0:y[7],
                    "color": color,
                    "txt" : (x[7] === "")? "":x[7]
                }, {
                    "test": (x[8] === "")? "//":9,
                    "perc": (y[8] === "")? 0:y[8],
                    "color": color,
                    "txt" : (x[8] === "")? "":x[8]
                }, {
                    "test": (x[9] === "")? "//":10,
                    "perc": (y[9] === "")? 0:y[9],
                    "color": color,
                    "txt" : (x[9] === "")? "":x[9]
                }, {
                    "test": (x[10] === "")? "//":11,
                    "perc": (y[10] === "")? 0:y[10],
                    "color": color,
                    "txt" : (x[10] === "")? "":x[10]
                }, {
                    "test": (x[11] === "")? "//":12,
                    "perc": (y[11] === "")? 0:y[11],
                    "color": color,
                    "txt" : (x[11] === "")? "":x[11]
                }, {
                    "test": (x[12] === "")? "//":13,
                    "perc": (y[12] === "")? 0:y[12],
                    "color": color,
                    "txt" : (x[12] === "")? "":x[12]
                }, {
                    "test": (x[13] === "")? "//":14,
                    "perc": (y[13] === "")? 0:y[13],
                    "color": color,
                    "txt" : (x[13] === "")? "":x[13]
                }, {
                    "test": (x[14] === "")? "//":15,
                    "perc": (y[14] === "")? 0:y[14],
                    "color": color,
                    "txt" : (x[14] === "")? "":x[14]
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": "[[txt]]\n"+text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
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
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};

var get20Dom = function () {
    $.post("/docente/getDomforStat?corso_id="+idCorso+"&num=20&type="+type+"&mod="+mod+"&kind="+kind, function (data) {
        var res = data.split("/");
        var x = res[0].split("-");
        var y = res[1].split("-");
        var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "fontFamily": 'Open Sans',
            "color": '#888',
            "dataProvider": [{
                    "test": (x[0] === "")? "//":1,
                    "perc": (y[0] === "")? 0:y[0],
                    "color": color,
                    "txt" : (x[0] === "")? "":x[0]
                }, {
                    "test": (x[1] === "")? "//":2,
                    "perc": (y[1] === "")? 0:y[1],
                    "color": color,
                    "txt" : (x[1] === "")? "":x[1]
                }, {
                    "test": (x[2] === "")? "//":3,
                    "perc": (y[2] === "")? 0:y[2],
                    "color": color,
                    "txt" : (x[2] === "")? "":x[2]
                }, {
                    "test": (x[3] === "")? "//":4,
                    "perc": (y[3] === "")? 0:y[3],
                    "color": color,
                    "txt" : (x[3] === "")? "":x[3]
                }, {
                    "test": (x[4] === "")? "//":5,
                    "perc": (y[4] === "")? 0:y[4],
                    "color": color,
                    "txt" : (x[4] === "")? "":x[4]
                }, {
                    "test": (x[5] === "")? "//":6,
                    "perc": (y[5] === "")? 0:y[5],
                    "color": color,
                    "txt" : (x[5] === "")? "":x[5]
                }, {
                    "test": (x[6] === "")? "//":7,
                    "perc": (y[6] === "")? 0:y[6],
                    "color": color,
                    "txt" : (x[6] === "")? "":x[6]
                }, {
                    "test": (x[7] === "")? "//":8,
                    "perc": (y[7] === "")? 0:y[7],
                    "color": color,
                    "txt" : (x[7] === "")? "":x[7]
                }, {
                    "test": (x[8] === "")? "//":9,
                    "perc": (y[8] === "")? 0:y[8],
                    "color": color,
                    "txt" : (x[8] === "")? "":x[8]
                }, {
                    "test": (x[9] === "")? "//":10,
                    "perc": (y[9] === "")? 0:y[9],
                    "color": color,
                    "txt" : (x[9] === "")? "":x[9]
                }, {
                    "test": (x[10] === "")? "//":11,
                    "perc": (y[10] === "")? 0:y[10],
                    "color": color,
                    "txt" : (x[10] === "")? "":x[10]
                }, {
                    "test": (x[11] === "")? "//":12,
                    "perc": (y[11] === "")? 0:y[11],
                    "color": color,
                    "txt" : (x[11] === "")? "":x[11]
                }, {
                    "test": (x[12] === "")? "//":13,
                    "perc": (y[12] === "")? 0:y[12],
                    "color": color,
                    "txt" : (x[12] === "")? "":x[12]
                }, {
                    "test": (x[13] === "")? "//":14,
                    "perc": (y[13] === "")? 0:y[13],
                    "color": color,
                    "txt" : (x[13] === "")? "":x[13]
                }, {
                    "test": (x[14] === "")? "//":15,
                    "perc": (y[14] === "")? 0:y[14],
                    "color": color,
                    "txt" : (x[14] === "")? "":x[14]
                }, {
                    "test": (x[15] === "")? "//":16,
                    "perc": (y[15] === "")? 0:y[15],
                    "color": color,
                    "txt" : (x[15] === "")? "":x[15]
                }, {
                    "test": (x[16] === "")? "//":17,
                    "perc": (y[16] === "")? 0:y[16],
                    "color": color,
                    "txt" : (x[16] === "")? "":x[16]
                }, {
                    "test": (x[17] === "")? "//":18,
                    "perc": (y[17] === "")? 0:y[17],
                    "color": color,
                    "txt" : (x[17] === "")? "":x[17]
                }, {
                    "test": (x[18] === "")? "//":19,
                    "perc": (y[18] === "")? 0:y[18],
                    "color": color,
                    "txt" : (x[18] === "")? "":x[18]
                }, {
                    "test": (x[19] === "")? "//":20,
                    "perc": (y[19] === "")? 0:y[19],
                    "color": color,
                    "txt" : (x[19] === "")? "":x[19]
                }],
            "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
            "startDuration": 1,
            "graphs": [{
                    "alphaField": "alpha",
                    "fillColorsField": "color",
                    "lineColorField": "color",
                    "balloonColor": "color",
                    "balloonText": "[[txt]]\n"+text,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
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
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#'+id).closest('.portlet').find('.fullscreen').click(function () {
            chart.invalidateSize();
        });

    });
};


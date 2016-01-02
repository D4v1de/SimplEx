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
            "dataProvider": [
                {
                    "test": "Test " + x[0],
                    "perc": y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
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
                    "test": "Test " + x[0],
                    "perc": y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
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
                    "test": "Test " + x[0],
                    "perc": y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[9]+"/visualizzatest"
                }, {
                    "test": "Test " + x[10],
                    "perc": y[10],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[10]+"/visualizzatest"
                }, {
                    "test": "Test " + x[11],
                    "perc": y[11],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[11]+"/visualizzatest"
                }, {
                    "test": "Test " + x[12],
                    "perc": y[12],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[12]+"/visualizzatest"
                }, {
                    "test": "Test " + x[13],
                    "perc": y[13],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[13]+"/visualizzatest"
                }, {
                    "test": "Test " + x[14],
                    "perc": y[14],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[14]+"/visualizzatest"
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
                    "test": "Test " + x[0],
                    "perc": y[0],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[0]+"/visualizzatest"
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[1]+"/visualizzatest"
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[2]+"/visualizzatest"
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[3]+"/visualizzatest"
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[4]+"/visualizzatest"
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[5]+"/visualizzatest"
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[6]+"/visualizzatest"
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[7]+"/visualizzatest"
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[8]+"/visualizzatest"
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[9]+"/visualizzatest"
                }, {
                    "test": "Test " + x[10],
                    "perc": y[10],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[10]+"/visualizzatest"
                }, {
                    "test": "Test " + x[11],
                    "perc": y[11],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[11]+"/visualizzatest"
                }, {
                    "test": "Test " + x[12],
                    "perc": y[12],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[12]+"/visualizzatest"
                }, {
                    "test": "Test " + x[13],
                    "perc": y[13],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[13]+"/visualizzatest"
                }, {
                    "test": "Test " + x[14],
                    "perc": y[14],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[14]+"/visualizzatest"
                }, {
                    "test": "Test " + x[15],
                    "perc": y[15],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[15]+"/visualizzatest"
                }, {
                    "test": "Test " + x[16],
                    "perc": y[16],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[16]+"/visualizzatest"
                }, {
                    "test": "Test " + x[17],
                    "perc": y[17],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[17]+"/visualizzatest"
                }, {
                    "test": "Test " + x[18],
                    "perc": y[18],
                    "color": color,
                    "url" : "/docente/corso/"+idCorso+"/test/"+x[18]+"/visualizzatest"
                }, {
                    "test": "Test " + x[19],
                    "perc": y[19],
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
            "dataProvider": [
                {
                    "test": (typeof x[0] === typeof undefined)? "//":1,
                    "perc": (typeof y[0] === typeof undefined)? 0:y[0],
                    "color": color,
                    "txt" : (typeof x[0] === typeof undefined)? "":x[0]
                }, {
                    "test": (typeof x[1] === typeof undefined)? "//":2,
                    "perc": (typeof y[1] === typeof undefined)? 0:y[1],
                    "color": color,
                    "txt" : (typeof x[1] === typeof undefined)? "":x[1]
                }, {
                    "test": (typeof x[2] === typeof undefined)? "//":3,
                    "perc": (typeof y[2] === typeof undefined)? 0:y[2],
                    "color": color,
                    "txt" : (typeof x[2] === typeof undefined)? "":x[2]
                }, {
                    "test": (typeof x[3] === typeof undefined)? "//":4,
                    "perc": (typeof y[3] === typeof undefined)? 0:y[3],
                    "color": color,
                    "txt" : (typeof x[3] === typeof undefined)? "//":x[3]
                }, {
                    "test": (typeof x[4] === typeof undefined)? "//":5,
                    "perc": (typeof y[4] === typeof undefined)? 0:y[4],
                    "color": color,
                    "txt" : (typeof x[4] === typeof undefined)? "":x[4]
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
            "dataProvider": [
                {
                    "test": (typeof x[0] === typeof undefined)? "//":1,
                    "perc": (typeof y[0] === typeof undefined)? 0:y[0],
                    "color": color,
                    "txt" : (typeof x[0] === typeof undefined)? "":x[0]
                }, {
                    "test": (typeof x[1] === typeof undefined)? "//":2,
                    "perc": (typeof y[1] === typeof undefined)? 0:y[1],
                    "color": color,
                    "txt" : (typeof x[1] === typeof undefined)? "":x[1]
                }, {
                    "test": (typeof x[2] === typeof undefined)? "//":3,
                    "perc": (typeof y[2] === typeof undefined)? 0:y[2],
                    "color": color,
                    "txt" : (typeof x[2] === typeof undefined)? "":x[2]
                }, {
                    "test": (typeof x[3] === typeof undefined)? "//":4,
                    "perc": (typeof y[3] === typeof undefined)? 0:y[3],
                    "color": color,
                    "txt" : (typeof x[3] === typeof undefined)? "":x[3]
                }, {
                    "test": (typeof x[4] === typeof undefined)? "//":5,
                    "perc": (typeof y[4] === typeof undefined)? 0:y[4],
                    "color": color,
                    "txt" : (typeof x[4] === typeof undefined)? "":x[4]
                }, {
                    "test": (typeof x[5] === typeof undefined)? "//":6,
                    "perc": (typeof y[5] === typeof undefined)? 0:y[5],
                    "color": color,
                    "txt" : (typeof x[5] === typeof undefined)? "":x[5]
                }, {
                    "test": (typeof x[6] === typeof undefined)? "//":7,
                    "perc": (typeof y[6] === typeof undefined)? 0:y[6],
                    "color": color,
                    "txt" : (typeof x[6] === typeof undefined)? "":x[6]
                }, {
                    "test": (typeof x[7] === typeof undefined)? "//":8,
                    "perc": (typeof y[7] === typeof undefined)? 0:y[7],
                    "color": color,
                    "txt" : (typeof x[7] === typeof undefined)? "":x[7]
                }, {
                    "test": (typeof x[8] === typeof undefined)? "//":9,
                    "perc": (typeof y[8] === typeof undefined)? 0:y[8],
                    "color": color,
                    "txt" : (typeof x[8] === typeof undefined)? "":x[8]
                }, {
                    "test": (typeof x[9] === typeof undefined)? "//":10,
                    "perc": (typeof y[9] === typeof undefined)? 0:y[9],
                    "color": color,
                    "txt" : (typeof x[9] === typeof undefined)? "":x[9]
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
            "dataProvider": [
                {
                    "test": (typeof x[0] === typeof undefined)? "//":1,
                    "perc": (typeof y[0] === typeof undefined)? 0:y[0],
                    "color": color,
                    "txt" : (typeof x[0] === typeof undefined)? "":x[0]
                }, {
                    "test": (typeof x[1] === typeof undefined)? "//":2,
                    "perc": (typeof y[1] === typeof undefined)? 0:y[1],
                    "color": color,
                    "txt" : (typeof x[1] === typeof undefined)? "":x[1]
                }, {
                    "test": (typeof x[2] === typeof undefined)? "//":3,
                    "perc": (typeof y[2] === typeof undefined)? 0:y[2],
                    "color": color,
                    "txt" : (typeof x[2] === typeof undefined)? "":x[2]
                }, {
                    "test": (typeof x[3] === typeof undefined)? "//":4,
                    "perc": (typeof y[3] === typeof undefined)? 0:y[3],
                    "color": color,
                    "txt" : (typeof x[3] === typeof undefined)? "":x[3]
                }, {
                    "test": (typeof x[4] === typeof undefined)? "//":5,
                    "perc": (typeof y[4] === typeof undefined)? 0:y[4],
                    "color": color,
                    "txt" : (typeof x[4] === typeof undefined)? "":x[4]
                }, {
                    "test": (typeof x[5] === typeof undefined)? "//":6,
                    "perc": (typeof y[5] === typeof undefined)? 0:y[5],
                    "color": color,
                    "txt" : (typeof x[5] === typeof undefined)? "":x[5]
                }, {
                    "test": (typeof x[6] === typeof undefined)? "//":7,
                    "perc": (typeof y[6] === typeof undefined)? 0:y[6],
                    "color": color,
                    "txt" : (typeof x[6] === typeof undefined)? "":x[6]
                }, {
                    "test": (typeof x[7] === typeof undefined)? "//":8,
                    "perc": (typeof y[7] === typeof undefined)? 0:y[7],
                    "color": color,
                    "txt" : (typeof x[7] === typeof undefined)? "":x[7]
                }, {
                    "test": (typeof x[8] === typeof undefined)? "//":9,
                    "perc": (typeof y[8] === typeof undefined)? 0:y[8],
                    "color": color,
                    "txt" : (typeof x[8] === typeof undefined)? "":x[8]
                }, {
                    "test": (typeof x[9] === typeof undefined)? "//":10,
                    "perc": (typeof y[9] === typeof undefined)? 0:y[9],
                    "color": color,
                    "txt" : (typeof x[9] === typeof undefined)? "":x[9]
                }, {
                    "test": (typeof x[10] === typeof undefined)? "//":11,
                    "perc": (typeof y[10] === typeof undefined)? 0:y[10],
                    "color": color,
                    "txt" : (typeof x[10] === typeof undefined)? "":x[10]
                }, {
                    "test": (typeof x[11] === typeof undefined)? "//":12,
                    "perc": (typeof y[11] === typeof undefined)? 0:y[11],
                    "color": color,
                    "txt" : (typeof x[11] === typeof undefined)? "":x[11]
                }, {
                    "test": (typeof x[12] === typeof undefined)? "//":13,
                    "perc": (typeof y[12] === typeof undefined)? 0:y[12],
                    "color": color,
                    "txt" : (typeof x[12] === typeof undefined)? "":x[12]
                }, {
                    "test": (typeof x[13] === typeof undefined)? "//":14,
                    "perc": (typeof y[13] === typeof undefined)? 0:y[13],
                    "color": color,
                    "txt" : (typeof x[13] === typeof undefined)? "":x[13]
                }, {
                    "test": (typeof x[14] === typeof undefined)? "//":15,
                    "perc": (typeof y[14] === typeof undefined)? 0:y[14],
                    "color": color,
                    "txt" : (typeof x[14] === typeof undefined)? "":x[14]
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
            "dataProvider": [
                {
                    "test": (typeof x[0] === typeof undefined)? "//":1,
                    "perc": (typeof y[0] === typeof undefined)? 0:y[0],
                    "color": color,
                    "txt" : (typeof x[0] === typeof undefined)? "":x[0]
                }, {
                    "test": (typeof x[1] === typeof undefined)? "//":2,
                    "perc": (typeof y[1] === typeof undefined)? 0:y[1],
                    "color": color,
                    "txt" : (typeof x[1] === typeof undefined)? "":x[1]
                }, {
                    "test": (typeof x[2] === typeof undefined)? "//":3,
                    "perc": (typeof y[2] === typeof undefined)? 0:y[2],
                    "color": color,
                    "txt" : (typeof x[2] === typeof undefined)? "":x[2]
                }, {
                    "test": (typeof x[3] === typeof undefined)? "//":4,
                    "perc": (typeof y[3] === typeof undefined)? 0:y[3],
                    "color": color,
                    "txt" : (typeof x[3] === typeof undefined)? "":x[3]
                }, {
                    "test": (typeof x[4] === typeof undefined)? "//":5,
                    "perc": (typeof y[4] === typeof undefined)? 0:y[4],
                    "color": color,
                    "txt" : (typeof x[4] === typeof undefined)? "":x[4]
                }, {
                    "test": (typeof x[5] === typeof undefined)? "//":6,
                    "perc": (typeof y[5] === typeof undefined)? 0:y[5],
                    "color": color,
                    "txt" : (typeof x[5] === typeof undefined)? "":x[5]
                }, {
                    "test": (typeof x[6] === typeof undefined)? "//":7,
                    "perc": (typeof y[6] === typeof undefined)? 0:y[6],
                    "color": color,
                    "txt" : (typeof x[6] === typeof undefined)? "":x[6]
                }, {
                    "test": (typeof x[7] === typeof undefined)? "//":8,
                    "perc": (typeof y[7] === typeof undefined)? 0:y[7],
                    "color": color,
                    "txt" : (typeof x[7] === typeof undefined)? "":x[7]
                }, {
                    "test": (typeof x[8] === typeof undefined)? "//":9,
                    "perc": (typeof y[8] === typeof undefined)? 0:y[8],
                    "color": color,
                    "txt" : (typeof x[8] === typeof undefined)? "":x[8]
                }, {
                    "test": (typeof x[9] === typeof undefined)? "//":10,
                    "perc": (typeof y[9] === typeof undefined)? 0:y[9],
                    "color": color,
                    "txt" : (typeof x[9] === typeof undefined)? "":x[9]
                }, {
                    "test": (typeof x[10] === typeof undefined)? "//":11,
                    "perc": (typeof y[10] === typeof undefined)? 0:y[10],
                    "color": color,
                    "txt" : (typeof x[10] === typeof undefined)? "":x[10]
                }, {
                    "test": (typeof x[11] === typeof undefined)? "//":12,
                    "perc": (typeof y[11] === typeof undefined)? 0:y[11],
                    "color": color,
                    "txt" : (typeof x[11] === typeof undefined)? "":x[11]
                }, {
                    "test": (typeof x[12] === typeof undefined)? "//":13,
                    "perc": (typeof y[12] === typeof undefined)? 0:y[12],
                    "color": color,
                    "txt" : (typeof x[12] === typeof undefined)? "":x[12]
                }, {
                    "test": (typeof x[13] === typeof undefined)? "//":14,
                    "perc": (typeof y[13] === typeof undefined)? 0:y[13],
                    "color": color,
                    "txt" : (typeof x[13] === typeof undefined)? "":x[13]
                }, {
                    "test": (typeof x[14] === typeof undefined)? "//":15,
                    "perc": (typeof y[14] === typeof undefined)? 0:y[14],
                    "color": color,
                    "txt" : (typeof x[14] === typeof undefined)? "":x[14]
                }, {
                    "test": (typeof x[15] === typeof undefined)? "//":16,
                    "perc": (typeof y[15] === typeof undefined)? 0:y[15],
                    "color": color,
                    "txt" : (typeof x[15] === typeof undefined)? "":x[15]
                }, {
                    "test": (typeof x[16] === typeof undefined)? "//":17,
                    "perc": (typeof y[16] === typeof undefined)? 0:y[16],
                    "color": color,
                    "txt" : (typeof x[16] === typeof undefined)? "":x[16]
                }, {
                    "test": (typeof x[17] === typeof undefined)? "//":18,
                    "perc": (typeof y[17] === typeof undefined)? 0:y[17],
                    "color": color,
                    "txt" : (typeof x[17] === typeof undefined)? "":x[17]
                }, {
                    "test": (typeof x[18] === typeof undefined)? "//":19,
                    "perc": (typeof y[18] === typeof undefined)? 0:y[18],
                    "color": color,
                    "txt" : (typeof x[18] === typeof undefined)? "":x[18]
                }, {
                    "test": (typeof x[19] === typeof undefined)? "//":20,
                    "perc": (typeof y[19] === typeof undefined)? 0:y[19],
                    "color": color,
                    "txt" : (typeof x[19] === typeof undefined)? "":x[19]
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


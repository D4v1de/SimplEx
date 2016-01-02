var getStatisticheTest = function (id,str,modal) {
    idCorso = id;
    alert(idCorso);
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
var getStatisticheDomande = function (id,str,modal) {
    idCorso = id;
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
                    "color": color
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color
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
                    "valueField": "perc"
                }],
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
                    "color": color
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
                    "color": color
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
                    "valueField": "perc"
                }],
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
                    "color": color
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
                    "color": color
                }, {
                    "test": "Test " + x[10],
                    "perc": y[10],
                    "color": color
                }, {
                    "test": "Test " + x[11],
                    "perc": y[11],
                    "color": color
                }, {
                    "test": "Test " + x[12],
                    "perc": y[12],
                    "color": color
                }, {
                    "test": "Test " + x[13],
                    "perc": y[13],
                    "color": color
                }, {
                    "test": "Test " + x[14],
                    "perc": y[14],
                    "color": color
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
                    "valueField": "perc"
                }],
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
                    "color": color
                }, {
                    "test": "Test " + x[1],
                    "perc": y[1],
                    "color": color
                }, {
                    "test": "Test " + x[2],
                    "perc": y[2],
                    "color": color
                }, {
                    "test": "Test " + x[3],
                    "perc": y[3],
                    "color": color
                }, {
                    "test": "Test " + x[4],
                    "perc": y[4],
                    "color": color
                }, {
                    "test": "Test " + x[5],
                    "perc": y[5],
                    "color": color
                }, {
                    "test": "Test " + x[6],
                    "perc": y[6],
                    "color": color
                }, {
                    "test": "Test " + x[7],
                    "perc": y[7],
                    "color": color
                }, {
                    "test": "Test " + x[8],
                    "perc": y[8],
                    "color": color
                }, {
                    "test": "Test " + x[9],
                    "perc": y[9],
                    "color": color
                }, {
                    "test": "Test " + x[10],
                    "perc": y[10],
                    "color": color
                }, {
                    "test": "Test " + x[11],
                    "perc": y[11],
                    "color": color
                }, {
                    "test": "Test " + x[12],
                    "perc": y[12],
                    "color": color
                }, {
                    "test": "Test " + x[13],
                    "perc": y[13],
                    "color": color
                }, {
                    "test": "Test " + x[14],
                    "perc": y[14],
                    "color": color
                }, {
                    "test": "Test " + x[15],
                    "perc": y[15],
                    "color": color
                }, {
                    "test": "Test " + x[16],
                    "perc": y[16],
                    "color": color
                }, {
                    "test": "Test " + x[17],
                    "perc": y[17],
                    "color": color
                }, {
                    "test": "Test " + x[18],
                    "perc": y[18],
                    "color": color
                }, {
                    "test": "Test " + x[19],
                    "perc": y[19],
                    "color": color
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
                    "valueField": "perc"
                }],
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
                    "test": x[0],
                    "perc": y[0],
                    "color": color
                }, {
                    "test": x[1],
                    "perc": y[1],
                    "color": color
                }, {
                    "test": x[2],
                    "perc": y[2],
                    "color": color
                }, {
                    "test": x[3],
                    "perc": y[3],
                    "color": color
                }, {
                    "test": x[4],
                    "perc": y[4],
                    "color": color
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
                    "valueField": "perc"
                }],
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


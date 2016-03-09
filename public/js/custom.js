$(document).ready(function() {
    $(window).bind('scroll', function() {
        var navHeight = 80;
        if ($(window).scrollTop() > navHeight) {
            $('#header nav').addClass('navbar-fixed-top');
            if ($('.navbar-header').children('a').length == 0) {
                $('.navbar-header').append('<a class="navbar-brand glyphicon glyphicon-menu-up" href="#"></a>');
                $('.glyphicon-menu-up').click(function() {
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    return false;
                });
            }
        } else {
            $('#header nav').removeClass('navbar-fixed-top');

            if ($('.navbar-header').children('a').length > 0) {
                $('.glyphicon-menu-up').remove();
            }
        }
    });
});

$(function() {
    //Better to construct options first and then pass it as a parameter
    var options = {
        title: {
            text: "English Chart"
        },
        animationEnabled: true,
        data: [{
                type: "spline", //change it to line, area, column, pie, etc
                dataPoints: [
                    { x: 10, y: 10 },
                    { x: 20, y: 12 },
                    { x: 30, y: 8 },
                    { x: 40, y: 14 },
                    { x: 50, y: 6 },
                    { x: 60, y: 24 },
                    { x: 70, y: -4 },
                    { x: 80, y: 10 }
                ],
                type: "spline", //change it to line, area, column, pie, etc
                dataPoints: [
                    { x: 10, y: 10 },
                    { x: 20, y: 12 },
                    { x: 30, y: 8 },
                    { x: 40, y: 14 },
                    { x: 50, y: 6 },
                    { x: 60, y: 24 },
                    { x: 70, y: -4 },
                    { x: 80, y: 10 }
                ]
            }

        ]
    };

    $(".chartContainer1").CanvasJSChart(options);

});
$(function() {
    //Better to construct options first and then pass it as a parameter
    var options = {
        title: {
            text: "SW"
        },
        animationEnabled: true,
        data: [{
            type: "spline", //change it to line, area, column, pie, etc
            dataPoints: [
                { x: 10, y: 10 },
                { x: 20, y: 12 },
                { x: 30, y: 8 },
                { x: 40, y: 14 },
                { x: 50, y: 6 },
                { x: 60, y: 24 },
                { x: 70, y: -4 },
                { x: 80, y: 10 }
            ]
        }]
    };

    $(".chartContainer3").CanvasJSChart(options);

});

window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer2",
    {      
      theme:"theme2",
      title:{
        text: "Feedback"
      },
      animationEnabled: true,
      axisY :{
        includeZero: false,
        // suffix: " k",
        valueFormatString: "#,,.",
        suffix: ""
        
      },
      toolTip: {
        shared: "true"
      },
      data: [
      {        
        type: "spline", 
        showInLegend: true,
        name: "Bad",
        // markerSize: 0,        
        // color: "rgba(54,158,173,.6)",
        dataPoints: [
        {label: "Jan", y: 1},
        {label: "Feb", y: 2},        
        {label: "Mar", y: 5},        
        {label: "Apr", y: 3},        
        {label: "May", y: 5},        
        {label: "Jun", y: 6},        
        {label: "Jul", y: 7},        
        {label: "Aug", y: 7},        
        {label: "Sep", y: 9},        
        {label: "Oct", y: 20},
        {label: "Nov", y: 10},
        {label: "Dec", y: 11}

        ]
      },
      {        
        type: "spline", 
        showInLegend: true,
        // markerSize: 0,
        name: "Good",
        dataPoints: [
        {label: "Jan", y: 1},
        {label: "Feb", y: 5},        
        {label: "Mar", y: 2},        
        {label: "Apr", y: 3},        
        {label: "May", y: 8},        
        {label: "Jun", y: 4},        
        {label: "Jul", y: 9},        
        {label: "Aug", y: 10},        
        {label: "Sep", y: 6},        
        {label: "Oct", y: 7},
        {label: "Nov", y: 11},
        {label: "Dec", y: 12}     

        ]
      } 
      

      ],
      legend:{
        cursor:"pointer",
        itemclick : function(e) {
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
            e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;
          }
          chart.render();
        }
        
      },
    });

chart.render();
}





var tax_data = [
    {"period": "2013-04", "visits": 2407, "signups": 660},
    {"period": "2013-03", "visits": 3351, "signups": 729},
    {"period": "2013-02", "visits": 2469, "signups": 1318},
    {"period": "2013-01", "visits": 2246, "signups": 461},
    {"period": "2012-12", "visits": 3171, "signups": 1676},
    {"period": "2012-11", "visits": 2155, "signups": 681},
    {"period": "2012-10", "visits": 1226, "signups": 620},
    {"period": "2012-09", "visits": 2245, "signups": 500}
];
Morris.Line({
    element: 'hero-graph1',
    data: tax_data,
    xkey: 'period',
    xLabels: "month",
    ykeys: ['visits', 'signups'],
    labels: ['Visits', 'User signups']
});
Morris.Line({
    element: 'hero-graph2',
    data: tax_data,
    xkey: 'period',
    xLabels: "month",
    ykeys: ['visits', 'signups'],
    labels: ['Visits', 'User signups']
});
Morris.Line({
    element: 'hero-graph3',
    data: tax_data,
    xkey: 'period',
    xLabels: "month",
    ykeys: ['visits', 'signups'],
    labels: ['Visits', 'User signups']
});
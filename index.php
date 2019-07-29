<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//thingspeak.com/highcharts-3.0.8.js"></script>
<script type="text/javascript" src="//thingspeak.com/exporting.js"></script>
<meta property="og:image" content="http://www.piersoft.it/mkrfox1200/mkrfox1200.png" />
  <title><?php printf($_GET['location']); ?></title>
    <!-- EXTERNAL LIBS-->
    <style type="text/css">
     body { background-color: #FFFFFF; }
    // #chart-container { height: 100%; width: 100%; display: table; }
       #rilevazione {  }
     #gauge_apm10 {  vertical-align: middle; display: table-cell; }
     #gauge_at { vertical-align: middle; display: table-cell; }
     #gauge_apm25 { vertical-align: middle; display: table-cell; }
     #gauge_aum { vertical-align: middle; display: table-cell; }
  //  #chart-container { vertical-align: middle; display: table-cell; }
  //   #chart-container2 { width: 100%; height: 95%; display: table-cell; position:absolute; bottom:0; top:0; left:0; right:0; margin: 5px 15px 15px 0; overflow: hidden; }
 </style>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>

 // set your channel id here
 var channel_id = <?php printf($_GET['channel_id']); ?>;
 // set your channel's read api key here if necessary
 var api_key = '<?php printf($_GET['readkey']); ?>';
 // maximum value for the gauges
 var max_gauge_value = 100;
 // name of the gauges
 var gauge_at = 'Temp.';
 var gauge_apm10 = 'PM10';
 var gauge_apm25 = 'PM2.5';
 var gauge_aum = 'Umid.';
 var series_1_channel_id = <?php printf($_GET['channel_id']); ?>;
 var series_1_field_number = 3;
 var series_1_read_api_key = '<?php printf($_GET['readkey']); ?>';
 var series_1_results = 250;
 var series_1_color = '#D62020';

 // variables for 3th series
var series_3_channel_id = <?php printf($_GET['channel_id']); ?>;
var series_3_field_number = 2;
var series_3_read_api_key = '<?php printf($_GET['readkey']); ?>';
var series_3_results = 250;
var series_3_color = '#D62020';

// variables for 4th series
var series_4_channel_id = <?php printf($_GET['channel_id']); ?>;
var series_4_field_number = 1;
var series_4_read_api_key = '<?php printf($_GET['readkey']); ?>';
var series_4_results = 250;
var series_4_color = '#00caff';

 // global variables+
 var chart_at, chart_apm10, chart_apm25, chart_aum, charts, data;

 // load the google gauge visualization

 google.load('visualization', '1', {packages:['gauge']});
 google.setOnLoadCallback(initChart);

 // display the data
 function displayData(point,cht) {
   if(cht==1) {
      data.setValue(0, 0, gauge_at);
      data.setValue(0, 1, point);
      chart_at.draw(data, options_at);
   }
   if(cht==2) {
      data.setValue(0, 0, gauge_apm10);
      data.setValue(0, 1, point);
      chart_apm10.draw(data, options_apm10);
   }
   if(cht==3) {
      data.setValue(0, 0, gauge_apm25);
      data.setValue(0, 1, point);
      chart_apm25.draw(data, options_apm25);
   }
   if(cht==4) {
      data.setValue(0, 0, gauge_aum);
      data.setValue(0, 1, point);
      chart_aum.draw(data, options_aum);
   }
 }
 function formatDate(d) {
     var myDate = new Date(d);
     var hrs = ((myDate.getHours() > 12) ? myDate.getHours()-12 : myDate.getHours());
     var amPM = ((myDate.getHours() >= 12) ? "PM" : "AM");

     if (hrs==0) hrs = 12;

     var formattedDate =  myDate.getHours() + ":" + myDate.getMinutes() + " del "+myDate.getDate()+ "-" + (myDate.getMonth() + 1) + "-" + myDate.getFullYear();

     return formattedDate;
 }
 // load the data
 function loadData() {
   // variable for the data point
   var p_at;
   var p_pm10;
      var p_pm25;
         var p_um;
   // get the data from thingspeak
   $.getJSON('https://api.thingspeak.com/channels/' + channel_id + '/feed/last.json?api_key=' + api_key, function(data) {

     // get the data point
//console.log(data.field1+ ','+data.field2+','+data.field3+ ','+data.field4);
var myFormattedDate = formatDate(data.created_at);
document.getElementById('rilevazione').innerHTML += '<h3>Ultima rilevazione: '+myFormattedDate+'</h3>';

     p_at = data.field3;
     displayData(p_at,1);
     p_pm10 = data.field1;
     displayData(p_pm10,2);
     p_pm25 = data.field2;
     displayData(p_pm25,3);
     p_um = data.field4;
     displayData(p_um,4);
     // if there is a data point display it
   });

 }

 // initialize the chart
 function initChart() {
   data = new google.visualization.DataTable();
   data.addColumn('string', 'Label');
   data.addColumn('number', 'Value');
   data.addRows(1);

   chart_at = new google.visualization.Gauge(document.getElementById('gauge_at'));

//   options_at = {width: 240, height: 240, redFrom: 30, redTo: 40, yellowFrom:24, yellowTo: 30, greenFrom: 19, greenTo: 24, minorTicks: 2, max: 40, min: 10};
   options_at={min:10,max:100,width: 150,height: 150,minorTicks:25,majorTicks:['10','20','30','40','50','60','70','80','90','100'], greenColor:'#aaf086',yellowColor:'#f9f92d',redColor:'#fd8181', yellowFrom:22, yellowTo:27, greenFrom:10, greenTo:22, redFrom:27, redTo: 50};
  // loadData();
   chart_apm10 = new google.visualization.Gauge(document.getElementById('gauge_apm10'));

//   options_at = {width: 240, height: 240, redFrom: 30, redTo: 40, yellowFrom:24, yellowTo: 30, greenFrom: 19, greenTo: 24, minorTicks: 2, max: 40, min: 10};
   options_apm10={min:10,max:100,width: 150,height: 150,minorTicks:25,majorTicks:['10','20','30','40','50','60','70','80','90','100'], greenColor:'#aaf086',yellowColor:'#f9f92d',redColor:'#fd8181', yellowFrom:35, yellowTo:49, greenFrom:5, greenTo:35, redFrom:50, redTo: 100};

   chart_apm25 = new google.visualization.Gauge(document.getElementById('gauge_apm25'));

//   options_at = {width: 240, height: 240, redFrom: 30, redTo: 40, yellowFrom:24, yellowTo: 30, greenFrom: 19, greenTo: 24, minorTicks: 2, max: 40, min: 10};
   options_apm25={min:10,max:100,width: 150,height: 150,minorTicks:25,majorTicks:['10','20','30','40','50','60','70','80','90','100'], greenColor:'#aaf086',yellowColor:'#f9f92d',redColor:'#fd8181', yellowFrom:15, yellowTo:25, greenFrom:5, greenTo:15, redFrom:25, redTo: 100};

   chart_aum = new google.visualization.Gauge(document.getElementById('gauge_aum'));

//   options_at = {width: 240, height: 240, redFrom: 30, redTo: 40, yellowFrom:24, yellowTo: 30, greenFrom: 19, greenTo: 24, minorTicks: 2, max: 40, min: 10};
   options_aum={min:10,max:100,width: 150,height: 150,minorTicks:25,majorTicks:['10','20','30','40','50','60','70','80','90','100'], greenColor:'#aaf086',yellowColor:'#f9f92d',redColor:'#fd8181', yellowFrom:80, yellowTo:99, greenFrom:5, greenTo:80, redFrom:100, redTo: 100};


   loadData();

   // load new data every 600 seconds
   setInterval('loadData()', 600000);
 }
 // chart title
  var chart_title = 'Serie storica monitoraggio PM10 e PM2.5 in μg/m3';
  // y axis title
  var y_axis_title = 'Valori';

  // user's timezone offset
  var my_offset = new Date().getTimezoneOffset();
  // chart variable
  var my_chart;

  // when the document is ready
  $(document).on('ready', function() {
    // add a blank chart
    addChart();
    // add the first series
  //  addSeries(series_1_channel_id, series_1_field_number, series_1_read_api_key, series_1_results, series_1_color);
    // add the second series
    addSeries(series_3_channel_id, series_3_field_number, series_3_read_api_key, series_3_results, series_3_color);
    addSeries(series_4_channel_id, series_4_field_number, series_4_read_api_key, series_4_results, series_4_color);

  });

  // add the base chart
  function addChart() {
    // variable for the local date in milliseconds
    var localDate;

    // specify the chart options
    var chartOptions = {
      chart: {
        renderTo: 'chart-container',
        defaultSeriesType: 'line',
        backgroundColor: '',
        events: { }
      },
      title: { text: chart_title },
      plotOptions: {
        series: {
          marker: { radius: 3 },
          animation: true,
          step: false,
          borderWidth: 0,
          turboThreshold: 0
        }
      },
      tooltip: {
        // reformat the tooltips so that local times are displayed
        formatter: function() {
          var d = new Date(this.x + (my_offset*60000));
          var n = (this.point.name === undefined) ? '' : '<br>' + this.point.name;
          return this.series.name + ':<b>' + this.y + '</b>' + n + '<br>' + d.toDateString() + '<br>' + d.toTimeString().replace(/\(.*\)/, "");
        }
      },
      xAxis: {
        type: 'datetime',
        title: { text: 'Data' }
      },
      yAxis: { title: { text: y_axis_title } ,max: 100},
      exporting: { enabled: false },
      legend: { enabled: true },
      credits: {
        text: 'Powered by @piersoft on ThingSpeak.com',
        href: 'https://thingspeak.com/',
        style: { color: '#D62020' }
      }
    };

    // draw the chart
    my_chart = new Highcharts.Chart(chartOptions);
  }

  // add a series to the chart
  function addSeries(channel_id, field_number, api_key, results, color) {
    var field_name = 'field' + field_number;

    // get the data with a webservice call
    $.getJSON('https://api.thingspeak.com/channels/' + channel_id + '/fields/' + field_number + '.json?offset=0&round=2&results=' + results + '&api_key=' + api_key, function(data) {
console.log('https://api.thingspeak.com/channels/' + channel_id + '/fields/feed.json?offset=0&round=2&results=' + results + '&api_key=' + api_key);
      // blank array for holding chart data
      var chart_data = [];

      // iterate through each feed
      $.each(data.feeds, function() {
        var point = new Highcharts.Point();
    //    data.feeds[0].field2=data.feeds[0].field2/10;
        // set the proper values
        var value = this[field_name];
        point.x = getChartDate(this.created_at);
      //  console.log(data.feeds[0].field2);

        point.y = parseFloat(value);
        // add location if possible
        if (this.location) { point.name = this.location; }
        // if a numerical value exists add it
        if (!isNaN(parseInt(value))) { chart_data.push(point); }
      });

      // add the chart data
      my_chart.addSeries({ data: chart_data, name: data.channel[field_name], color: color });
    });
  }

  // converts date format from JSON
  function getChartDate(d) {
    // get the data using javascript's date object (year, month, day, hour, minute, second)
    // months in javascript start at 0, so remember to subtract 1 when specifying the month
    // offset in minutes is converted to milliseconds and subtracted so that chart's x-axis is correct
    return Date.UTC(d.substring(0,4), d.substring(5,7)-1, d.substring(8,10), d.substring(11,13), d.substring(14,16), d.substring(17,19)) - (my_offset * 60000);
  }
    </script>

  </head>
</head>
<body style="text-align:center">


  <div id="chart-container">
    <img alt="Ajax loader" src="//thingspeak.com/assets/loader-transparent.gif" style="position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;" />
</div>
    <div id="rilevazione"></div>
<!--  style="width:12%;margin-left:auto;margin-right:auto;align:middle" -->
  <div style="width:50%;margin-left:auto;margin-right:auto;align:middle">
    <div id="gauge_at"></div>
    <div id="gauge_apm10"></div>
    <div id="gauge_apm25"></div>
    <div id="gauge_aum"></div>
</div>
<div>
  <?php
if ($_GET['widget'] !=''){

?>
<h3>PM10 media giorno precedente:</h3>

<iframe width="450" height="260" style="border: 1px solid #FFFFFF; background-color: #FFFFFF;" src="https://thingspeak.com/channels/<?php printf($_GET['channel_idmedia']); ?>/widgets/<?php printf($_GET['widget']); ?>"></iframe>
<?php }   ?>
</div>

  <h2>Centralina amatoriale situata presso <?php printf($_GET['location']); ?></h2>
  <h2>Basata su Wemos D1 + DHT22 + SDS011</h2>
  <a href='https://api.thingspeak.com/channels/<?php printf($_GET['channel_id']); ?>/feeds.csv?results=6000'><h2>Scarica il file CSV della serie storica (max 6000 records)</h2></a>
  <h2>Valori di riferimento</h2>
  <img src="riferimenti.png" style="width: 50%;">
</body>

</html>

<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">
            <?php $this->get_include('auth/houseview-sidebar') ?>

            <div class="col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <?php $this->get_include('auth/bills/subnav') ?>
                    <div class="panel-body panel-body_bills-summary">
                        <div class="row larger-font">
                            <div class="col-sm-3 text-center">
                                <strong class="data-value">
                                    <small>£</small><?php echo Utils::intword(number_format($this->context['summary']['total_p_month'] / 100.0, 2, '.', ',')) ?>
                                </strong>
                                <span class="data-label">
                                    total bills last month (GPB)
                                </span>
                            </div>
                            <div class="col-sm-3 text-center">
                                <strong class="data-value">
                                    <?php echo Utils::escape($this->context['summary']['total_unpaid']) ?>
                                </strong>
                                <span class="data-label">unpaid bills</span>
                            </div>
                            <div class="col-sm-3 text-center">
                                <strong class="data-value">
                                    <?php echo Utils::escape($this->context['summary']['total_count']) ?>
                                </strong>
                                <span class="data-label">total count</span>
                            </div>
                            <div class="col-sm-3 text-center" data-toggle="tooltip" data-placement="bottom" title="£<b><?php echo Utils::escape(number_format($this->context['summary']['total_volume'] / 100.0, 2, '.', ',')) ?></b>">
                                <strong class="data-value">
                                    <small>£</small><?php echo Utils::intword(number_format($this->context['summary']['total_volume'] / 100.0, 2, '.', ',')) ?>
                                </strong>
                                <span class="data-label">total volume</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="data-stats" id="billsummary-app">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>
                                                Per month volume
                                            </h5>
                                            <div id="month-volume">
                                                <div class="text-center">
                                                    <br>
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x" style="color: #ccc"></i>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>
                                                Percentage change
                                            </h5>
                                            <div id="percentage-change">
                                                <div class="text-center">
                                                    <br>
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x" style="color: #ccc"></i>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h5>
                                                New bills per month
                                            </h5>
                                            <div id="nbills-month">
                                                <div class="text-center">
                                                    <br>
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x" style="color: #ccc"></i>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->get_include('auth/footer') ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/vendor/bootstrap-confirmation-t.js') ?>" type="text/javascript"></script>
<script src="<?php echo Utils::static_file('js/dashboard.js') ?>" type="text/javascript"></script>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    var url = document.origin.concat(document.location.pathname).concat('/summary_json');
    var month_data_json = $.ajax({
        url: url,
        dataType:"json",
        async: false
    }).responseJSON.monthly_volume;

    var month_data = new google.visualization.DataTable(month_data_json);

      // set bar chart options
  var barOptions = {
      height: 150,
      focusTarget: 'category',
      backgroundColor: 'transparent',
      colors: ['#59B5EF'],
      fontName: 'Helvetica',
      chartArea: {
          left: 40,
          top: 10,
          width: '88%',
          height: '80%'
      },
      bar: {
          groupWidth: '80%'
      },
      hAxis: {
          textStyle: {
              fontSize: 10,
              color: '#888'
          }
      },
      vAxis: {
          //minValue: 0,
          //maxValue: 1500,
          baselineColor: '#DDD',
          gridlines: {
              color: '#eee',
              count: 5
          },
          textStyle: {
              fontSize: 10,
              color: '#888'
          }
      },
      legend: { position: 'none' },
      animation: {
          duration: 1200,
          easing: 'out',
          startup: true
      },
      pointSize: 5,
      tooltip: {
        //   isHtml: true,
        //   trigger: 'selection'
      }
  };

      var percentage_data = google.visualization.arrayToDataTable([
          ['Month', 'Volume (GPB)'],
          ['July',      0],
          ['August',    0],
          ['November',  0],
          ['December',  0],
          ['January',   0],
          ['February',  0],
          ['March',     0]
      ]);

      var nbillsm_data = google.visualization.arrayToDataTable([
          ['Month', ''],
          ['July',      0],
          ['August',    0],
          ['November',  0],
          ['December',  0],
          ['January',   0],
          ['February',  0],
          ['March',     0]
      ]);

      // draw bar chart twice so it animates
      var month_chart = new google.visualization.AreaChart(document.getElementById('month-volume'));
      month_chart.draw(month_data, barOptions);

      var percentage_chart = new google.visualization.LineChart(document.getElementById('percentage-change'));
      percentage_chart.draw(percentage_data, barOptions);

      var nbillsm_chart = new google.visualization.LineChart(document.getElementById('nbills-month'));
      nbillsm_chart.draw(nbillsm_data, barOptions);
  }
</script>

<script type="text/javascript">
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    })
});
</script>
</body>
</html>

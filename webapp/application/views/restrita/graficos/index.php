
 
    <div class="main-wrapper main-wrapper-1">
      
      <?php $this->load->view('restrita/layout/navbar') ?>

      <?php $this->load->view('restrita/layout/sidebar') ?>
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

          <div class="row ">
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Quantidade de anúncios por categoria pai</h4>
                  </div>
                  <div class="card-body">
                    <div class="recent-report__chart">
                      <div id="chart7"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Bar Chart</h4>
                  </div>
                  <div class="card-body">
                    <div class="recent-report__chart">
                      <div id="chart2"></div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
                     
          </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_config') ?>
      </div>

      <?php 
        echo'<script>
                function chart7() {
                  var options = {
                      chart: {
                          width: 500,
                          type: \'pie\',
                      },
                      labels: [';
                      
                          foreach($dados_2 as $dado){
                              echo " '$dado->categoria_pai_nome', ";
                          }
                           
                      echo'],
                      series: [';

                          foreach($dados_2 as $dado){
                            echo $dado->quantidade.', ';
                          }
                        
                      echo'],
                      responsive: [{
                          breakpoint: 480,
                          options: {
                              chart: {
                                  width: 400
                              },
                              legend: {
                                  position: \'bottom\'
                              }
                          }
                      }]
                  }

                  var chart = new ApexCharts(
                      document.querySelector("#chart7"),
                      options
                  );

                  chart.render();
                }

                function chart2() {

                  var options = {
                      chart: {
                          height: 350,
                          type: \'bar\',
                      },
                      plotOptions: {
                          bar: {
                              dataLabels: {
                                  position: \'top\', // top, center, bottom
                              },
                          }
                      },
                      dataLabels: {
                          enabled: true,
                          formatter: function(val) {
                              return val + "%";
                          },
                          offsetY: -20,
                          style: {
                              fontSize: \'12px\',
                              colors: ["#9aa0ac"]
                          }
                      },
                      series: [{
                          name: \'Inflation\',
                          data: [';
                          $cont=1;
                          foreach($datas as $data){
                            
                          }
                            echo']
                      }],
                      xaxis: {
                          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                          position: \'top\',
                          labels: {
                              offsetY: -18,
                              style: {
                                  colors: \'#9aa0ac\',
                              }
                          },
                          axisBorder: {
                              show: false
                          },
                          axisTicks: {
                              show: false
                          },
                          crosshairs: {
                              fill: {
                                  type: \'gradient\',
                                  gradient: {
                                      colorFrom: \'#D8E3F0\',
                                      colorTo: \'#BED1E6\',
                                      stops: [0, 100],
                                      opacityFrom: 0.4,
                                      opacityTo: 0.5,
                                  }
                              }
                          },
                          tooltip: {
                              enabled: true,
                              offsetY: -35,
              
                          }
                      },
                      fill: {
                          gradient: {
                              shade: \'light\',
                              type: "horizontal",
                              shadeIntensity: 0.25,
                              gradientToColors: undefined,
                              inverseColors: true,
                              opacityFrom: 1,
                              opacityTo: 1,
                              stops: [50, 0, 100, 100]
                          },
                      },
                      yaxis: {
                          axisBorder: {
                              show: false
                          },
                          axisTicks: {
                              show: false,
                          },
                          labels: {
                              show: false,
                              formatter: function(val) {
                                  return val + "%";
                              }
                          }
              
                      },
                      title: {
                          text: \'Monthly Inflation in Argentina, 2002\',
                          floating: true,
                          offsetY: 320,
                          align: \'center\',
                          style: {
                              color: \'#9aa0ac\'
                          }
                      },
                  }
              
                  var chart = new ApexCharts(
                      document.querySelector("#chart2"),
                      options
                  );
              
                  chart.render();
              
              }

       </script> ';
      ?>
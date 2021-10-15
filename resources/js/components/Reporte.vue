<template>
 
  <div>
    <highcharts class="hc" :options="chartOptions" ref="chart2"></highcharts>
    <highcharts class="hc" :options="chartOptions2" ref="chart2"></highcharts>
    <button @click="exportChart">Export Chart as SVG</button>
  </div>

  
</template>

<script>
import Highcharts from "highcharts";
import ExportingHighcharts from "highcharts/modules/exporting";
import svg64 from "svg64";
import HighchartsVue from "highcharts-vue";

ExportingHighcharts(Highcharts,svg64);
Vue.use(HighchartsVue);

export default {
  methods: {
    exportChart() {
      var special = document.querySelectorAll( "svg" );
      let svg = this.$refs.chart2.chart.container.innerHTML;
      let svgFull = this.$refs.chart2.chart;

      // const b64 = svg64(svg);
      // console.log(b64);

      // console.log(svgFull)

      for (const value of special) {

          const b64 = svg64(value);
          console.log(b64);

            // console.log(value);
          }
      // console.log(special[0])
    }
  },
  data() {
    return {
      chartOptions: {

        chart: {
            type: 'line'
          },

          title: {
            text: 'Codigo De Limpieza ISO 4406'
          },

          xAxis: {
            categories: ['22/14/09', '18/13/09', '18/14/10', '23/22/11']
          },
          
          yAxis: [{ //--- Primary yAxis
            title: {
                text: 'Parametros'
            }
        }],

          plotOptions: {
            line: {
              dataLabels: {
                enabled: true
              },
              enableMouseTracking: true
            },
            area: {
              fillColor: {
                pattern: {
                  path: {
                    d: 'M 0 0 L 10 10 M 9 -1 L 11 1 M -1 9 L 1 11',
                    strokeWidth: 0
                  },
                  width: 10,
                  height: 10,
                  opacity: 0.4
                }
              }
            }
          },


        series: [
          {
          name: 'Parametros',
          data: [20392, 1989, 2340, 53857],
          color: '#17202A'
          }, 
          {
            name: 'Peligro',
            data: [15000, 15000, 15000, 15000],
            color: '#e88'
          }, 
          {
            name: 'Alerta',
            data: [5000, 5000, 5000, 5000],
            color: '#DC7633',
          }
        ]
      }
      
      ,
      chartOptions2: {

        chart: {
            type: 'area'
          },

          title: {
            text: 'Codigo2 De Limpieza ISO 4406'
          },

          xAxis: {
            categories: ['22/14/09', '18/13/09', '18/14/10', '23/22/11']
          },
          
          yAxis: [{ //--- Primary yAxis
            title: {
                text: 'Parametros'
            }
        }],

          plotOptions: {
            area: {
              fillColor: {
                pattern: {
                  path: {
                    d: 'M 0 0 L 10 10 M 9 -1 L 11 1 M -1 9 L 1 11',
                    strokeWidth: 0
                  },
                  width: 10,
                  height: 10,
                  opacity: 0.4
                }
              }
            }
          },


        series: [
          {
          name: 'Parametros',
          data: [20392, 1989, 2340, 53857],
          color: '#17202A'
          }, 
          {
            name: 'Peligro',
            data: [15000, 15000, 15000, 15000],
            color: '#e88'
          }, 
          {
            name: 'Alerta',
            data: [5000, 5000, 5000, 5000],
            color: '#DC7633',
          }
        ]
      }
    };
  },
  
};

// export default {
//   name: 'BasicChartSample',
//   components: {
//     ColumnChart
//   },
//   data () {
//     return {
//       chart: {
//         xAxis: {
//           categories: [2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007]
//         },
//         series: [
//           {
//             name: 'Installation',
//             color: '#03bbd4',
//             data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
//           },
//           {
//             name: 'Manufacturing',
//             color: '#f7a35c',
//             data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
//           }
//         ]
//       }
//     }
//   }
// }
</script>

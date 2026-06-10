@extends('layouts.list')

@section('ListPreTittle')
    Detalle de Gastos de la Casa
@endsection

@section('ListTittle')
    Gastos
@endsection

@section('ListBody')

<div class="row row-deck row-cards">
    <x-widget.cardsm 
      md="6" xl="4"
      route="tareas"
      icon="ti-list-check"
      :titulo="$widTareas['titulo']"
      :subtitulo="$widTareas['subtitulo']"
    />

    @if ($widLiquidaciones->count() > 0)
        @foreach ($widLiquidaciones as $widLiquidacion)
            <x-widget.cardsm 
                md="6" xl="4" bg="danger"
                route="pagos_tarjetas"
                icon="ti-credit-card"
                :titulo="$widLiquidacion->descripcion_tarjeta . ' ' . $widLiquidacion->periodo_format . ' - ' . $widLiquidacion->total_pagado_format"
                :subtitulo="'Liquidación a pagar el ' . $widLiquidacion->fecha_pago_format"
            />
        @endforeach
    @endif
</div>

<div class="row row-deck row-cards">
   <div class="col-lg-6 col-xl-6">
        <div class="card">
        <div class="card-body">
            <h3 class="card-title">Mis Movimientos</h3>
            <div id="chart-mis-movimientos">
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-6">
      <div class="card">
      <div class="card-body">
          <h3 class="card-title">Saldos Mensuales</h3>
          <div id="chart-mis-saldos">
          </div>
      </div>
      </div>
  </div>

</div>
    <!-- <div class="col-lg-6 col-xl-6">
        <div class="card">
        <div class="card-body">
            <h3 class="card-title">Deuda Tarjetas</h3>
            <div id="chart-deuda-tarjetas">
            </div>
        </div>
        </div>
    </div> -->

</div>

@endsection

@section('Bundles')
<script src="./libs/apexcharts/dist/apexcharts.min.js" defer></script>
@endsection

@section('PageJs')
<script>
    init = function($) {};  
    document.addEventListener("DOMContentLoaded", function () {
        let chart1 = new ApexCharts(document.getElementById('chart-mis-movimientos'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            noData: {
                text: 'Loading...'
            },
            series: {!! $serieGastos !!},
            tooltip: {
                theme: 'dark'
            },
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'string',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: {!! $labelGastos !!},
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)", "color-mix(in srgb, transparent, var(--tblr-danger) 100%)"],
            legend: {
                show: false,
            }
        });
        chart1.render();

        let chart2 = new ApexCharts(document.getElementById('chart-mis-saldos'), {
          chart: {
      			type: "line",
      			fontFamily: 'inherit',
      			height: 240,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		fill: {
      			opacity: 1,
      		},
      		stroke: {
      			width: 2,
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
      			name: "Saldo Mensual",
      			data: {!! $serieDiferencias !!}
      		}],
      		tooltip: {
      			theme: 'dark'
      		},
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			type: 'datetime',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
          labels: {!! $labelDiferencias !!},
      		colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
      		legend: {
      			show: false,
      		}
        });
        chart2.render();

        // let chart3 = new ApexCharts(document.getElementById('chart-deuda-tarjetas'), {
        //   chart: {
        //       type: "bar",
        //       fontFamily: "inherit",
        //       height: 240,
        //       parentHeightOffset: 0,
        //       toolbar: {
        //         show: false,
        //       },
        //       animations: {
        //         enabled: false,
        //       },
        //     },
        //     plotOptions: {
        //       bar: {
        //         columnWidth: "50%",
        //       },
        //     },
        //     dataLabels: {
        //       enabled: false,
        //     },
        //     series: [
        //       {
        //         name: "Development",
        //         data: [30, 20, 50, 40, 60, 50],
        //       },
        //       {
        //         name: "Marketing",
        //         data: [200, 130, 90, 240, 130, 220],
        //       },
        //       {
        //         name: "Sales",
        //         data: [300, 200, 160, 400, 250, 250],
        //       },
        //       {
        //         name: "Sales",
        //         data: [200, 130, 90, 240, 130, 220],
        //       },
        //     ],
        //     tooltip: {
        //       theme: "dark",
        //     },
        //     grid: {
        //       padding: {
        //         top: -20,
        //         right: 0,
        //         left: -4,
        //         bottom: -4,
        //       },
        //       strokeDashArray: 4,
        //     },
        //     xaxis: {
        //       labels: {
        //         padding: 0,
        //       },
        //       tooltip: {
        //         enabled: false,
        //       },
        //       axisBorder: {
        //         show: false,
        //       },
        //       categories: ["2013", "2014", "2015", "2016", "2017", "2018"],
        //     },
        //     yaxis: {
        //       labels: {
        //         padding: 4,
        //       },
        //     },
        //     colors: [
        //       "color-mix(in srgb, transparent, var(--tblr-green) 100%)",
        //       "color-mix(in srgb, transparent, var(--tblr-pink) 100%)",
        //       "color-mix(in srgb, transparent, var(--tblr-green) 100%)",
        //       "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
        //     ],
        //     legend: {
        //       show: false,
        //     }
        // });
        // chart3.render();
    });
    

</script>
  @endsection
@extends('layouts.list')

@section('ListPreTittle')
    Detalle de Gastos de la Casa
@endsection

@section('ListTittle')
    Gastos
@endsection

@section('ListBody')

<div class="row row-deck row-cards">
    {{-- <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Sales</div>
            <div class="ms-auto lh-1">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item active" href="#">Last 7 days</a>
                  <a class="dropdown-item" href="#">Last 30 days</a>
                  <a class="dropdown-item" href="#">Last 3 months</a>
                </div>
              </div>
            </div>
          </div>
          <div class="h1 mb-3">75%</div>
          <div class="d-flex mb-2">
            <div>Conversion rate</div>
            <div class="ms-auto">
              <span class="text-green d-inline-flex align-items-center lh-1">
                7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
              </span>
            </div>
          </div>
          <div class="progress progress-sm">
            <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
              <span class="visually-hidden">75% Complete</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Revenue</div>
            <div class="ms-auto lh-1">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item active" href="#">Last 7 days</a>
                  <a class="dropdown-item" href="#">Last 30 days</a>
                  <a class="dropdown-item" href="#">Last 3 months</a>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-baseline">
            <div class="h1 mb-0 me-2">$4,300</div>
            <div class="me-auto">
              <span class="text-green d-inline-flex align-items-center lh-1">
                8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
              </span>
            </div>
          </div>
        </div>
        <div id="chart-revenue-bg" class="chart-sm"></div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">New clients</div>
            <div class="ms-auto lh-1">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item active" href="#">Last 7 days</a>
                  <a class="dropdown-item" href="#">Last 30 days</a>
                  <a class="dropdown-item" href="#">Last 3 months</a>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-baseline">
            <div class="h1 mb-3 me-2">6,782</div>
            <div class="me-auto">
              <span class="text-yellow d-inline-flex align-items-center lh-1">
                0% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="12" x2="19" y2="12" /></svg>
              </span>
            </div>
          </div>
          <div id="chart-new-clients" class="chart-sm"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="subheader">Active users</div>
            <div class="ms-auto lh-1">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item active" href="#">Last 7 days</a>
                  <a class="dropdown-item" href="#">Last 30 days</a>
                  <a class="dropdown-item" href="#">Last 3 months</a>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-baseline">
            <div class="h1 mb-3 me-2">2,986</div>
            <div class="me-auto">
              <span class="text-green d-inline-flex align-items-center lh-1">
                4% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
              </span>
            </div>
          </div>
          <div id="chart-active-users" class="chart-sm"></div>
        </div>
      </div>
    </div> --}}

    <x-widget.cardsm 
      md="6" xl="3"
      route="tareas"
      icon="ti-list-check"
      :titulo="$widTareas['titulo']"
      :subtitulo="$widTareas['subtitulo']"
    />

    @if ($widLiquidacion)
    <x-widget.cardsm 
      md="6" xl="3" bg="danger"
      route="pagos_tarjetas"
      icon="ti-credit-card-filled"
      :titulo="$widLiquidacion->periodo_format . ' - ' . $widLiquidacion->total_pagado_format"
      subtitulo="Liquidación pendiente de pago"
    />
    @endif

    <div class="col-md-6 col-xl-6">
    </div>

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

    <div class="col-lg-6 col-xl-6">
        <div class="card">
        <div class="card-body">
            <h3 class="card-title">Deuda Tarjetas</h3>
            <div id="chart-completion-tasks-8">
            </div>
        </div>
        </div>
    </div>

</div>

@endsection

@section('Bundles')
<script src="./libs/apexcharts/dist/apexcharts.min.js" defer></script>
@endsection

@section('PageJs')
<script>
    init = function($) {};  
    document.addEventListener("DOMContentLoaded", function () {
        var chart8 = new ApexCharts(document.getElementById('chart-mis-movimientos'), {
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
            labels: ["Mar 24", "Abr 24", "May 24","Jun 24","Jul 24","Ago 24","Sep 24","Oct 24","Nov 24", 'Dic 24', "Ene 25", "Feb 25" ],
            colors: [tabler.getColor("primary"), tabler.getColor("red")],
            legend: {
                show: false,
            }
        });
        chart8.render();
    });

    document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-mis-saldos'), {
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
      			data: [-209744.42, 34082.17, 105469.92, -365523.41, 1495864.45, 2078248.48, -105094.76, 700405.55, -683211.4, -2149757.16, -118763.16, 72816.19]
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
          labels: [
            "2024-03-01",
            "2024-04-01",
            "2024-05-01",
            "2024-06-01",
            "2024-07-01",
            "2024-08-01",
            "2024-09-01",
            "2024-10-01",
            "2024-11-01",
            "2024-12-01",
            "2025-01-01",
            "2025-02-01"
          ],
      		colors: [tabler.getColor("primary")],
      		legend: {
      			show: false,
      		}
      	})).render();
      });
  </script>
  @endsection
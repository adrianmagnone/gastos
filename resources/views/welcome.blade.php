@extends('layouts.list')

@section('ListPreTittle')
    Breve descripcion de la pagina
@endsection

@section('ListTittle')
    Titulo de la pagina
@endsection

@section('ListActions')
<x-list.button-excel  url="exportar/cliente" text="Exportar Excel"/>
<x-list.button-add url="nuevo/cliente" text="Agregar Nuevo Cliente"/>
@endsection

@section('ListBody')
    <div class="d-flex">
        <div class="text-muted">
        Show
        <div class="mx-2 d-inline-block">
            <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
        </div>
        entries
        </div>
        <div class="ms-auto text-muted">
        Search:
        <div class="ms-2 d-inline-block">
            <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
        </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable table-sm">
            <thead>
            <tr>
                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
                </th>
                <th>Invoice Subject</th>
                <th>Client</th>
                <th>VAT No.</th>
                <th>Created</th>
                <th>Status</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001401</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                <td>
                Carlson Limited
                </td>
                <td>
                87956621
                </td>
                <td>
                15 Dec 2017
                </td>
                <td>
                <span class="badge bg-success me-1"></span> Paid
                </td>
                <td>$887</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001402</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                <td>
                Adobe
                </td>
                <td>
                87956421
                </td>
                <td>
                12 Apr 2017
                </td>
                <td>
                <span class="badge bg-warning me-1"></span> Pending
                </td>
                <td>$1200</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001403</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                <td>
                Bluewolf
                </td>
                <td>
                87952621
                </td>
                <td>
                23 Oct 2017
                </td>
                <td>
                <span class="badge bg-warning me-1"></span> Pending
                </td>
                <td>$534</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001404</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                <td>
                Salesforce
                </td>
                <td>
                87953421
                </td>
                <td>
                2 Sep 2017
                </td>
                <td>
                <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                </td>
                <td>$1500</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001405</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a></td>
                <td>
                Printic
                </td>
                <td>
                87956621
                </td>
                <td>
                29 Jan 2018
                </td>
                <td>
                <span class="badge bg-danger me-1"></span> Paid Today
                </td>
                <td>$648</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001406</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a></td>
                <td>
                Tabdaq
                </td>
                <td>
                87956621
                </td>
                <td>
                4 Feb 2018
                </td>
                <td>
                <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                </td>
                <td>$300</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001407</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo & Print</a></td>
                <td>
                Apple
                </td>
                <td>
                87956621
                </td>
                <td>
                22 Mar 2018
                </td>
                <td>
                <span class="badge bg-success me-1"></span> Paid Today
                </td>
                <td>$2500</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001408</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                <td>
                Tookapic
                </td>
                <td>
                87956621
                </td>
                <td>
                13 May 2018
                </td>
                <td>
                <span class="badge bg-success me-1"></span> Paid Today
                </td>
                <td>$940</td>
                <td class="text-end">
                <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        Action
                    </a>
                    <a class="dropdown-item" href="#">
                        Another action
                    </a>
                    </div>
                </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
        <ul class="pagination m-0 ms-auto">
            <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                prev
            </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
            <a class="page-link" href="#">
                next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
            </a>
            </li>
        </ul>
        </div>
    </div>

    <form action="https://httpbin.org/post" method="post" class="card">
        <div class="card-body">
            <x-form.hide field="nombre" value="14"/>
            <div class="row">
                <p>TEXT</p>
                <x-form.text col="3" field="nombre" value="Alberto Roberto"/>
                
                <x-form.text col="3" field="nombre" value="Alberto Roberto" label="Nombre Completo"/>

                <x-form.text col="3" field="nombre" value="Alberto Roberto" label="Nombre Completo" disabled />
                
                <x-form.text col="3" field="nombre" value="Alberto Roberto" label="Nombre Completo" id="nombre_asociado" autofocus />
            </div>

            <div class="row">
                <p>TEXT-AREA</p>
                <x-form.text-area col="3" field="descripcion" value="Descripcion del Articulo"/>
                
                <x-form.text-area col="3" field="descripcion" value="Descripcion del Articulo" disabled />    

                <x-form.text-area col="3" field="descripcion" value="Descripcion del Articulo" id="descripcion" label="Descripcion"/>
            </div>

            <div class="row">
                <p>PASS</p>

                <x-form.pass col="3" field="password" />
            </div>

            <div class="row">
                <p>INPUT-GROUP</p>

                <x-form.input-group col="3" field="precio1" text-left="$" value="500.00"/>

                <x-form.input-group col="3" field="precio2" icon-left="ti ti-file-spreadsheet" value="500.00"/>

                <x-form.input-group col="3" field="precio3" icon-right="ti ti-file-spreadsheet" value="500.00"/>  

                <x-form.input-group col="3" field="correo" text-right="@gmail.com" value="micasilla" label="Correo"/>  
                
            </div>

            <div class="row">
                <p>PLAIN</p>

                <x-form.plain col="3" field="read" value="Solo Lectura"/>

                <x-form.plain col="3" field="read2" value="Solo Lectura" label="Campo Fijo"/>
            </div>


            <div class="row">
                <p>PLAIN-AREA</p>
            </div>

            <div class="row">
                <p>SEARCH</p>

                <x-form.search col="4" field="buscar1" titulo-modal="Seleccionar Valor" place-holder="Seleccion..." columnas="id|nombre" value=""/>
            </div>

            <div class="row">
                <p>SELECT</p>

                {{-- <x-form.select col="4"  /> --}}
            </div>
        </div>
    </form>

@endsection
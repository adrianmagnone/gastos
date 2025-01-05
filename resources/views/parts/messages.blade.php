@if (Session::has('update_message'))
<x-alert tipo="success" mensaje="{{ Session::pull('update_message') }}" icono="icon ti ti-check" />       
@endif
@if (Session::has('error_message'))
<x-alert tipo="danger" mensaje="{{ Session::pull('error_message') }}" icono="icon ti ti-circle-x" />       
@endif
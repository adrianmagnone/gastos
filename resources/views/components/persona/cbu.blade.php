<div class="col-xl-6">
    <x-form.sep tittle="Numeros CBU" />

    <x-list.table columns="Numero CBU|Descripción|Banco" acciones="3" :id="false" />
</div>

<script type="text/javascript">
    initCbu = function($) {

        $("#grid").MegaDatatable({
			ajaxUrl: "{{ asset($urlConsulta) }}",
			editUrl: "{{ asset('cbu/editar') }}",
			deleteUrl: "{{ asset('cbu/borrar') }}",
            dom: "rt",
			columns: "numero~f|descripcion~f|descripcion_banco~f|default~f|edit~f|delete~f",
            language_emptyTable: "<h5 style=\"padding: 1em;\"><i class=\"ti ti-thumb-down\"></i>No se encontraron resultados</h5>",
            language_zeroRecord: "<h5 style=\"padding: 1em;\"><i class=\"ti ti-thumb-down\"></i>No se encontraron resultados</h5>",
            columnDefs: [
				{
    				data: "default",
    				render: function ( data, type, row, meta ) {
						return renderTableCell.iconOrBlank([
                            { icono: 'star',   condicion: (row.predeterminado == 1), titulo:'Predeterminado', tipo:'blue' },
                        ]);
    				}
  				}
			],
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			}
		});
    };
</script>        
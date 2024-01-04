<div class="table-responsive">
    <table id="grid{{ $idgrid }}" class="table compact card-table w-100 table-hover">
        <thead>
            <tr>
                @if($id)
                    <th>#</th>
                @endif
                @foreach($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
                @if ($acciones > 0)
                    @for($index = 0; $index < $acciones; $index++)
                    <th style="width: 25px;"></th>
                    @endfor
                @endif
            </tr>
        </thead>
        @if($footer)
        <tfoot>
            @if($id)
                <th></th>
            @endif
            @foreach($columns as $column)
                <th></th>
            @endforeach
            @if ($acciones > 0)
                @for($index = 0; $index < $acciones; $index++)
                <th></th>
                @endfor
            @endif
        </tfoot> 
        @endif
    </table>
</div>
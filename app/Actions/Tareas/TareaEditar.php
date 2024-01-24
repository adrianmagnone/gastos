<?php

namespace App\Actions\Tareas;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;

use App\Models\Tarea;

class TareaEditar extends EditAction
{
    function __construct()
    {
        $this->model = Tarea::class;

        $this->urlList = route('tareas');
        $this->urlBackEdit = 'tarea/nueva';
        $this->urlSave = route('tarea.guardar');

        $this->editView   = 'tareas.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'La Tarea se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    public function rules(): array
    {
        return [
            'descripcion'   => ['string', 'required'],
            'proyecto'      => ['string', 'required'],
        ];
    }

	public function getRecord() : array
	{
        return [
            'fechaCreacion'  => MiDate::todayWithTime(),
            'estado'         => Tarea::Estado('Pendiente'),
            'descripcion'    => $this->descripcion,
            'proyecto'       => $this->proyecto
        ];
	}
}
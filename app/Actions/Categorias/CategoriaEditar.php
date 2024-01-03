<?php

namespace App\Actions\Categorias;

use App\Helpers\DateHelper as MiDate;
use App\Lib\Actions\EditAction;
use App\Models\Categoria;

class CategoriaEditar extends EditAction
{
    function __construct()
    {
        $this->model = Categoria::class;

        $this->urlList = route('categorias');
        $this->urlSave = route('categoria.guardar');

        $this->editView   = 'categorias.edit';
        $this->deleteView = '';

        $this->updatedMessage = 'La Categoria se ha editado correctamente!';
        $this->deletedMessage = '';
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [
            'listaUsos' => Categoria::USOS
        ];
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string'],
            'uso'    => ['integer', 'in:1,2,3', 'required'],
            'estado' => ['in:on', 'nullable'],   
        ];
    }

	public function getRecord() : array
	{
        return [
            'nombre' => $this->nombre,
            'uso'    => $this->uso,
            'estado' => $this->onOff('estado'),   
        ];
	}

}
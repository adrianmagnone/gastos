<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Tareas\TareaLista;
use App\Actions\Tareas\TareaEditar;
use App\Actions\Tareas\TareaExcel;

use App\Models\Tarea;
use App\Helpers\DateHelper as MiDate;

class TareasController extends Controller
{
    public function index(TareaLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, TareaLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function selectData(Request $request, TareaLista $action)
    {
        return $action->run($request);
    }

    public function toExcel(Request $request, TareaExcel $action)
    {
        return $action->runForExport($request);
    }

    public function create(TareaEditar $action)
    {
        return $action->runForCreate();
    }

    public function edit(TareaEditar $action, $id = null)
    {
        return $action->runForEdit($id);
    }

    public function store(Request $request, TareaEditar $action)
    {
        return $action->runForSave($request);
    }
 
    public function finish($id = null)
    {
        $model = Tarea::findOrFail($id);

        $model->estado = Tarea::Estado('Finalizada');
        $model->fechaFinalizacion = MiDate::todayWithTime();
        $model->save();

        return redirect()->route('tareas');
    }

    public function cancel($id = null)
    {
        $model = Tarea::findOrFail($id);

        $model->estado = Tarea::Estado('Cancelada');
        $model->fechaFinalizacion = MiDate::todayWithTime();
        $model->save();

        return redirect()->route('tareas');
    }
}
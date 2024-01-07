<?php

namespace App\Lib\Actions;

use DB;
use App\Helpers\DateHelper as MiDate;

class ProcessOneAction
{
    protected $updatedMessage;
    protected $urlList;
    protected $request;
    protected $entidad;


    public function run($request, $id = null)
    {
        $this->request =& $request;
        $this->entidad = $this->model::findOrFail($id);

        
        DB::beginTransaction();

        try
        {
            $this->processEntidad();

            DB::commit();
        }
        catch(\Throwable $th)
        {
            DB::rollback();
            dd($th->getMessage());
        }
        

        return $this->endUpdate();
    }

    protected function endUpdate()
    {
        $this->request->session()->flash('update_message', $this->updatedMessage);
        return redirect($this->urlList);
    }

    protected function processEntidad()
    {
        return false;
    }
}
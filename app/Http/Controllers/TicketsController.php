<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Tickets\TicketEditar;
use App\Actions\Tickets\TicketLista;


class TicketsController extends Controller
{
    public function index(TicketLista $action)
    {
        return $action->viewList();
    }

    public function getData(Request $request, TicketLista $action, $id = null)
    {
        return $action->run($request, $id);
    }

    public function create(TicketEditar $action)
    {
        return $action->runForCreate();
    }

    public function store(Request $request, TicketEditar $action)
    {
        return $action->runForSave($request);
    }
}
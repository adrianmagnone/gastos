<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Actions\Tickets\TicketEditar;


class TicketsController extends Controller
{

    public function create(TicketEditar $action)
    {
        return $action->runForCreate();
    }

    public function store(Request $request, TicketEditar $action)
    {
        return $action->runForSave($request);
    }
}
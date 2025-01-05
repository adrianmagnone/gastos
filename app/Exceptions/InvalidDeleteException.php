<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class InvalidDeleteException extends Exception
{
    public function render(Request $request): Response
    {
        $data = [
            'tittle'  => 'El recurso solicitado se encuentra bloqueado para su borrado.',
            'message' => $this->getMessage()
        ];

        return response()->view('errors.not-allowed', $data, 405);
    }
}

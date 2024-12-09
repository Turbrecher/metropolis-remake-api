<?php

namespace App\Exceptions;

use Exception;

class CustomNotFoundException extends Exception
{
    public function render($request){
        return response()->json([
            'error' => 'Page not found',
            'message' => $this->getMessage(),
        ], 404);
    }
}

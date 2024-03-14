<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class DocuSignController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function signByEmail(Request $request): void
    {
        try {
            $data = $request->all();
            dd($data);
        } catch (Exception $e) {
            dd($e);
        }
    }
}

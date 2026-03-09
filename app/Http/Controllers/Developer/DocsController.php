<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;

class DocsController extends Controller
{
    public function phpHelper()
    {
        return view('developer.docs.php_helper');
    }

    public function jsHelper()
    {
        return view('developer.docs.js_helper');
    }

    public function datatable()
    {
        return view('developer.docs.datatable');
    }

    public function ajax()
    {
        return view('developer.docs.ajax');
    }

    public function inputs()
    {
        return view('developer.docs.inputs');
    }

    public function layout()
    {
        return view('developer.docs.layout');
    }
}

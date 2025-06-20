<?php

namespace App\CloudErp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index(Request $request): object|array
    {
        $config = $this->getService('Configs')->getKeyVal();
        return view('vue', $config['status'] ? $config['data'] : []);
    }
}

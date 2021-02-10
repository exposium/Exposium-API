<?php

namespace App\Http\Controllers;

use App\Models\TipoDeItem;
use Illuminate\Http\Request;

class TipoDeItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoDeItem::all();
    }
}

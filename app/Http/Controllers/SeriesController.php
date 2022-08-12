<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    /**
     * list series function
     *
     * @return string
     */
    public function index()
    {
        // $series = Serie::all();
        $series = Serie::orderBy('nome', 'asc')->get();
        return view('series.index')->with('series', $series);
    }

    /**
     * create series function
     *
     * @return void
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * store series function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        if ($nomeSerie != null) {
            Serie::create($request->all());
            return redirect('series')->with('success', 'Cadastro Realizado com Sucesso!');

        } else {
            return redirect('series')->with('warning', 'AVISO! Preencher título da série campo nome');
        }
    }
}

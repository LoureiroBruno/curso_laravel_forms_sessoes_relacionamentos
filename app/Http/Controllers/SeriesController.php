<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * list series function
     *
     * @return string
     */
    public function index(Request $request)
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
    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());

        return to_route('series.index')->with("success", "Cadastrado a série: '{$serie->nome}' com sucesso!");

    }

    public function destroy(Serie $series)
    {
        if ($series == null) {
            return to_route('series.index')->with("danger", "Não foi possível realizar exlusão de cadastro");
        }

        $series->delete();

        return to_route('series.index')->with("success", "Excluído o Registro #{$series->id} | nome: '{$series->nome}' com Sucesso!");

    }


    public function edit(Serie $series)
    {
        return view('series.edit')->with(
                                            ['series'=> $series]
                                        );
    }


    public function update(SeriesFormRequest $request, Serie $series)
    {
        if ($request->nome == null) {
            return to_route('series.index')->with("danger", "Não foi possível realizar atualização de cadastro");
        }

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with("success", "Atualizado a série: '{$series->nome}' com sucesso!");
    }


}

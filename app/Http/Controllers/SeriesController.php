<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        // if ($request->input('nome') == null) {
        //     return redirect('series')->with("danger", "Há dados não informados, tente novamente!");
        // }

        /** validação do campo nome */
        $request->validate([
            'nome' => ['required','min:3']
        ]);
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
        // $series = $series->find($series->id);
        return view('series.edit')->with(
                                            ['series'=> $series]
                                        );
    }


    public function update(Request $request, Serie $series)
    {
        /** atualizar registro de acordo com id passado por parametro */
        // if ($series != null) {
        //     $series->where('id', $series->id)->update(['nome' => $request->nome]);
        //     return to_route('series.index')->with("success", "Atualizado a série: '{$request->nome}' com sucesso!");
        // } else {
        //     return redirect('series')->with("danger", "Há dados não informados, tente novamente!");
        // }

        /** mais simples */
        if ($request->nome == null) {
            return to_route('series.index')->with("danger", "Não foi possível realizar atualização de cadastro");
        }

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with("success", "Atualizado a série: '{$series->nome}' com sucesso!");
    }


}

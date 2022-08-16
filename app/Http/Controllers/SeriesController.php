<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * list series function
     *
     * @return string
     */
    public function index()
    {
        /** configurado na model Serie o metodo booted orderBy */
        // $series = Serie::orderBy('nome', 'asc')->get();

        /** recebendo do model Serie ordenado por nome asc */
        $series = Series::all();

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
        // dd($request->all());
        $serie = Series::create($request->all());

        for ($s=1; $s <= $request->seasonQty; $s++) {
            $season = $serie->seasons()->create([
                'number' => $s
            ]);

            for ($e=1; $e <= $request->episodesPerSeason; $e++) {
                $season->episodes()->create([
                    'number' =>  $e
                ]);
            }
        }
        return to_route('series.index')->with("success", "Cadastrado a série: '{$serie->nome}' com sucesso!");

    }

    public function destroy(Series $series)
    {
        if ($series == null) {
            return to_route('series.index')->with("danger", "Não foi possível realizar exlusão de cadastro");
        }

        $series->delete();

        return to_route('series.index')->with("success", "Excluído o Registro #{$series->id} | nome: '{$series->nome}' com Sucesso!");

    }


    public function edit(Series $series)
    {
        // dd($series->seasons());
        return view('series.edit')->with([
            'series'=> $series
            ]
        );
    }


    public function update(SeriesFormRequest $request, Series $series)
    {
        if ($request->nome == null) {
            return to_route('series.index')->with("danger", "Não foi possível realizar atualização de cadastro");
        }

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with("success", "Atualizado a série: '{$series->nome}' com sucesso!");
    }


}

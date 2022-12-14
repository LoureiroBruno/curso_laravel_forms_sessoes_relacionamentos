<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequestCreate;
use App\Http\Requests\SeriesFormRequestUpdate;
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
    public function store(SeriesFormRequestCreate $request)
    {
        // dd($request->all());

        $serie = Series::create($request->all());
        /** executando varias querys */
        // for ($s = 1; $s <= $request->seasonQty; $s++) {
        //     $season = $serie->seasons()->create([
        //         'number' => $s
        //     ]);

        //     for ($e = 1; $e <= $request->episodesPerSeason; $e++) {
        //         $season->episodes()->create([
        //             'number' =>  $e
        //         ]);
        //     }
        // }

        /** executando menos querys */
        $seasons = [];
        for ($s=1; $s <= $request->seasonQty; $s++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $s,
                'created_at' => $serie->created_at,
                'updated_at' => $serie->updated_at
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($e=1; $e <= $request->episodesPerSeason; $e++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $s,
                ];
            }
        }

        Episode::insert($episodes);

        return to_route('series.index')->with("success", "Cadastrado a s??rie: '{$serie->nome}' com sucesso!");
    }

    public function destroy(Series $series)
    {
        if ($series == null) {
            return to_route('series.index')->with("danger", "N??o foi poss??vel realizar exlus??o de cadastro");
        }

        $series->delete();

        return to_route('series.index')->with("success", "Exclu??do o Registro #{$series->id} | nome: '{$series->nome}' com Sucesso!");
    }


    public function edit(Series $series)
    {
        // dd($series->seasons());
        return view('series.edit')->with(
            [
                'series' => $series
            ]
        );
    }


    public function update(SeriesFormRequestUpdate $request, Series $series)
    {
        if ($request->nome == null) {
            return to_route('series.index')->with("danger", "N??o foi poss??vel realizar atualiza????o de cadastro");
        }

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with("success", "Atualizado a s??rie: '{$series->nome}' com sucesso!");
    }
}

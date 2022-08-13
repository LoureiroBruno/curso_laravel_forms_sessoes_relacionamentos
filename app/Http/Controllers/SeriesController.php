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

         /** recebido  do metodo destroy*/
        $mensagemDestroy = $request->session()->get('mensagem.destroy');
        $request->session()->forget('mensagem.destroy');

        return view('series.index')->with('series', $series)->with('mensagemDestroy', $mensagemDestroy);

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

            return to_route('series.index')->with("success", "Cadastrado a série ({$nomeSerie}) com sucesso!");
        } else {

            return redirect('series')->with("danger", "Há dados não informados, tente novamente!");
        }
    }

    public function destroy(Request $request)
    {
        $idSerie = $request->series;
        if ($request->series != null) {
            Serie::destroy($request->series);
            $request->session()->put('mensagem.destroy', "Excluído o Registro de n° {$idSerie} com Sucesso!");

            /** enviado para a rota index que invia a view index */
            return to_route('series.index');
        } else {
            /** caso use session->flash desnecessário uso session()->forget() */
            $request->session()->put('mensagem.destroy', "Nenhuma identificação no registro foi encontrado!");

            return to_route('series.index');
        }
    }

}

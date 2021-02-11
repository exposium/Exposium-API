<?php

namespace App\Http\Controllers;

use App\Models\Exposicao;
use App\Models\Instituicao;
use App\Models\Item;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class ExposicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Exposicao[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Exposicao::all();
    }

    /**
     * // TODO
     *
     * @return Exposicao[]|\Illuminate\Database\Eloquent\Collection
     */
    public function activeExhibitions()
    {
        $exhibitions = Exposicao::where("estado", 1)->get();
        foreach ($exhibitions as $exhibition) {
            $institutionName = Instituicao::find($exhibition->instituicaoID)->nome;
            array_merge($exhibition, ["nomeInstituicao" => $institutionName]);
        }
        return $exhibitions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exposicao = new Exposicao;

        $exposicao->exposicaoID = $this->setExposicaoID();
        $exposicao->instituicaoID = $request->input("instituicaoID");
        $exposicao->nome = $request->input("nome");
        $exposicao->dataAbertura = $request->input("dataAbertura");
        $exposicao->dataEncerramento = $request->input("dataEncerramento");
        $exposicao->descricao = $request->input("descricao");
        $exposicao->estado = $request->input("estado");
        $exposicao->fotografia = $request->input("fotografia");
        $exposicao->localizacao = $request->input("localizacao");
        $exposicao->gratuito = $request->input("gratuito");

        $exposicao->save();

        return $exposicao;
    }

    private function setExposicaoID()
    {
        $idSize = 6;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $exposicaoID = '';
        $tmp = true;

        do{
            for ($i = 0; $i < $idSize; $i++) {
                $exposicaoID .= $characters[rand(0, $charactersLength - 1)];
            }

            if(count(Exposicao::where("exposicaoID", $exposicaoID)->get()) == 0){
                $tmp = false;
            }

        }while($tmp);

        return $exposicaoID;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itens = Item::where("exposicaoID", $id)->get();
        $exposicao = Exposicao::where("exposicaoID", $id)->first();

        $array = ['itens' => $itens];

        return array_merge($exposicao->toArray(), $array);
    }

    public function getExhibitionsByInstitution($id) {
        return Exposicao::where("instituicaoID", $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Exposicao::where("exposicaoID", $id)->update([
            "nome" => $request->input("nome"),
            "dataAbertura" => $request->input("dataAbertura"),
            "dataEncerramento" => $request->input("dataEncerramento"),
            "descricao" => $request->input("descricao"),
            "estado" => $request->input("estado"),
            "fotografia" => $request->input("fotografia"),
            "localizacao" => $request->input("localizacao"),
            "gratuito" => $request->input("gratuito")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Exposicao::where("exposicaoID", $id)->delete();
    }
}

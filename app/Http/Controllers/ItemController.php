<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TipoDeItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item;
        $exposicaoID = $request->input("exposicaoID");

        $item->exposicaoID = $exposicaoID;
        $item->tipoItemID = $request->input("tipoItemID");
        $item->nome = $request->input("nome");
        $item->nomeAutor = $request->input("nomeAutor");
        $item->dataCriacao = $request->input("dataCriacao");
        $item->fotografia = $request->input("fotografia");
        $item->audio = $request->input("audio");
        $item->video = $request->input("video");
        $item->descricao = $request->input("descricao");
        $item->codigo = 1;

        $lastItem = Item::where("exposicaoID", $exposicaoID)->orderByDesc("codigo")->first();
        if (!empty($lastItem)){
            $item->codigo = $lastItem->codigo + 1;
        }

        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        $itemType = TipoDeItem::find($item->tipoItemID);
        return array_merge($item->toArray(), ['nomeTipoItem' => $itemType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Item::where("itemID", $id)->update([
            "tipoItemID" => $request->input("tipoItemID"),
            "nome" => $request->input("nome"),
            "nomeAutor" => $request->input("nomeAutor"),
            "dataCriacao" => $request->input("dataCriacao"),
            "fotografia" => $request->input("fotografia"),
            "audio" => $request->input("audio"),
            "video" => $request->input("video"),
            "descricao" => $request->input("descricao")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Item::destroy($id);
    }
}

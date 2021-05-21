<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalledRequest;
use App\Models\Called;
use App\Models\StatusCalled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Called $called)
    {
        $chamados = $called->getCalledAll();
        return view('chamados.index', compact('chamados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = StatusCalled::all();
        return view('chamados.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalledRequest $request, Called $called)
    {
        $called->cadastrarPedido($request->all());
        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Called $called)
    {
        $chamado = $called->getCalledById($id);
        return view('chamados.show', compact('chamado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Called $called)
    {
        $chamado = $called->getCalledById($id);
        $status = StatusCalled::all();
        return view('chamados.edit', compact('chamado', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Called $called)
    {
        $called->updateCalled($request->all(), $id);
        return redirect()->route('chamados.index')->with('success', 'Chamado alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

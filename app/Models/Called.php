<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Called extends Model
{
    use HasFactory;

    protected $fillable = ['assunto', 'descricao', 'dt_criacao_chamado', 'status'];

    public function cadastrarPedido($request)
    {
        $vendedorMenorQtdChamado = DB::table('sellers')->select('id', 'qtd_chamados_aberto')
            ->orderBy('qtd_chamados_aberto', 'ASC')
            ->limit(1)->first();

        $idChamado = DB::table('calleds')->insertGetId([
            'assunto' => $request['assunto'],
            'descricao' => $request['descricao'],
            'dt_criacao_chamado' => $request['dt_criacao_chamado'],
            'status' => $request['status']
        ]);

        DB::table('seller_calleds')->insert([
            'id_vendedor' => $vendedorMenorQtdChamado->id,
            'id_chamado' => $idChamado
        ]);

        DB::table('sellers')
            ->where('id', $vendedorMenorQtdChamado->id)
            ->update(['qtd_chamados_aberto' => $vendedorMenorQtdChamado->qtd_chamados_aberto + 1]);


    }

    public function getCalledAll()
    {
        return DB::table('calleds')
            ->join('status_calleds', 'calleds.status', '=', 'status_calleds.id')
            ->select('calleds.id as id_called','assunto', 'calleds.descricao', 'dt_criacao_chamado', 'status_calleds.descricao as desc_status')
            ->get();
    }

    public function getCalledById($id)
    {
        return DB::table('calleds')
            ->join('status_calleds', 'calleds.status', '=', 'status_calleds.id')
            ->join('seller_calleds', 'calleds.id', '=', 'seller_calleds.id_chamado')
            ->join('sellers', 'seller_calleds.id_vendedor', '=', 'sellers.id')
            ->select('calleds.id as id_called','assunto', 'calleds.status', 'calleds.descricao', 'dt_criacao_chamado', 'status_calleds.descricao as desc_status', 'sellers.nome as nome_vendedor')
            ->where('calleds.id', $id)
            ->first();
    }

    public function updateCalled($data, $id)
    {
        if ($data['status'] != 1) {
            $vendedor_id = DB::table('seller_calleds')->where('id_chamado', $id)->select('id_vendedor')->first();
            $vendedor = DB::table('sellers')->where('id', $vendedor_id->id_vendedor)
                ->select('qtd_chamados_aberto', 'qtd_chamados_andamento', 'qtd_chamados_resolvido')
                ->first();

            if ($data['status'] == 2) {
                DB::table('sellers')
                    ->where('id', $vendedor_id->id_vendedor)
                    ->update(
                        ['qtd_chamados_aberto' => $vendedor->qtd_chamados_aberto - 1]
                    );

                DB::table('sellers')
                    ->where('id', $vendedor_id->id_vendedor)
                    ->update(
                        ['qtd_chamados_andamento' => $vendedor->qtd_chamados_andamento + 1]
                    );
            } elseif ($data['status'] == 4) {
                DB::table('sellers')
                    ->where('id', $vendedor_id->id_vendedor)
                    ->update(
                        ['qtd_chamados_andamento' => $vendedor->qtd_chamados_andamento - 1]
                    );

                DB::table('sellers')
                    ->where('id', $vendedor_id->id_vendedor)
                    ->update(
                        ['qtd_chamados_resolvido' => $vendedor->qtd_chamados_resolvido + 1]
                    );
            }

            DB::table('calleds')
                ->where('id', $id)
                ->update([
                    'assunto' => $data['assunto'],
                    'descricao' => $data['descricao'],
                    'dt_criacao_chamado' => $data['dt_criacao_chamado'],
                    'status' => $data['status']
                ]);
        }
    }


}

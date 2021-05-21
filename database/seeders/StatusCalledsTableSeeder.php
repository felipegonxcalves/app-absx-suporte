<?php

namespace Database\Seeders;

use App\Models\StatusCalled;
use Illuminate\Database\Seeder;

class StatusCalledsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['Em Aberto', 'Em Andamento', 'Atrasado', 'Resolvido'];
        foreach ($status as $value) {
            StatusCalled::create(['descricao' => $value]);
        }
//        StatusCalled::create([
//            'descricao' => 'Em Aberto'
//        ]);
    }
}

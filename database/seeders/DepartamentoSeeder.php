<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;
use App\Models\Ciudad;
use App\Models\Distrito;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = Departamento::factory(8)->create();

        // para cada departamento creado crear otras 8 ciudades
        foreach ($departamentos as $departamento) {
            // cuando se llama a factory el resto de campos los crea con lo q hayamos especificado en sus correspondientes factory
            $ciudades = Ciudad::factory(8)->create([
                'departamento_id' => $departamento->id
            ]);

            // para cada una de esas 8 ciudades crear otros 8 distritos
            foreach ($ciudades as $ciudad) {
                // cuando se llama a factory el resto de campos los crea con lo q hayamos especificado en sus correspondientes factory
                Distrito::factory(8)->create([
                    'ciudad_id' => $ciudad->id
                ]);
            }
        }


    }
}

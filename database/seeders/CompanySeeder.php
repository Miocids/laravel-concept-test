<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = \collect([
            [
                'name' => 'Nombre Empresa 1',
                'description' => 'Descripción Empresa 1',
                'direction' => 'Dirección Empresa 1',
            ],
            [
                'name' => 'Nombre Empresa 2',
                'description' => 'Descripción Empresa 2',
                'direction' => 'Dirección Empresa 2',
            ]
        ]);
        
        $fields->each(function ($field){
            Company::query()->updateOrCreate([
                'name' => $field['name']
            ],$field);
        });
    }
}

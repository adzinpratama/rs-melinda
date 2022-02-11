<?php

namespace Database\Seeders;

use App\Models\Proficiency;
use Illuminate\Database\Seeder;

class ProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proficiency = [
            [
                'name' => 'Specialis Jantung'
            ],
            [
                'name' => 'Specialis Paru'
            ],
            [
                'name' => 'Specialis Tulang'
            ],
            [
                'name' => 'Dokter Umum'
            ],
            [
                'name' => 'Dokter Anak'
            ],
        ];

        foreach ($proficiency as $prof) {
            Proficiency::create($prof);
        }
    }
}

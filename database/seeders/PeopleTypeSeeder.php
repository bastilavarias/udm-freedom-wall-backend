<?php

namespace Database\Seeders;

use App\Models\PeopleType;
use Illuminate\Database\Seeder;

class PeopleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peopleTypes = [
            [
                "label" => "President",
                "description" => "President of Universidad de Manila.",
            ],

            [
                "label" => "Professor",
                "description" => null,
            ],

            [
                "label" => "BSIT",
                "description" =>
                    "Bachelor of Science in Information Technology.",
            ],
        ];
        foreach ($peopleTypes as $peopleType) {
            PeopleType::create($peopleType);
        }
    }
}

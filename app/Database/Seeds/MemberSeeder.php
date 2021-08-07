<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder {

    public function run() {
        $data = [];

        for ($i = 0; $i < 50; $i++) {

            $data[] = $this->generateTestMember();
        }

        $this->db->table("members")->insertBatch($data);
    }

    public function generateTestMember() {
        $faker = Factory::create();

        return [
            "nome" => $faker->name(),
            "cognome" => $faker->name,
            "email" => $faker->email,
            "cell" => $faker->phoneNumber,
            "attivo" => $faker->randomElement([1, 0]),
        ];
    }

}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WisataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->sentence(mt_rand(2,3)),
            'deskripsi' => '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(5,7))) . '</p>',
            'lokasi' => $this->faker->address(),
            'koordinat_lokasi' => '123,1234',
            'foto' => '/' . $this->faker->sentence(1),
            'user_id' => mt_rand(1,5),
            'desa_id' => mt_rand(1,2)
        ];
    }
}

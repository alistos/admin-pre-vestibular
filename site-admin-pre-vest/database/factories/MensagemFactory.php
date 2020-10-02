<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mensagem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class MensagemFactory extends Factory{

    protected $model = Mensagem::class;

    public function definition()
    {
        // TODO: Implement definition() method.
        return [
            'aberta' => $this->faker->boolean(),
            'data_envio' => ($this->faker->dateTimeBetween('-10 years', 'now'))->format('d/m/Y'),
            'email' => $this->faker->unique()->safeEmail,
            'remetente' => $this->faker->name(),
            'conteudo' => $this->faker->realText($maxNbChars = 400, $indexSize = 2)
        ];
    }
}

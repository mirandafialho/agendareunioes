<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jorge',
            'email' => 'jorgepiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('jorge123'),
            'remember_token' => Str::random(10)
        ], [
            'name' => 'Clara',
            'email' => 'clarapiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('clara123'),
            'remember_token' => Str::random(10)
        ], [
            'name' => 'Pedro',
            'email' => 'pedropiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pedro123'),
            'remember_token' => Str::random(10)
        ]);

        DB::table('holidays')->insert([
            'title' => 'Natal',
            'description' => 'Feriado comemorativo de Natal',
            'holiday' => '2020-12-25',
        ], [
        	'title' => 'Confraternização Universal',
            'description' => 'Primeiro dia do ano. Marca o Ano Novo.',
            'holiday' => '2021-01-01',
        ], [
        	'title' => 'Carnaval',
            'description' => 'Carnaval no Brasil.',
            'holiday' => '2021-02-16',
        ],[
        	'title' => 'Tiradentes',
            'description' => 'Dia de execução de Joaquim José da Silva Xavier, o Tiradentes.',
            'holiday' => '2021-04-21',
        ], [
        	'title' => 'Dia do Trabalhador',
            'description' => 'Com o crescimento do operariado, o dia 1 de maio foi declarado feriado pelo presidente Artur Bernardes, em 1925.',
            'holiday' => '2021-05-01',
        ], [
        	'title' => 'Independência',
            'description' => 'Marca a independência do Brasil.',
            'holiday' => '2021-09-07',
        ], [
        	'title' => 'Nossa Senhora Aparecida',
            'description' => 'Feriado dedicado a padroeira do Brasil.',
            'holiday' => '2021-10-12',
        ], [
        	'title' => 'Finados',
            'description' => 'Feriado religioso, dedicado a orações e homenagens aos que já faleceram.',
            'holiday' => '2021-11-02',
        ], [
        	'title' => 'Proclamação da República',
            'description' => 'O Dia da Proclamação da República do Brasil é comemorado anualmente dia 15 de novembro. Esta data foi instituída como feriado nacional pela Lei nº 662, de 06 de abril de 1949.',
            'holiday' => '2021-11-15',
        ], [
            'title' => 'Natal',
            'description' => 'Feriado comemorativo de Natal',
            'holiday' => '2021-12-25',
        ]);
    }
}


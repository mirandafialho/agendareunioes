<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'Admin',
            'email' => 'admin@agendareunioes.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 1,
            'remember_token' => Str::random(10)
        ]);

        DB::table('users')->insert([
            'name' => 'Jorge',
            'email' => 'jorgepiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('jorge123'),
            'role' => 2,
            'remember_token' => Str::random(10)
        ]);

        DB::table('users')->insert([
            'name' => 'Clara',
            'email' => 'clarapiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('clara123'),
            'role' => 2,
            'remember_token' => Str::random(10)
        ]); 

        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'pedropiperun@mailinator.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pedro123'),
            'role' => 3,
            'remember_token' => Str::random(10)
        ]);

        /**
         * Feriados Nacionais.
         */
        DB::table('holidays')->insert([
            'title' => 'Natal',
            'description' => 'Feriado comemorativo de Natal',
            'holiday' => '2020-12-25',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Confraternização Universal',
            'description' => 'Primeiro dia do ano. Marca o Ano Novo.',
            'holiday' => '2021-01-01',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Carnaval',
            'description' => 'Carnaval no Brasil.',
            'holiday' => '2021-02-16',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Tiradentes',
            'description' => 'Dia de execução de Joaquim José da Silva Xavier, o Tiradentes.',
            'holiday' => '2021-04-21',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Dia do Trabalhador',
            'description' => 'Com o crescimento do operariado, o dia 1 de maio foi declarado feriado pelo presidente Artur Bernardes, em 1925.',
            'holiday' => '2021-05-01',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Independência',
            'description' => 'Marca a independência do Brasil.',
            'holiday' => '2021-09-07',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Nossa Senhora Aparecida',
            'description' => 'Feriado dedicado a padroeira do Brasil.',
            'holiday' => '2021-10-12',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Finados',
            'description' => 'Feriado religioso, dedicado a orações e homenagens aos que já faleceram.',
            'holiday' => '2021-11-02',
        ]);

        DB::table('holidays')->insert([
        	'title' => 'Proclamação da República',
            'description' => 'O Dia da Proclamação da República do Brasil é comemorado anualmente dia 15 de novembro. Esta data foi instituída como feriado nacional pela Lei nº 662, de 06 de abril de 1949.',
            'holiday' => '2021-11-15',
        ]);

        DB::table('holidays')->insert([
            'title' => 'Natal',
            'description' => 'Feriado comemorativo de Natal',
            'holiday' => '2021-12-25',
        ]);
    }
}


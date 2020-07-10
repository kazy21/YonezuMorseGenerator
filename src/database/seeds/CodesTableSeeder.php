<?php

use Illuminate\Database\Seeder;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Code::insert([
            [
                'word' => 'K',
                'code' => '🐏🐑🐏',
            ],
        ]);
    }
}

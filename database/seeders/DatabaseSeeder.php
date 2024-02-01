<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call('BooksSeeder');
        //factory(Book::class, 150)->create();
        DB::table('Books')->truncate();

        // Crear 50 autores utilizando la factory
        \Illuminate\Database\Eloquent\Factories\Factory::factoryForModel(Book::class)->count(150)->create();

    }
}

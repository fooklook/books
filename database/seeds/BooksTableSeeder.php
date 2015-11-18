<?php
use Illuminate\Database\Seeder;
use \App\Book;
class BooksTableSeeder extends Seeder {

    public function run(){
        DB::table('books')->truncate();
        for($i=0; $i<10; $i++){
            $book = new Book();
            $book->book_name = str_random(10);
            $book->book_auther = str_random(10);
            $book->book_press = str_random(10);
            $book->book_num = 10;
            $book->book_res = 10;
            $book->save();
        }

    }

}
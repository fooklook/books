<?php
use Illuminate\Database\Seeder;
use \App\Borrow;
class BorrowTableSeeder extends Seeder {

    public function run(){
        DB::table('borrow')->truncate();

        for($i=0; $i<10; $i++){
            $book = new Borrow();
            $book->book_id = rand(1, 10);
            $book->username = str_random(10);
            $book->userno = rand(10000, 99999);
            $book->phone = rand(13100000000, 15100000000);
            $book->return_at  = \Carbon\Carbon::now();
            $book->status = rand(0,1);
            $book->save();
        }
    }

}
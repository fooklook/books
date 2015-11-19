<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model {

    protected $table = 'borrow';
    protected $primaryKey = 'borrow_id';
    protected $fillable = array(
        'borrow_id',
        'book_id',
        'username',
        'userno',
        'phone',
        'return_at',
        'status'
    );
    public function book(){
        return $this->hasOne('App\Book','book_id','book_id');
    }

}

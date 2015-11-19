<?php namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller {
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//var_dump($request->name);
		$books = DB::table('books');
		$books->orderBy('book_id', 'DESC');
		if($request->book_name != ""){
			$books->where('book_name', 'like', "%".$request->book_name."%");
		}
		if($request->book_auther != ""){
			$books->where('book_name', 'like', "%".$request->book_auther."%");
		}
		if($request->book_press != ""){
			$books->where('book_name', 'like', "%".$request->book_press."%");
		}
		$lists = $books->paginate(10);
		return view('booklist', array('books'=>$lists->toArray(), 'pages'=>$lists->render(), 'request'=>$request));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('bookadd');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = array('errNum'=>0, 'errMsg'=>'', 'errDate'=>'');
		$book = new Book();
		$book->book_name = $request->book_name;
		$book->book_auther = $request->book_auther?$request->book_auther:"";
		$book->book_press = $request->book_press?$request->book_press:"";
		$book->book_num = $request->book_num;
		$book->book_res = $request->book_res;
		if($book->save()){
			$data['errMsg'] = "添加成功";
			return json_encode($data);
		}else{
			$data['errMsg'] = "添加失败";
			return json_encode($data);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'create';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = Book::find($id);
		return view('bookedit', array('book'=>$book));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$data = array('errNum'=>0, 'errMsg'=>'', 'errDate'=>'');
		$book = Book::find($id);
		$book->book_name = $request->book_name;
		$book->book_auther = $request->book_auther?$request->book_auther:"";
		$book->book_press = $request->book_press?$request->book_press:"";
		$book->book_num = $request->book_num;
		$book->book_res = $request->book_res;
		if($book->update()){
			$data['errMsg'] = "更新成功";
			return json_encode($data);
		}else{
			$data['errMsg'] = "添加失败";
			return json_encode($data);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = array('errNum'=>0, 'errMsg'=>'', 'errDate'=>'');
		$delete = DB::table('books')->where('book_id',$id)->delete();
		if($delete){
			$data['errMsg'] = "删除成功";
			return json_encode($data);
		}else{
			$data['errMsg'] = "删除失败";
			return json_encode($data);
		}
	}

}

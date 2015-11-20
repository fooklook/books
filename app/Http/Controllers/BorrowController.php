<?php namespace App\Http\Controllers;

use App\Book;
use App\Borrow;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller {
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
		$borrow = Borrow::with('book');
		$borrow->orderBy('borrow_id', 'DESC');
		if($request->username != ""){
			$borrow->where('username', 'like', "%".$request->username."%");
		}
		if($request->book_press != ""){
			$borrow->where('userno', 'like', "%".$request->userno."%");
		}
		$lists = $borrow->paginate(15);
		return view('borrowlist', array('borrows'=>$lists->toArray(), 'pages'=>$lists->render(), 'request'=>$request));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//没有book_id
		if($request->book_id == ""){
			return view('errors.error', array('error'=>'请先选择要借的图书-><a href="'.url('book').'">图书列表</a>->点击 <span class="glyphicon glyphicon-export"></span>'));
		}
		//书没有库存
		$book = Book::find($request->book_id);
		if($book->book_res <= 0){
			return view('errors.error', array('error'=>'《'.$book->book_name.'》已经借完。->返回<a href="'.url('book').'">图书列表</a>'));
		}
		return view('borrowadd', array('book_id'=>$request->book_id));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = array('errNum'=>0, 'errMsg'=>'', 'errDate'=>'');
		$borrow = new Borrow();
		$borrow->book_id = $request->book_id;
		$borrow->username = $request->username;
		$borrow->userno = $request->userno?$request->userno:"";
		$borrow->phone = $request->phone?$request->phone:"";
		$borrow->return_at = $request->return_at;
		$borrow->status = 0;
		//减去一本库存
		$book = Book::find($request->book_id);
		$book->book_res = $book->book_res - 1;
		$book->save();
		if($borrow->save()){
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$borrow = Borrow::find($id);
		return view('borrowedit', array('borrow'=>$borrow));
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
		$borrow = Borrow::find($id);
		$borrow->username = $request->username;
		$borrow->userno = $request->userno?$request->userno:"";
		$borrow->phone = $request->phone?$request->phone:"";
		$borrow->return_at = $request->return_at;
		if($borrow->update()){
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
		//
	}

	public function  back($id){
		$data = array('errNum'=>0, 'errMsg'=>'', 'errDate'=>'');
		$borrow = Borrow::find($id);
		$borrow->status = 1;
		$book = Book::find($borrow->book_id);
		$book->book_res = $book->book_res + 1;
		$book->save();
		if($borrow->update()){
			$data['errMsg'] = "归还成功";
			return json_encode($data);
		}else{
			$data['errMsg'] = "归还失败";
			return json_encode($data);
		}

	}

}

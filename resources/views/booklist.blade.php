@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <a class="btn btn-info" href="{{ url('book/create') }}">添加图书</a>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <form action="{{ url('book') }}" enctype="multipart/form-data" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group col-md-3" >
                            <label for="exampleInputName2">书名</label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="book_name" value="{{ $request->book_name }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail2">作者</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="" name="book_auther" value="{{ $request->book_auther }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail2">出版社</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="" name="book_press" value="{{ $request->book_press }}">
                        </div>
                        <div class="form-group col-md-3">
                            <br/>
                            <button type="submit" class="btn btn-default">查找</button>
                        </div>
                    </form>
                </div>
                <table class="table table-condensed">
                    <tr>
                        <th>编号</th>
                        <th>书名</th>
                        <th>作者</th>
                        <th>出版社</th>
                        <th>总数</th>
                        <th>剩余</th>
                        <th>管理</th>
                    </tr>
                    @foreach($books['data'] as $book)
                    <tr>
                        <td>{{ $book->book_id }}</td>
                        <td>{{ $book->book_name }}</td>
                        <td>{{ $book->book_auther }}</td>
                        <td>{{ $book->book_press }}</td>
                        <td>{{ $book->book_num }}</td>
                        <td>{{ $book->book_res }}</td>
                        <td><a href="{{ url("borrow/create")."?book_id=".$book->book_id }}" title="借书"><span class="glyphicon glyphicon-export"></span></a>
                            <a style="color: red;" href="{{ url("book/{$book->book_id}/edit") }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|
                            <a href="javascript:void(0);" book_id="{{ $book->book_id }}" title="删除" class="delete"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                    @endforeach

                </table>
                <div class="row">
                    <div class="col-md-1" style="line-height: 80px;">{{ "共".$books['total'] }}本</div>
                    <div class="col-md-11">{!! $pages !!}</div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('jquery')
<script type="text/javascript">
    //删除操作
    $(function(){
        $(".delete").click(function(){
            var r = confirm('确定删除该图书？');
            if( r == true ) {
                var book_id = $(this).attr('book_id');
                $.post(
                        '{{ url('book') }}/'+ book_id,
                        {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        function (data, status) {
                            var result = jQuery.parseJSON(data);
                            alert(result.errMsg);
                            if(result.errNum == 0){
                                window.location.reload()
                            }
                        }
                );
            }
        });
    })
</script>
@endsection
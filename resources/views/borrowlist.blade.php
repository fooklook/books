@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <form action="{{ url('borrow') }}" enctype="multipart/form-data" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group col-md-3" >
                            <label for="exampleInputName2">借书人</label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="username" value="{{ $request->username }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail2">借书人工号</label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="userno" value="{{ $request->userno }}">
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
                        <th>所借书名</th>
                        <th>借书人</th>
                        <th>借书人工号</th>
                        <th>借书人手机号码</th>
                        <th>借书时间</th>
                        <th>预计归还日期</th>
                        <th>归还状态</th>
                        <th>管理</th>
                    </tr>
                    @foreach($borrows['data'] as $borrow)
                        <tr>
                            <td>{{ $borrow['borrow_id'] }}</td>
                            <td>{{ $borrow['book']["book_name"] }}</td>
                            <td>{{ $borrow['username'] }}</td>
                            <td>{{ $borrow['userno'] }}</td>
                            <td>{{ $borrow['phone'] }}</td>
                            <td>{{ $borrow['created_at'] }}</td>
                            <td>{{ $borrow['return_at'] }}</td>
                            <td>{!! $borrow['status'] == 0?"<span style='color:red'>未归还</span>":"<span style='color:blue;'>已归还</span>" !!}</td>
                            <td>
                                <a style="color: red;" href="{{ url("borrow/{$borrow['borrow_id']}/edit") }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|
                                <a href="javascript:void(0);" book_id="{{ $borrow['borrow_id'] }}" title="归还" class="back"><span class="glyphicon glyphicon-import"></span></a>
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div class="row">
                    <div class="col-md-1" style="line-height: 80px;">{{ "共".$borrows['total'] }}次</div>
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
            $(".back").click(function(){
                var r = confirm('确定归还图书吗？');
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
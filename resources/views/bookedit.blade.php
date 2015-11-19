@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row"><a href="{{ url('/book') }}">返回图书列表</a></div>
                <div class="row"><h2><span class="glyphicon glyphicon-plus"></span>修改图书</h2></div>
                <div class="row">
                    <div class="row">

                        <span style="color: red;"><b>*</b></span> 为必填字段

                    </div>
                    <form action="{{ url('book/'.$book->book_id) }}" enctype="multipart/form-data" method="post" id="my_form">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group col-md-12">
                            <label for="exampleInputName2">书名 <span style="color: red;"><b>*</b></span></label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="book_name" value="{{ $book->book_name }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail2">作者</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="book_auther" value="{{ $book->book_auther }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail2">出版社</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="book_press" value="{{ $book->book_press }}">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="exampleInputEmail2">总数 <span style="color: red;"><b>*</b></span></label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="book_num" value="{{ $book->book_num }}" onkeyup="value=value.replace(/[^1234567890-]+/g,'')">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail2">剩余 <span style="color: red;"><b>*</b></span></label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="book_res" value="{{ $book->book_res }}" onkeyup="value=value.replace(/[^1234567890-]+/g,'')">
                            </div>
                        </div>
                        <div class="form-group" style="height:20px;"></div>
                        <div class="form-group col-md-12">
                            <br />
                            <button type="submit" class="btn btn-info">添加</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script type="text/javascript" src="{{ asset("js/jquery.form.js") }}"></script>
    <script type="text/javascript">
        //删除操作
        $(function(){
            var options = {
                beforeSubmit: showRequest, //提交前处理
                success: showResponse, //处理完成
                resetForm: true,
                dataType: 'json'
            };
            $('#my_form').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });
        });
        function showRequest(formData, jqForm, options) {
            var status = true;
            $.each(formData,function(i,value){
                if(value.name == "book_name"){
                    if(value.value == ""){
                        alert("书名不能为空");
                        status = false;
                        return false;
                    }
                }
                if(value.name == "book_num"){
                    if(value.value == ""){
                        alert("总数不能为空");
                        status = false;
                        return false;
                    }
                }
                if(value.name == "book_res"){
                    if(value.value == ""){
                        alert("剩余量不能为空");
                        status = false;
                        return false;
                    }
                }
            });
            if(!status){
                return false;
            }
        }
        function showResponse(responseText, statusText) {
            alert(responseText.errMsg);
            if(responseText.errNum == 0){
                location.href = '{{ url('book') }}';
            }
            return false;
        }
    </script>
@endsection
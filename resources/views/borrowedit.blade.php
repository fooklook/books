@extends('app')

@section('content')
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row"><a href="{{ url('/book') }}">返回图书列表</a></div>
                <div class="row"><h2><span class="glyphicon glyphicon-plus"></span>借书记录</h2></div>
                <div class="row">
                    <div class="row">

                        <span style="color: red;"><b>*</b></span> 为必填字段

                    </div>
                    <form action="{{ url('borrow/'.$borrow->borrow_id) }}" enctype="multipart/form-data" method="post" id="my_form">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="row">
                            <h3>所借书籍： 《{{ $borrow->book->book_name }}》</h3>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputName2">借书人 <span style="color: red;"><b>*</b></span></label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="username" value="{{ $borrow->username }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail2">借书人工号</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="userno" value="{{ $borrow->userno }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail2">借书人手机号码</label>
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="phone" value="{{ $borrow->phone }}">
                        </div>
                        <div class="form-group input-append date" id="datetimepicker" data-date="{{ date('Y-m-d hh:ii') }}" data-date-format="yyyy-mm-dd hh:ii">
                            <div class="col-md-6">
                                <label for="exampleInputEmail2">预计归还时间 <span style="color: red;"><b>*</b></span></label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="" name="return_at" value="{{ $borrow->return_at}}" readonly>
                                <span class="add-on"><i class="icon-th"></i></span>
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
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
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
            $('#datetimepicker').datetimepicker();
        });
        function showRequest(formData, jqForm, options) {
            var status = true;
            $.each(formData,function(i,value){
                if(value.name == "username"){
                    if(value.value == ""){
                        alert("借书人姓名不能空");
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
                location.href = '{{ url('borrow') }}';
            }
            return false;
        }
    </script>
@endsection
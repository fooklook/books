@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">阳春站图书管理系统首页</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ url('') }}">管理图书信息</a></li>
                            <li class="list-group-item"><a href="{{ url('') }}">管理图书借出入信息</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

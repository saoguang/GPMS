@extends('layouts.layoutSidebar')
{{--by LHW--}}
@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    {{--添加提示响应--}}
    <!-- ERROR TIP -->
    {{--@if(Session::has('successMsg'))--}}
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i> 添加成功
    </div>
    {{--@endif--}}
    {{--@if(Session::has('failureMsg'))--}}
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-times-circle"></i> 添加失败
    </div>
    {{--@endif--}}
    <!-- END ERROR TIP -->


    {{--自定义内容--}}
    <div class="panel">
        <div class="panel-heading" >
            <h3 class="panel-title">专业信息管理</h3>
            <div class="right">
                <a href="{{ url('manageInfo/majorCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增专业</span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>专业编号</th>
                    <th>专业名称</th>
                    <th>所属学院</th>
                </tr>
                </thead>
                <tbody>
                @foreach($majorInfos as $majorInfo)
                    <tr>
                        <td>
                            <a href="">详情</a>
                            <a href="">修改</a>
                            <a href="">删除</a>
                        </td>
                        <th>{{$majorInfo->major_identifier}}</th>
                        {{--专业编号--}}
                        <th>{{$majorInfo->major_name}}</th>
                        {{--专业名称--}}
                        <th>{{$majorInfo->major_info_id}}</th>
                        {{--所属学院--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--分页--}}
    <div>
        <div class="pull-left">
            {{ $majorInfos->render() }}
        </div>
    </div>
@stop
@extends('layouts.layoutSidebar')
{{--by LHW--}}
@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    {{--添加提示响应--}}
    <!-- ERROR TIP -->
    @if(Session::has('successMsg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i>{{ Session::get('successMsg') }}
        </div>
    @endif
    @if(Session::has('failureMsg'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i>{{ Session::get('failureMsg') }}
        </div>
    @endif
    <!-- END ERROR TIP -->


    {{--自定义内容--}}
    <div class="panel">
        <div class="panel-heading" >
            <h3 class="panel-title">教师信息管理</h3>
            <div class="right">
                <a href="{{ url('manageInfo/teacherCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增教师</span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>教师工号</th>
                    <th>教师名称</th>
                    <th>所属学院</th>
                    <th>所属教研室</th>
                    <th>职称</th>
                    <th>可指导最大学生数</th>
                    {{--<th>学位</th>--}}
                    {{--<th>邮箱地址</th>--}}
                    {{--<th>电话号码</th>--}}
                    {{--<th>QQ号</th>--}}
                    {{--<th>微信号</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($teacherInfos as $teacherInfo)
                    <tr>
                        <td>
                            <a href="{{ url('manageInfo/teacherDetail',['id'=>$teacherInfo->teacher_info_id] )}}">详情</a>
                            <a href="{{ url('manageInfo/teacherUpdate',['id'=>$teacherInfo->teacher_info_id] )}}">修改</a>
                            <a href="{{ url('manageInfo/teacherDelete',['id'=>$teacherInfo->teacher_info_id] )}}"
                               onclick="if (confirm('确定要删除这条教师信息吗？') == false) return false;">删除</a>
                        </td>
                        <th>{{$teacherInfo->teacher_job_number}}</th>
                        {{--教师工号--}}
                        <th>{{$teacherInfo->teacher_name}}</th>
                        {{--教师名称--}}
                        <th>{{$teacherInfo->college_info_id($teacherInfo->college_info_id)}}</th>
                        {{--所属学院--}}
                        <th>{{$teacherInfo->section_info_id($teacherInfo->section_info_id)}}</th>
                        {{--所属教研室--}}
                        <th>{{$teacherInfo->positional_title}}</th>
                        {{--职称--}}
                        <th>{{$teacherInfo->max_students}}</th>
                        {{--可指导最大学生数--}}
                        {{--<th>{{$teacherInfo->academic_degree}}</th>--}}
                        {{--学位--}}
                        {{--<th>{{$teacherInfo->mail_address}}</th>--}}
                        {{--邮箱地址--}}
                        {{--<th>{{$teacherInfo->phone_number}}</th>--}}
                        {{--电话号码--}}
                        {{--<th>{{$teacherInfo->qq_number}}</th>--}}
                        {{--QQ号--}}
                        {{--<th>{{$teacherInfo->wechart_name}}</th>--}}
                        {{--微信号--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--分页--}}
    <div>
        <div class="pull-left">
            {{ $teacherInfos->render() }}
        </div>
    </div>
@stop
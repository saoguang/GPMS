@extends('layouts.layoutSidebar')
{{--By Sao Guang--}}
@section('sidebar')
    @include('student.sidebar')
@endsection

@section('content')
    <!-- ERROR TIP -->
    @if(Session::has('successMsg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{Session::get('successMsg')}}
        </div>
    @endif
    @if(Session::has('failureMsg'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i> {{Session::get('failureMsg')}}
        </div>
    @endif
    <!-- END ERROR TIP -->
    <!-- MY SELECTED PROJECT -->
    @if($data['selected'])
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">您选择的课题</h3>
                <div class="right">
                    {{--<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>--}}
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            {{--<div class="panel-body">--}}
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>操作</th>
                        <th>序号</th>
                        <th>课题名称</th>
                        <th>课题类型</th>
                        <th>课题来源</th>
                        <th>对学生要求</th>
                        <th>教师</th>
                        <th>职称</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        {{--取消申请操作, 课题被选状态1代表课题已被选--}}
                        @if($data['selectedProject']->project_choice_status == '1')
                            <td><a href="{{url('/student/cancelSelect', $data['selectedProject']->project_id)}}" onclick="return confirm('确定要取消这条课题申请吗？');"><span class="label label-danger">取消申请</span></a></td>
                        @elseif($data['selectedProject']->project_choice_status == '2'){{--课题被选状态2，代表课题已确定，无法取消--}}
                        <td><span style="color: green"><i class="fa fa-check-circle"></i>选课申请已被采纳</span></td>
                        @endif
                        <td>{{$data['selectedProject']->project_id}}</td>
                        <td>{{$data['selectedProject']->project_name}}</td>
                        <td>{{$data['projectTypes'][$data['selectedProject']->project_type]->item_content}}</td>
                        <td>{{$data['projectOrigins'][$data['selectedProject']->project_origin]->item_content}}</td>
                        <td>{{$data['selectedProject']->require_for_student}}</td>
                        <td>{{$data['selectedProjectTeacherInfo']->teacher_name}}</td>
                        <td>{{$data['selectedProjectTeacherInfo']->positional_title}}</td>
                    </tr>
                    </tbody>
                </table>
            {{--</div>--}}
        </div>
    @endif
    <!-- END MY SELECTED PROJECT -->
    <!-- SELECT PROJECT TABLE -->
    <div class="panel">
        <div class="panel-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-lg-8">
                        <h3 class="panel-title">可选课题</h3>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <form role="form" class="form-horizontal" method="get" action="{{url('/student/selectProject')}}" id="searchTeacherForm">
                            <div class="input-group">
                                <input class="form-control" name="teacherName" type="text" placeholder="请输入教师姓名">
                                <span class="input-group-btn"><a onclick="searchTeacher()" class="btn btn-primary">搜索</a></span>
                            </div>
                            <script type="text/javascript">
                                function searchTeacher() {
                                    document.getElementById("searchTeacherForm").submit();
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        {{--<div class="panel-body no-padding">--}}
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作</th>
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>教师</th>
                    <th>职称</th>
                </tr>
                </thead>
                <form class="form-horizontal" id="projectsForm" role="form" method="post" action="{{url('/student/createProject/adoptProjects')}}">
                    {{csrf_field()}}
                    <tbody>
                    @foreach($data['projects'] as $project)
                        <tr>
                            <td>
                                {{--1已被选状态--}}
                                @if($data['selected'] || $project->project_choice_status == '1')
                                    <span class="label label-default">申请该题</span>
                                @else
                                    <a href="{{url('/student/select', $project->project_id)}}"><span class="label label-primary">申请该题</span></a>
                                @endif
                            </td>
                            <td>{{$project->project_id}}</td>
                            <td>{{$project->project_name}}</td>
                            <td>{{$data['projectTypes'][$project->project_type]->item_content}}</td>
                            <td>{{$data['projectOrigins'][$project->project_origin]->item_content}}</td>
                            <td>{{$project->require_for_student}}</td>
                            <td>{{$project->teacher_name}}</td>
                            <td>{{$project->positional_title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </form>
            </table>
        {{--</div>--}}
        <div class="panel-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-lg-2">
                        <form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('/student/selectProject')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <select title="显示行数" id="selectPages" name="selectPages" class="form-control field">
                                    <option value="10" id="10">显示10行</option>
                                    <option value="25" id="25">显示25行</option>
                                    <option value="50" id="50">显示50行</option>
                                    <option value="100" id="100">显示100行</option>
                                    <option value="250" id="250">显示250行</option>
                                    <option value="500" id="500">显示500行</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SELECT PROJECT TABLE -->
    {!! $data['projects']->links() !!}
    {{--<div class="panel">--}}


    {{--</div>--}}

    <p style="display: none" id="SelectPages">{{Session::get('selectPages')}}</p>
@endsection

@section('page-script')
    <!-- Javascript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <!-- END Javascript -->
    <!-- SELECT -->
    <script>
        $(document).ready(function(){
            //页面行数改变，提交表格
            $("#selectPages").change(function(){
                $("#pageNumForm").submit();
            });
        });
    </script>
    <!-- END SELECT  -->
    <!-- GET SELECT PAGES FROM INPUT -->
    <script>
        $("option#"+$("#SelectPages").html()).prop("selected", true);//改变选项内容
    </script>
    <!-- END GET SELECT PAGES FROM INPUT -->
@endsection
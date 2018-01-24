<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                {{--概览--}}
                <li>
                    <a href="{{url('/admin')}}" class="{{Request::getPathInfo()=="/admin"?"active":""}}">
                        <i class="lnr lnr-home"></i><span>概览</span></a>
                </li>
                {{--信息管理模块--}}
                <li>
                        <a href="#manageInfo" data-toggle="collapse" class="collapsed {{
                        substr_count(url()->current(), 'manageInfo') > 0 ? 'active' : ''}}">
                            <i class="lnr lnr-file-empty"></i> <span>信息管理</span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="manageInfo" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{url('manageInfo/Teacher')}}" class="">教师信息管理_</a></li>
                            <li><a href="{{url('manageInfo/Student')}}" class="">学生信息管理_</a></li>
                            <li><a href="{{url('manageInfo/Class')}}" class="">班级信息管理</a></li>
                            <li><a href="{{url('manageInfo/Major')}}" class="">专业信息管理_</a></li>
                            <li><a href="{{url('manageInfo/College')}}" class="">学院信息管理</a></li>
                            <li><a href="{{url('manageInfo/StaffRoom')}}" class="">教研室信息管理</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
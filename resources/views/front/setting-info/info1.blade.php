@extends('layouts.common') 
@section('content')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userInfo">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">基本资料</a></li>
                            <li><a href="#two" data-toggle="tab">头像照片</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane active">
                                <form id="form-msg" action="{{url('info')}}" method="POST" class="sui-form form-horizontal">
								@csrf
                                    <div class="control-group">
                                        <label for="inputName" class="control-label">昵称：</label>
                                        <div class="controls">
                                            <input type="text" id="inputName" name="email" placeholder="昵称">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputGender" class="control-label">性别：</label>
                                        <div class="controls">
                                            <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="gender" value="1"><span>男</span>
                                        </label>
                                            <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="gender" value="2"><span>女</span>
                                        </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">生日：</label>
                                        <div class="controls">
                                            <select id="select_year2" rel="1990" name="years"></select>年
                                            <select id="select_month2" rel="4" name="month"></select>月
                                            <select id="select_day2" rel="3" name="day"></select>日
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">所在地：</label>
                                        <div class="controls">
                                            <div data-toggle="distpicker">
                                                <div class="form-group area">
                                                    <select class="form-control" id="province1" name="province"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="city1" name="city"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="district1" name="district"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputJob" class="control-label">职业：</label>
                                        <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
                                                <input name="job" type="hidden" data-rules="required"><i class="caret"></i><span>请选择</span></a>
                                            <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="程序员">程序员</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="产品经理">产品经理</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="UI设计师">UI设计师</a></li>
                                            </ul>
                                            </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="sanwei" class="control-label"></label>
                                        <div class="controls">
                                            <button type="submit" class="sui-btn btn-primary">立即注册</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="two" class="tab-pane">

                                <div class="new-photo">
                                    <p>当前头像：</p>
                                    <div class="upload">
                                        <img id="imgShow_WU_FILE_0" width="100" height="100" src="img/_/photo_icon.png" alt="">
                                        <input type="file" id="up_img_WU_FILE_0" />
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 底部栏位 -->
 
	@endsection
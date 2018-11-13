<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
        <link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/typeahead-bs2.min.js"></script>
         <script src="/assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/handlers.js"></script>
</head>

<body>
<div class=" clearfix">
 <div id="add_brand" class="clearfix">

   <div class="title_name">添加品牌</div>
   <form action="{{URL('brand')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <ul class="add_conent">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $v)
                    <li>
                        {{$v}}
                    </li>
                @endforeach
            </ul>
        @endif
    <li class=" clearfix"><label class="label_name">
        <i>*</i>分类名称：</label>
        <select name="category" id="">
            <option value="">==请选择==</option>
            @foreach($category as $k=>$v)
            <option value="{{$v['id']}}">{{str_repeat('-',$v['level']*8).$v['category']}}</option>
            @endforeach
        </select>
    </li>

        <li class=" clearfix">
            <label class="label_name">
                <i>*</i>品牌名称：
            </label> 
            <input name="brand_name" type="text" class="add_text"/>
        </li>
        <li class=" clearfix">
            <label class="label_name">
                <i>*</i>规格名称：
            </label>
            <input id="btn-attr" type="button" value="添加一个属性">
        <div id="attr-container">
        <br>
                <div class="Add_p_s">
                <label class="form-label col-2">属性名：</label>	
                <div class="formControls col-2"><input type="text" class="input-text" placeholder="" id="" name="shop_attr[]" ></div>
                </div>
                <div class="Add_p_s">
                <label class="form-label col-2">属性值：</label>	
                <div class="formControls col-2"><input type="text" class="input-text" placeholder="多个值用逗号隔开" id="" name="shop_value[]" ></div>
                </div>
                <div>
                <input onclick="del_attr(this)" type="button" value="删除">
                </div>
                
        </div>
        <br><hr>
            
        </li>
        <li class=" clearfix"><label class="label_name">品牌图片：</label>
            <input type="file" name="logo" id=""> 
        </li>
            <li class=" clearfix"><label class="label_name"><i>*</i>所属地区：</label> <input name="district" type="text" class="add_text" style="width:120px"/></li>
            <li class=" clearfix"><label class="label_name"><i>*</i>关键字：</label> <input name="explain" type="text" class="add_text" style="width:120px"/></li>
            <li class=" clearfix"><label class="label_name">品牌描述：</label> <textarea name="description" cols="" rows="" class="textarea" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></li>
            <li class=" clearfix"><label class="label_name"><i>*</i>显示状态：</label> 
            <label><input name="checkbox" type="radio"  value="1" ><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="checkbox" value="0"><span class="lbl" >不显示</span></label>
            </li>
    </ul>
    <div class="button_brand"><input name="" type="submit"  class="btn btn-warning" value="保存"/><input name="" type="reset" value="取消" class="btn btn-warning"/></div>
   </form>
 
  
</div>
</body>
</html>

<script type="text/javascript">

     var attrStr = `<div><br><hr><div class="Add_p_s">
                <label class="form-label col-2">属性名：</label>	
                <div class="formControls col-2"><input type="text" class="input-text" value="" placeholder="" id="" name="shop_attr[]" ></div>
                </div>
                <div class="Add_p_s">
                <label class="form-label col-2">属性值：</label>	
                <div class="formControls col-2"><input type="text" class="input-text" value="" placeholder="多个值用逗号隔开" id="" name="shop_value[]" ></div>
                </div> 
                <input onclick="del_attr(this)" type="button" value="删除">
                </div>`;

    $("#btn-attr").click(function(){
        $("#attr-container").append(attrStr)
    });

    function del_attr(o)
    {
        if(confirm("确定要删除吗？"))
        {
            var table = $(o).parent()
            table.remove()
        }
    
    }

</script>

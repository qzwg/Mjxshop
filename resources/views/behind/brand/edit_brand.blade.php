<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改品牌</title>
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

   <div class="title_name">修改品牌</div>
   <form action="{{URL('brand')}}" method="POST" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="url" value="{{$data->LOGO}}">
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
        <select name="spu" id="">
            <option value="">==请选择==</option>
            @foreach($spu as $k=>$v)
            <option value="{{$v->id}}" <?php if($v->id == $data->id ) echo 'selected' ?>> {{$v->name}}</option>
            @endforeach
        </select>
    </li>

        <li class=" clearfix"><label class="label_name"><i>*</i>品牌名称：</label> <input name="brand_name" type="text" value="{{$data->name}}" class="add_text"/></li>
        <li class=" clearfix"><label class="label_name">品牌图片：</label>
        <div class="img_preview">
            <img src="/{{$data->LOGO}}" alt="">
        </div>
            <input type="file" class="preview" name="logo" id=""> 
        <!-- </li> -->
            <li class=" clearfix"><label class="label_name"><i>*</i>所属地区：</label> <input name="district" type="text" class="add_text" style="width:120px" value="{{$data->district}}"/></li>
            <li class=" clearfix"><label class="label_name"><i>*</i>关键字：</label> <input name="explain" type="text" class="add_text" style="width:120px" value="{{$data->keywords}}" /></li>
            <li class=" clearfix"><label class="label_name">品牌描述：</label> <textarea name="description" cols="" rows="" class="textarea" onkeyup="checkLength(this);">{{$data->description}}</textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></li>
            <li class=" clearfix"><label class="label_name"><i>*</i>显示状态：</label> 
            <label><input name="checkbox" type="radio" <?php if($data->state == '启用') echo 'checked' ?> value="1" ><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="checkbox" <?php if($data->state == '停用') echo 'checked' ?> value="0"><span class="lbl" >不显示</span></label>
            </li>
    </ul>
    <div class="button_brand"><input name="" type="submit"  class="btn btn-warning" value="保存"/><input name="" type="reset" value="取消" class="btn btn-warning"/></div>
   </form>
 
  
</div>
</body>
</html>
<script src="/js/img_preview.js"></script>
<script type="text/javascript">

// $(".btn").click(function(){
//     $(".btn").submit();
// })

$(".preview").change(function(){
    var file = this.files[0];
    var str = getObjectUrl(file);
    $(this).prev('.img_preview').remove();
    $(this).before("<div class='img_preview'><img src='"+str+"' width='120' height='120'></div>");
})

</script>

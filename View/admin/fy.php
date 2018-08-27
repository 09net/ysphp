{include header}
<div class="wrapper">
    {include header_menu}
    <script>
    function save_op(){
    	var data = $("#save_op").serialize();
        $.ajax({
            url:window.location.href,
            type:'post',
            data:data,
            dataType:'json',
            success:function(e){
               			$("#submit_button").text(e.info);
            },
            error:function(){
						$("#submit_button").text('{lag 访问本地服务器出错}');
            }

        })
    	return false;
    }
    </script>
    <div class="main-container">
        <div class="padding-md">
            <h2 class="header-text">{lag 翻译测试}</h2>

			<div class="smart-widget">
				<div class="smart-widget-inner">
					<ul class="nav nav-tabs tab-style2">
						<li class="active">
					  		<a href="#add" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-bar-chart-o"></i></span>
					  			<span class="text-wrapper">{lag 添加}</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#cs" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-user"></i></span>
					  			<span class="text-wrapper">{lag 测试}</span>
					  		</a>
					  	</li>
			
			
						
					</ul>
					<div class="smart-widget-body">
						<div class="tab-content">
							<div class="tab-pane fade  active in" id="add">
							<form action="?size=add#add" method="post" class="form-horizontal no-margin form-border">
							
								<div class="form-group">
									<div class="col-lg-12">{if isset($add)}<b style="color:#FF0000">{$add}</b>{/if}</div>
								</div>
				
	                            <div class="form-group">
									<label class="col-lg-2 control-label">{lag 原字符}</label>
									<div class="col-lg-10">
										<input type="text" name="mykey" class="form-control" placeholder="我爱你">
										<span class="help-block">我爱你</span>
									</div>
								</div>
								 <div class="form-group">
									<label class="col-lg-2 control-label">{lag 翻译结果}</label>
									<div class="col-lg-10">
										<input type="text" name="mykey2" class="form-control" placeholder="{lag 我爱你}">
										<span class="help-block">{lag 我爱你}</span>
									</div>
								</div>
								
	                           <div class="form-group">
							     <label class="col-lg-2 control-label"></label>
									<div class="col-lg-10"><button type="submit" class="btn btn-success" id="submit_button">{lag 提交}</button></div>
	
								</div>

								</form>
							</div>
							
								<div class="tab-pane fade  active in" id="cs">
							<form action="?size=get#cs" method="post" class="form-horizontal no-margin form-border">
							
								
				
	                            <div class="form-group">
									<label class="col-lg-2 control-label">{lag 关键字}</label>
									<div class="col-lg-10">
										<textarea name="mykey" class="form-control">{if isset($mykey)}{$mykey}{else}我爱你{/if}</textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">{if isset($get)}<b style="color:#FF0000">{$get}</b>{/if}</div>
								</div>
	                           <div class="form-group">
							     <label class="col-lg-2 control-label"></label>
									<div class="col-lg-10"><button type="submit" class="btn btn-success" id="submit_button">{lag 提交}</button></div>
	
								</div>

								</form>
							</div>
							
						
						
						
						
						</div>
					</div>
				</div>
			</div>
			
            
        </div>
    </div>
    {include left_menu}
</div>
{include footer}

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
            <h2 class="header-text">{lag 分词管理}</h2>

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
									<div class="col-lg-12">{if isset($Mykeystr)}<b style="color:#FF0000">{$Mykeystr}</b>{/if}</div>
								</div>
				
	                            <div class="form-group">
									<label class="col-lg-2 control-label">{lag 关键字}</label>
									<div class="col-lg-10">
										<input type="text" name="mykey" class="form-control" placeholder="{lag 关键字}">
										<span class="help-block">{lag 请输入您要添加的关键字}</span>
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
										<textarea name="content" class="form-control">{if isset($mykey)}{$mykey}{else}零久网络科技有限公司44api.com{/if}</textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">{if isset($fenci)}<pre>
搜索词：<?php echo htmlspecialchars($fenci[0]);?><br />
适配数组：<?php var_dump($fenci[1]);?><br />
智能:<?php var_dump($fenci[2]);?></pre>{/if}</div>
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

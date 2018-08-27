<form class="bs-example bs-example-form" role="form" action="/index/{$mode}/">
<div class="s"><input name="q" type="text" class="input-text" value="{if isset($q)}{$q}{/if}"></div>
<div class="row">
<div class="col-xs-6"><select name="m" class="input-text"><option value="0">{lag 默认}</option>{if $mode=='Tiku'}
<option value="1"{if $m==1} selected="selected"{/if}>{lag 单选题}</option><option value="2"{if $m==2} selected="selected"{/if}>{lag 多选题}</option>
{elseif $mode=='Weibo'}
<option value="1"{if $m==1} selected="selected"{/if}>{lag 图片}</option><option value="2"{if $m==2} selected="selected"{/if}>{lag 视频}</option>
{elseif $mode=='Wbook'}
{elseif $mode=='Ask'}
{elseif $mode=='Pic'}
<option value="1"{if $m==1} selected="selected"{/if}>jpg</option><option value="2"{if $m==2} selected="selected"{/if}>png</option><option value="3"{if $m==3} selected="selected"{/if}>gif</option><option value="4"{if $m==4} selected="selected"{/if}>webp</option><option value="5"{if $m==5} selected="selected"{/if}>bmp</option>
{elseif $mode=='Vod'}
<option value="1"{if $m==1} selected="selected"{/if}>mp4</option><option value="2"{if $m==2} selected="selected"{/if}>mp3</option>
{elseif $mode=='Favour'}
<option value="1"{if $m==1} selected="selected"{/if}>{lag 图片}</option><option value="2"{if $m==2} selected="selected"{/if}>{lag 视频}</option><option value="3"{if $m==3} selected="selected"{/if}>{lag 文档}</option>
{elseif $mode=='File'}
{else}
<option value="1"{if $m==1} selected="selected"{/if}>{lag 图片}</option><option value="2"{if $m==2} selected="selected"{/if}>{lag 资源}</option><option value="3"{if $m==3} selected="selected"{/if}>{lag 视频}</option><option value="4"{if $m==4} selected="selected"{/if}>{lag 悬赏}</option>
{/if}</select></div>
<div class="col-xs-6"><button class="input-text blue" type="submit">{lag 搜索}</button></div>
</div>
</form>
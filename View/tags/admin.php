{if IS_ADMIN}<div class="{if IS_SHOUJI}ys{else}wrap{/if}-box"><div class="tags2"><a target="_self" href="javascript:void(0);" onclick="set_top({$thread_data['id']},'thread',6);" class="btn btn-success btn-xs" >{lag 通过}</a><a target="_self" href="javascript:void(0);" onclick="set_top({$thread_data['id']},'thread',7);" class="btn btn-success btn-xs" >{lag 精华}</a><a target="_self" href="javascript:void(0);" onclick="set_top({$thread_data['id']},'thread',8);" class="btn btn-success btn-xs" >{lag 栏目置顶}</a><a target="_self" href="javascript:void(0);" onclick="set_top({$thread_data['id']},'thread',9);" class="btn btn-success btn-xs" >{lag 全站置顶}</a><a target="_self" href="/post/edit/{$thread_data['id']}" class="btn btn-success btn-xs" >{lag 修改}</a></div></div>{/if}
<div class="waterfall_column">
<div class="cell"><img src="{#bucketcdn}{$v.hash}_220" onclick="openurl({$v.id})"  alt="{$v['tags']}" onerror="nf(this);" /><div class="tags"><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="tags({$v['id']})"></i><?php tags($v['tags']);?></div><div class="user"><i class="fa fa-user"></i><a href="https://{#NOW_LANG}.picadv.com/uid/<?php echo urlencode($v['user']);?>.html">{$v.user}</a></div><div class="date"><i class="fa fa-clock-o"></i><a href="https://{#NOW_LANG}.picadv.com/pic/{$v.id}.html"><?php echo humandate($v['btime']);?></a></div></div>
</div>
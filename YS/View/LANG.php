<!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit" /><meta name="viewport" content="width=device-width, user-scalable=yes" /><title><?php echo DOMAIN;?></title><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><script>(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-2005983165848766",
enable_page_level_ads: true});</script><meta name="keywords" content="<?php echo DOMAIN;?>"><meta name="description" content="<?php echo DOMAIN;?>"><link rel="shortcut icon" href="/favicon.png"><link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css"></head><body>
<header class="bar bar-nav"><h3 style="text-align:center">Language selection</h3></header><div class="content"><div class="row" style="background-color:#FFFFFF;line-height:40px;">
<?php foreach ($langa as $k=>$v){
echo '<div class="col-sm-2 col-xs-4" style="text-align:center"><a href="//'.$k.'.'.DOMAIN.'"  class="btn btn-success" hreflang="'.$v[0].'">'.$v[1].'</a></div>';
}
?>
</div></div></body></html>
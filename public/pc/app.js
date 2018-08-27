function friend(uid, obj) {
    friend_state(uid, function(b, m) {
        var _obj = $(obj);
        if (m) {
            _obj.removeClass("bg-primary");
            _obj.addClass("bg-red");
            _obj.text("取消关注");
        } else {
            _obj.removeClass("bg-red");
            _obj.addClass("bg-primary");
            _obj.text("关注");
        }
    })
}

function clear_mess() {
    swal({
 title: "清空未读数量",
 text: "将会清空你的未读消息数量.不会清空聊天记录",
 type: "warning",
 showCancelButton: true,
 confirmButtonColor: "#DD6B55",
 confirmButtonText: "删除",
 cancelButtonText:l[lang]['取消']
 }, function(){
 $.ajax({
 url: www+'ajax'+exp+"clear_mess",
 type:"POST",
 cache: false,
 dataType: 'json'
 }).then(function(e) {
 setTimeout(function(){
 swal(e.error?"操作成功":"操作失败", e.info, e.error?"success": "error");
 },100);
 $(".xx").text('').hide();
 }, function() {
 swal("失败", "请尝试重新提交", "error");
 });
 });
}
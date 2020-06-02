// 菜单的展开和关闭
$(".menu-list_item-select").hover(function () {
    $(this).children('ul').toggle();
});

// 链接
function _link(event) {
    // 在当前窗口打开
    window.location.href = event.dataset.url;
}

// 登录后
$(document).ready(function () {
    let user = localStorage.getItem("user") !== "undefined" ? JSON.parse(localStorage.getItem("user")) : null;
    if (user !== 'null' && user !== null) {
        $(".nav-right_login span").html(user.username).css('text-transform', 'capitalize');
        $(".nav-right_login").attr("href", "javascript:;");
    }
});

// 菜单的展开和关闭
$(".menu-list_item-select").hover(function () {
    $(this).children('ul').toggle();
});

// 链接
function _link(event) {
    // 在当前窗口打开
    window.location.href = event.dataset.url;
}

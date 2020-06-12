/**
 *
 * @param url
 */
function del(url) {
    layer.confirm('确定要彻底删除吗？', function () {
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            success: function (result) {
                if (result.status === 1) {
                    layer.msg(result.message, {icon: 1, time: 600},function () {
                        location.replace(location.href)
                    });
                } else {
                    layer.msg(result.message, {icon: 5, time: 2000});
                }
            }
        },'JSON')
    })
}
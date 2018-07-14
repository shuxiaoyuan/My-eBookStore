<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
  
    $(document).ready(function() {
        
        /* 右边导航栏 */
        
        // 根据右边导航标签载入某个页面 并切换 active class
        function loadNav(nav) {
            $(".right_nav").removeClass("active");
            $("#li_" + nav).addClass("active");
            
            $("#shelf_infor").load(
                '<?php echo DOMAIN . "index.php?c=user&a=myshelf"; ?>',
                {
                    type : nav
                }
            );
        }
        
        // 设置默认导航标签
        var nav = "all_book";
        
        // 默认加载第一个导航标签
        loadNav(nav);
        
        
        /* 对书架的操作 */
        
        // 点击立即购买
        $("#shelf_infor").on("click", ".buy_book", function() {
            // 获取余额信息
            $.post(
                '<?php echo DOMAIN . "index.php?c=user&a=getbalance"; ?>',
                function(result) {
                    var user_balance = parseFloat(result);
                    $("#modal_user_balance").text(user_balance);
            });
            
            // 获取图书信息
            var buy_pk = this.getAttribute("id");
            var book_pk = buy_pk.split("_")[1];
            var book_name = $("#book_name_" + book_pk).text();
            var book_price = $("#book_price_" + book_pk).text();
            book_price = parseFloat(book_price).toFixed(1);
            var book_amount = $("#book_amount_" + book_pk).text();
            
            // 模态框信息填充
            $("#modal_book_name").text("购买《" + book_name + "》");
            $("#modal_book_cost").text(book_price);
            $("#modal_book_amount").val(1);
            $("#modal_book_amount").attr("max", book_amount);
            $("#modal_book_total").text("（库存：" + book_amount + "）");
            
            // 总价计算
            function costTotal() {
                var amount = $("#modal_book_amount").val();
                var cost = parseFloat(book_price) * parseInt(amount);
                $("#modal_book_cost").text(cost.toFixed(1));
            }
            
            // 点击获取购买数量
            $("#modal_book_amount").click(function() {
                costTotal();
            });
            
            // 拒绝键盘输入数量
            $("#modal_book_amount").keypress(function() {
                return false;
            });
            
            // 允许键盘上下键确定购买数量
            $("#modal_book_amount").keyup(function() {
                costTotal();
            });
            
            // 点击提交订单（首先要解绑事件）
            $("#modal_button_submit").off("click").click(function() {
                $.post(
                    '<?php echo DOMAIN . "index.php?c=user&a=buybook"; ?>',
                    {
                        pk : book_pk,
                        amount : $("#modal_book_amount").val()
                    },
                    function(result) {
                        alert(result);
                        // 重新载入当前页面
                        loadPage(current_page);
                });
                
            });
        });
        
        // 点击移出书架
        $("#shelf_infor").on("click", ".remove_book", function() {
            if(!confirm("确认要将移出书架？")) return false;
            var remove_pk = $(this).attr("id");
            var book_shelf_pk = remove_pk.split("_")[1];
            $.post(
                '<?php echo DOMAIN . "index.php?c=user&a=removebookfromshelf"; ?>',
                {
                    pk : book_shelf_pk
                },
                function(result) {
                    //alert(result);
                    loadNav(nav); // 重新载入本标签
                }
            );
        });
        
        // 点击编辑图书
        $("#content").on("click", "#button_edit", function() {
            
            // 生成购买和移出书架以及取消按钮
            $("#div_shelf_button").html(
              '<button id="button_buy_all" type="button" class="btn btn-primary">全部购买</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + 
              '<button id="button_remove_all" type="button" class="btn btn-danger">移出书架</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
              '<button id="button_cancel_edit" type="button" class="btn btn-default">退出编辑</button>'
            );
            
            // 在图书下面生成选择字体图标
            $(".book_option").html(
              '<a class="a_option a_option_unchecked" href="javascript:void(0);"><span class="glyphicon glyphicon-unchecked" style="font-size:20px;"></span></a>'
            );
            
        });
        
        // 点击图书下的选择字体图标
        $("#shelf_infor").on("click", ".a_option", function() {
            var div_option = $(this).parent();
            if($(this).attr("class") == "a_option a_option_unchecked") {
                div_option.html(
                  '<a class="a_option a_option_check" href="javascript:void(0);"><span class="glyphicon glyphicon-check" style="font-size:20px;"></span></a>'
                );
            }
            else {
                div_option.html(
                  '<a class="a_option a_option_unchecked" href="javascript:void(0);"><span class="glyphicon glyphicon-unchecked" style="font-size:20px;"></span></a>'
                );
            }

        });
        
        // 点击退出编辑
        $("#div_shelf_edit").on("click", "#button_cancel_edit", function() {
            
            // 清空选择字体图标
            $(".book_option").html("");
            
            // 还原原来的编辑按钮
            $("#div_shelf_button").html(
              '<button id="button_edit" type="button" class="btn btn-primary btn-lg btn-block">编辑图书</button>'
            );
        });
        
        // 点击移出书架
        $("#div_shelf_edit").on("click", "#button_remove_all", function() {
            alert("移出书架");

        });
        
        // 点击全部购买
        $("#div_shelf_edit").on("click", "#button_buy_all", function() {
            alert("全部购买");

        });
        
    });
  
</script>
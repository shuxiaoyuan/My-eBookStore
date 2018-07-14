<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>
<script>
  
    $(document).ready(function() {

        /* 右边分页栏 */
        
        // 初始化当前页码为 1
        var current_page = 1;
        
        // 初始化尾页页码为 1 每次载入当前页面时会动态获取
        var last_page = 1;
        
        // active 类一直在当前页
        $("#li_current_page").addClass("active");
        
        // 载入当前页面
        loadPage(current_page);
        
        // 根据页码载入某个页面 并切换 active class 和当前显示页码 并更新尾页页码
        function loadPage(page) {
            $("#current_page").text("第" + page + "页");
            $("#book_infor").load(
                '<?php echo DOMAIN . "index.php?&c=view&a=booktypepage"; ?>',
                {
                    type : "<?php echo $type; ?>",
                    page : page
                }
            );
            $.post(
                '<?php echo DOMAIN . "index.php?&c=view&a=getbooktotal"; ?>',
                {
                    type : "<?php echo $type; ?>",
                    each : 4
                },
                function(result) {
                    // 字符串转 int 函数 parseInt
                    last_page = parseInt(result);
            });
        }
        
        // 点击上一页
        $("#previous_page").click(function() {
            if(current_page> 1) {
                current_page--;
                loadPage(current_page);
            }
        });
        
        // 点击首页
        $("#first_page").click(function() {
            current_page = 1;
            loadPage(current_page);
        });
        
        // 点击尾页
        $("#last_page").click(function() {
            current_page = last_page;
            loadPage(current_page);
        });
        
        // 点击下一页
        $("#next_page").click(function() {
            if(current_page <= last_page) {
                current_page++;
                loadPage(current_page);
            }
        });
        
        
        /* 对图书的具体操作 */
        
        // 点击购买按钮
        $("#book_infor").on("click", ".button_buy", function() {
            // 首先要判断是否处于用户登录状态
            var state = "<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ""; ?>";
            if(state === "") {
                alert("请先登录！");
                return false; // 阻止默认表单提交行为
            }
            
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
        
        
        // 点击加入书架按钮
        $("#book_infor").on("click", ".button_add", function() {
            // 首先要判断是否处于用户登录状态
            var state = "<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ""; ?>";
            if(state === "") {
                alert("请先登录！");
                return false; // 阻止默认表单提交行为
            }
            
            // 获取图书信息
            var add_pk = this.getAttribute("id");
            var book_pk = add_pk.split("_")[1];
            
            $.post(
                '<?php echo DOMAIN . "index.php?c=user&a=addbooktoshelf"; ?>',
                {
                    bid : book_pk
                },
                function(result) {
                    alert(result);
            });
            
        });
        
    });
    
</script>
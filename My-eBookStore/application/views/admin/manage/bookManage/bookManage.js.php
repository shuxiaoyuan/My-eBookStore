<?php

/* 防止 URL 路径访问和不是管理员的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['admin_name'])) {
    
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
            
            $("#book_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=bookmanage"; ?>',
                {
                    type : nav
                }
            );
        }
        
        // 设置默认导航标签
        var nav = "all_book";
        
        // 默认加载第一个导航标签
        loadNav(nav);
        
        // 点击所有图书导航标签
        $("#li_all_book").click(function() {
            loadNav("all_book");
            $("#book_search").show();
            $("#book_page").show();
        });
        
        // 点击新书上架导航标签
        $("#li_new_book").click(function() {
            loadNav("new_book");
            $("#book_search").hide();
            $("#book_page").hide();
        });
        
        
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
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=bookmanage"; ?>',
                {
                    type : "all_book",
                    page : page
                }
            );
            $.post(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=getpagetotal"; ?>',
                {
                    type : "book",
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
        
        
        /* 查看图书标签模块 */
        
        function bookSearch() {
            var book_name = $("#input_search").val();
            if(book_name === "") return false;
            $("#book_infor").load(
                '<?php echo DOMAIN . "index.php?p=admin&c=view&a=bookmanage"; ?>',
                {
                    type : "all_book",
                    name : book_name
                }
            );
        }
        
        // 点击搜索按钮
        $("#a_search").click(function() {
            bookSearch();
        });
        
        // 在搜索框回车
        $("#input_search").keydown(function(e) {
            if(e.which == 13) {
                bookSearch();
                return false; // 阻止回车提交表单的默认行为
            }
        });
        
        
        // 点击编辑按钮
        $("#book_infor").on("click", ".edit_book", function() {

            // 先还原其它编辑状态按钮，这句竟然实现了。。。
            $(".cancel_price").click();
        
            var edit_id = this.getAttribute("id"); // 获取点击编辑按钮的 id
            var book_pk = edit_id.split("_")[1]; // 根据编辑按钮 id 获取图书 pk
            var div_book = document.getElementById("div_" + book_pk); // 获取本图书的 div
            
            // 暂存图书售价
            var book_price = div_book.getElementsByClassName("book_price")[0];
            var price = book_price.innerHTML;
            
            // 暂存原来的按钮元素
            var book_button = div_book.getElementsByClassName("book_button")[0];
            var button = book_button.innerHTML;
            
            // 生成输入框（填充原价）和保存取消按钮
            book_price.innerHTML = "<input id='input_book_price' value='" + price + "' />";
            book_button.innerHTML = '<a id="save_' + book_pk + 
                '" href="javascript:void(0);" class="btn btn-primary save_price" role="button">保存</a>&nbsp;<a id="cancel_' + book_pk + 
                '" href="javascript:void(0);" class="btn btn-default cancel_price" role="button">取消</a>'
            ;
            
            // 点击保存 更新数据，并重新载入此页
            $(".save_price").click(function() {
                
                $.post(
                    '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=editbookprice"; ?>',
                    {
                        edit_book_pk : book_pk,
                        edit_book_price : $("#input_book_price").val()
                    },
                    function(result) {
                        if(result !== "true") {
                            alert(result);
                        }
                        // 保存成功与否，重新载入原来页面
                        loadPage(current_page);
                });
                
            });
            
            // 点击取消 还原回原数据
            $(".cancel_price").click(function() {
                book_price.innerHTML = price;
                book_button.innerHTML = button;
            });
            
        });
        
        // 点击下架按钮
        $("#book_infor").on("click", ".delete_book", function() {
            var delete_id = this.getAttribute("id");
            var book_id = delete_id.split("_")[1];
            var div_book = document.getElementById("div_" + book_id);
            var book_name = div_book.getElementsByClassName("book_name")[0].innerHTML;
            if(confirm("确认要下架《" + book_name + "》？")) {
                $.post(
                    '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=deletebook"; ?>',
                    {
                        pk : book_id
                    },
                    function(result) {
                        if(result !== "true") {
                            alert(result);
                        }
                        // 删除成功与否，重新载入原来页面
                        loadPage(current_page);
                });
            }
        });
        
        /* 添加新书标签模块 */
        
        $("#book_infor").on("click", "#button_add_newbook", function() {
            var msg = true;
            var img = document.getElementById("input_newbook_cover").files[0];
            
            // 各种错误检测
            if(!$("#textarea_newbook_intro").val()) { alert("图书简介不能为空！"); return false; }
            if (!img.type.match('image.*')) { alert("禁止上传非图片文件！"); return false; }
            if(img.size > 2000000) { alert("图片大小不能超过2M！"); return false; }

            $("#form_newbook").ajaxSubmit({
                url : '<?php echo DOMAIN . "index.php?p=admin&c=admin&a=addnewbook"; ?>',
                type : "POST",
                success : function(response){
                    alert(response);
                    loadNav("new_book");
                },
                error : function(msg){
                    alert("上架失败，请稍候重试！");
                }
            });
            return false; // 阻止表单默认提交
        });
        
    });
      
</script>
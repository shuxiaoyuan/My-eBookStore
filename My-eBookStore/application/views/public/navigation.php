<?php

/**
 
 * application/views/public/navigation.php
 
 * 网页头部导航栏
 
 */


/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../index.php");
    
    exit;
    
}

?>
<nav id="nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href='<?php echo DOMAIN; ?>' title="My-eBookStore" target="_top">My-eBookstore</a>
    </div>
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            图书分类<b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo DOMAIN . "index.php?c=view&a=booktype&type=IT"; ?>' target="_top">IT类</a></li>
            <li class="divider"></li>
            <li><a href='<?php echo DOMAIN . "index.php?c=view&a=booktype&type=English"; ?>' target="_top">英语类</a></li>
            <li class="divider"></li>
            <li><a href='<?php echo DOMAIN . "index.php?c=view&a=booktype&type=else"; ?>' target="_top">其它类</a></li>
          </ul>
        </li>
        <li><a href='<?php echo DOMAIN . "index.php?c=view&a=message"; ?>' target="_top">留言反馈</a></li>
        <li><a href='<?php echo DOMAIN . "index.php?c=view&a=aboutus"; ?>' target="_top">关于我们</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input id="input_book_search" type="text" class="form-control" style="width:auto;" placeholder="搜索您想要的书" autocomplete="off" />
          <a id="a_book_search" href="javascript:void(0);">
            <span class="glyphicon glyphicon-search" style="top:5px; left:5px; font-size:20px; color: rgb(255, 255, 255);"></span>
          </a>
        </div>
      </form>
      <div class="navbar-right">
<?php
            
if(isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
    
    // 右上角显示昵称
    if(isset($_SESSION['user_name'])) {
        
        $userModel = new UserModel();
        
        $userNickname = $userModel -> getOneInfor(FIELD_USER_NICKNAME, FIELD_USER_NAME, $_SESSION['user_name']);
        
    }

    echo '        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon" style="top:8px; font-size:16px; color: rgb(255, 255, 255);">
              <img src="' . DOMAIN . "public/images/about/aboutus/Lk.jpg" . '" alt="头像" class="img-circle" style="width:36px; height:36px;" />
              ' . (isset($_SESSION['admin_name']) ?  '管理员' : $userNickname) . '
              <b class="caret"></b>&nbsp;&nbsp;
            </span>
          </a>
          <ul class="dropdown-menu" style="top:50px; right:20px;">         
    ';

    if(isset($_SESSION['admin_name'])) {
         
      echo '        <li><a href="' . DOMAIN . 'index.php?c=view&a=index" target="_top"><span class="glyphicon glyphicon-home text-info">&nbsp;查看前台</span></a></li>
            <li class="divider"></li>
            <li><a href="' . DOMAIN . 'index.php?p=admin&c=view&a=manage" target="_top"><span class="glyphicon glyphicon-wrench text-muted">&nbsp;查看后台</span></a></li>
            <li class="divider"></li>                          
            <li><a href="' . DOMAIN . 'index.php?p=admin&c=admin&a=logout" target="_top"><span class="glyphicon glyphicon-off text-danger">&nbsp;退出登录</span></a></li>
          </ul>
        </li>';
                    
    }
    else if(isset($_SESSION['user_name'])){
    
      echo '        <li><a href="' . DOMAIN . 'index.php?c=user&a=myindex" target="_top"><span class="glyphicon glyphicon-user text-info">&nbsp;个人主页</span></a></li>
            <li class="divider"></li>                        
            <li><a href="' . DOMAIN . 'index.php?c=user&a=logout" target="_top"><span class="glyphicon glyphicon-off text-danger">&nbsp;退出登录</span></a></li>
          </ul>
        </li>';
        
    }
    
}
else {
    
    echo '        <a href="' . DOMAIN . 'index.php?c=guest&a=loginview" target="_top"><span class="btn btn-primary navbar-btn btn-sm" style="margin-right:5px;">登录</span></a>
        <a href="' . DOMAIN . 'index.php?c=guest&a=registerview" target="_top"><span class="btn btn-primary navbar-btn btn-sm" style="margin-left:5px; margin-right:30px;">注册</span></a>';

}

?>

      </div>
    </div>
  </nav>

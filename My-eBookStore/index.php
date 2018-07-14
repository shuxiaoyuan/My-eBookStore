<?php

/**
 
 * 网站入口文件 index.php

 */

//为防止 URL 路径访问设置用于判定的常量
define("ENTRY", "entry");

//加载网站配置文件
require 'config/config.php';

//加载核心框架类
require 'framework/core/framework.class.php';

Framework::run();


/**

 * 本 PHP 文件已结束
 
 * 不加 ?> 结束符的原因自行百度
 
 * 本 PHP 文件的相对路径：index.php

 */
<?php

/* 防止 URL 路径访问 */

if(!defined('ENTRY')) {
    
    header("Location:../../../../index.php");
    
    exit;
    
}

?>
<style>
    /**

    @charset "utf-8";
    body {
        /*定义子元素有3D变换*/
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    */

    /*公共类*/

    /*

    .trans3 {
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    */

    .trans5 {
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .photo_box {
        /*定义视角位置*/
        -webkit-perspective: 10000px;
        -moz-perspective: 10000px;
        -ms-perspective: 10000px;
        perspective: 10000px;
        animation: perserve-in 5s ease-in-out;
    }

    .rotate_box {
        /*相对定位-参照物*/
        position: relative;
        /*定义子元素有3D变换*/
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transform-style: preserve-3d;
        /*定义旋转的中心点*/
        -webkit-transform-origin: 50% 50%;
        -moz-transform-origin: 50% 50%;
        -ms-transform-origin: 50% 50%;
        -o-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        /*水平居中显示*/
        width: 310px;
        height: 485px;
        margin: 100px auto;
        /*自定义动画*/
        animation: turnRound 10s linear 5s infinite;
    }

    .rotate_box .img {
        /*绝对定位*/
        position: absolute;
        /*透明度*/
        opacity: 0.8;
    }

    .photo_box .img1 {
        -webkit-transform: rotateY(0deg) translateZ(320px);
        -moz-transform: rotateY(0deg) translateZ(320px);
        -ms-transform: rotateY(0deg) translateZ(320px);
        -o-transform: rotateY(0deg) translateZ(320px);
        transform: rotateY(0deg) translateZ(320px);
    }

    .photo_box .img2 {
        -webkit-transform: rotateY(60deg) translateZ(320px);
        -moz-transform: rotateY(60deg) translateZ(320px);
        -ms-transform: rotateY(60deg) translateZ(320px);
        -o-transform: rotateY(60deg) translateZ(320px);
        transform: rotateY(60deg) translateZ(320px);
    }

    .photo_box .img3 {
        -webkit-transform: rotateY(120deg) translateZ(320px);
        -moz-transform: rotateY(120deg) translateZ(320px);
        -ms-transform: rotateY(120deg) translateZ(320px);
        -o-transform: rotateY(120deg) translateZ(320px);
        transform: rotateY(120deg) translateZ(320px);
    }

    .photo_box .img4 {
        -webkit-transform: rotateY(180deg) translateZ(320px);
        -moz-transform: rotateY(180deg) translateZ(320px);
        -ms-transform: rotateY(180deg) translateZ(320px);
        -o-transform: rotateY(180deg) translateZ(320px);
        transform: rotateY(180deg) translateZ(320px);
    }

    .photo_box .img5 {
        -webkit-transform: rotateY(240deg) translateZ(320px);
        -moz-transform: rotateY(240deg) translateZ(320px);
        -ms-transform: rotateY(240deg) translateZ(320px);
        -o-transform: rotateY(240deg) translateZ(320px);
        transform: rotateY(240deg) translateZ(320px);
    }

    .photo_box .img6 {
        -webkit-transform: rotateY(300deg) translateZ(320px);
        -moz-transform: rotateY(300deg) translateZ(320px);
        -ms-transform: rotateY(300deg) translateZ(320px);
        -o-transform: rotateY(300deg) translateZ(320px);
        transform: rotateY(300deg) translateZ(320px);
    }

    @keyframes turnRound {
        from {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            -o-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }
        to {
            -webkit-transform: rotateY(360deg);
            -moz-transform: rotateY(360deg);
            -ms-transform: rotateY(360deg);
            -o-transform: rotateY(360deg);
            transform: rotateY(360deg);
        }
    }

    @keyframes perserve-in {
        from {
            -webkit-perspective: 1;
            -moz-perspective: 1;
            -ms-perspective: 1;
            perspective: 1;
        }
        to {
            -webkit-perspective: 5000;
            -moz-perspective: 5000;
            -ms-perspective: 5000;
            perspective: 5000;
        }
    }
  </style>

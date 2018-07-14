<?php

/* 防止 URL 路径访问和没有登录的人访问 */

if(!defined('ENTRY') || !isset($_SESSION['user_name']) ) {
    
    header("Location:../../../../../index.php");
    
    exit;
    
}

?>

<?php
    
foreach($undeliveredOrders as $myOrder) {
    
    echo '
    
        <div class="panel panel-danger" style="padding:0px;">
          <div class="panel-heading">
            <h3 class="panel-title">
              <a class="a_toggle" id="toggle_' . $myOrder[0][FIELD_ORDER_PK] . '" href="javascript:void(0);">
                <span>订单号：' . $myOrder[0][FIELD_ORDER_NUMBER] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span>下单时间：' . $myOrder[0][FIELD_ORDER_TIME] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;
              </a>
            </h3>
          </div>
          <div id="content_' . $myOrder[0][FIELD_ORDER_PK] . '" class="panel-body" style="display:none;">
            <table class="table">
              <thead>
                <tr>
                  <th>图书</th>
                  <th>价格</th>
                  <th>数量</th>
                </tr>
              </thead>
              <tbody>';
              
    foreach($myOrder as $single) {
    
        echo "<tr> 
                <td>" . $single[FIELD_ORDER_BNAME] . "</td>
                <td>" . $single[FIELD_ORDER_BPRICE] . "</td>
                <td>" . $single[FIELD_ORDER_BAMOUNT] . "</td>
              </tr>";
    
    }
    
    echo          '</tbody>
            </table>
          </div>
          <div class="panel-footer">
              <a id="cancel_' . $myOrder[0][FIELD_ORDER_PK] . '" class="cancel_order" href="javascript:void(0);">取消订单</a>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>总价：￥ ' . $myOrder[0][FIELD_ORDER_BPRICE] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>用户：' . $myOrder[0][FIELD_ORDER_UNAME] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>手机号：' . $myOrder[0][FIELD_ORDER_UMOBILE] . '</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span>收货地址：' . $myOrder[0][FIELD_ORDER_UADDRESS] . '</span>
          </div>
        </div>
    
    ';
    
}

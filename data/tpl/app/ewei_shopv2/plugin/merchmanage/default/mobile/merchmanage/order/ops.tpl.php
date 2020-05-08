<?php defined('IN_IA') or exit('Access Denied');?>
<a class="btn btn-sm btn-default order-btn" data-action="remarksaler" data-orderid="<?php  echo $item['id'];?>"><i class="text-success icon icon-pin" <?php  if(empty($item['remarksaler'])) { ?>style="display: none;<?php  } ?>"></i> 备注</a>


<!--未付款-->
<?php  if(empty($item['statusvalue'])) { ?>
    
        <?php  if($item['paytypevalue']==3) { ?>
            <a class="btn btn-success btn-sm order-btn" data-action="send" data-orderid="<?php  echo $item['id'];?>">确认发货</a>
        <?php  } else { ?>
            <?php  if($item['ismerch'] == 0) { ?>
                <a class="btn btn-sm btn-success order-btn" data-action="payorder" data-orderid="<?php  echo $item['id'];?>">确认付款</a>
            <?php  } ?>
        <?php  } ?>
   

<!--已付款-->
<?php  } else if($item['statusvalue'] == 1) { ?>
    <?php  if(!empty($item['addressid']) ) { ?>
        <!--快递 发货-->
       
            <a class="btn btn-success btn-sm order-btn" data-action="send" data-orderid="<?php  echo $item['id'];?>">确认发货</a>
       
    <?php  } else { ?>
        <?php  if($item['isverify']==1) { ?>
            <!--核销 确认核销-->
           
                <a class="btn btn-sm btn-success order-btn" data-action="fetch" data-orderid="<?php  echo $item['id'];?>">确认使用</a>
          
        <?php  } else { ?>
            <!--自提 确认取货-->
           
                <a class="btn btn-sm btn-success order-btn" data-action="fetch" data-orderid="<?php  echo $item['id'];?>">确认<?php  if(!empty($item['ccard'])) { ?>充值<?php  } else { ?>取货<?php  } ?></a>
           
        <?php  } ?>
    <?php  } ?>

    <?php  if($item['sendtype'] > 0) { ?>
        
            <a class="btn btn-success btn-sm order-btn" data-action="sendcancel" data-orderid="<?php  echo $item['id'];?>">取消发货</a>
        
    <?php  } ?>

<!--已发货-->
<?php  } else if($item['statusvalue'] == 2 ) { ?>
    <?php  if(!empty($item['addressid'])) { ?>
       
            <a class="btn btn-sm btn-success" data-nocache="changeexpress" href="<?php  echo mobileUrl('merchmanage/order/op/changeexpress', array('id'=>$item['id']))?>">修改物流</a>
       
            <a class="btn btn-sm btn-success order-btn" data-action="finish" data-orderid="<?php  echo $item['id'];?>">确认收货</a>
        
            <a class="btn btn-success btn-sm order-btn" data-action="sendcancel" data-orderid="<?php  echo $item['id'];?>">取消发货</a>
        

    <?php  } ?>
<?php  } ?>

<?php  if(!empty($item['refundid'])) { ?>
    <a class="btn btn-success btn-sm order-btn" data-action="refund" data-orderid="<?php  echo $item['id'];?>">维权<?php  if($item['refundstate']>0) { ?>处理<?php  } else { ?>详情<?php  } ?></a>
<?php  } ?>
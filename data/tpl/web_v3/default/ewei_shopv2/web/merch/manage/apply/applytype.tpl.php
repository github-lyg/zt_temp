<?php defined('IN_IA') or exit('Access Denied');?><div class="col-sm-6" style='float:left;height:auto;overflow: hidden;margin-bottom:20px;font-size:18px;'>
    <b>提现方式: </b>
    <?php  if(empty($item['applytype'])) { ?>
    <span class='label label-primary'><?php  echo $apply_type[$item['applytype']];?></span>
    <?php  } else if($item['applytype'] == 1) { ?>
    <span class='label label-success'><?php  echo $apply_type[$item['applytype']];?></span>
    <?php  } else if($item['applytype'] == 2) { ?>
    <span class='label label-warning'><?php  echo $apply_type[$item['applytype']];?></span>
    <b>姓名: </b><span style='color:red' id="realname"><?php  echo $item['applyrealname'];?></span>
    <b>支付宝帐号: </b><span style='color:red' id="alipay"><?php  echo $item['alipay'];?></span>
    <?php  } else if($item['applytype'] == 3) { ?>
    <span class='label label-danger'><?php  echo $apply_type[$item['applytype']];?></span>
    <b>姓名: </b><span style='color:red' id="realname"><?php  echo $item['applyrealname'];?></span>
    <b>银行: </b><span style='color:red' id="bankname"><?php  echo $item['bankname'];?></span>
    <b>卡号: </b><span style='color:red' id="bankcard"><?php  echo $item['bankcard'];?></span>
    <?php  } ?>
    <input type="hidden" name="applytype" id="applytype" value="<?php  echo $item['applytype'];?>" />
</div>
<!--913702023503242914-->
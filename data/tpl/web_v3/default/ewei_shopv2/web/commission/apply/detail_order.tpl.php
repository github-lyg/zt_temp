<?php defined('IN_IA') or exit('Access Denied');?><div >
    <p style="font-size: 16px;line-height: 67px;font-weight: bold">订单信息</p>
    <table class="table">
        <thead class="navbar-inner">
        <tr style="background: #f7f7f7">
            <th style="width: 50px;">商品</th>
            <th></th>
            <th style="width: 100px;"></th>
            <th  style="width: 100px;text-align: center">金额</th>
            <th style="width: 100px;text-align: center">付款方式</th>
            <th style="width: 530px;text-align: center">佣金</th>
        </tr>
        <tr></tr>
        </thead>
        <tbody>
        <?php  if(is_array($listpage)) { foreach($listpage as $row) { ?>
        <?php  if(is_array($row['goods'])) { foreach($row['goods'] as $g) { ?>
        <tr class="" style="background: #f7f7f7;border: 1px solid #efefef;">
            <td colspan="6">
                <span style="font-weight: bold"> <?php  echo date('Y-m-d H:i',$row['createtime'])?> </span>
                <?php  echo $row['ordersn'];?>
            </td>
        </tr>
        <tr  class="trorder" >
            <td style="border-right:none;">
                <img class="pull-left" src="<?php  echo tomedia($g['thumb'])?>" style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'"/>
            </td>
            <td style="border-right:none;">
                <span><?php  echo $g['title'];?></span><br/><span><?php  echo $g['optionname'];?></span>
            </td>
            <td  style="border-right: 1px solid #efefef;text-align: right"><span>  <?php  echo number_format($g['price']/$g['total'],2)?><br/>x<?php  echo $g['total'];?></span></td>
            <td style="text-align: center"
            ><span class="text-danger"><?php  echo $row['price'];?></span> <a ><i class="fa fa-question-circle"  data-toggle='popover' data-placement='right' data-html='true' data-trigger='hover'
                                                                     data-content="<table class='table table-hover'>
                                                       <tr><th>总金额</th><td><?php  echo $row['price'];?></td></tr>
                                                       <tr><th>商品小计</th><td><?php  echo $row['goodsprice'];?></td></tr>
                                                       <tr><th>运费</th><td><?php  echo $row['dispatchprice'];?></td></tr>
                                                       <tr><th>会员折扣</th><td><?php  if($row['discountprice']>0) { ?>-<?php  echo $row['discountprice'];?><?php  } ?></td></tr>
                                                       <tr><th>积分抵扣</th><td><?php  if($row['deductprice']>0) { ?>-<?php  echo $row['deductprice'];?><?php  } ?></td></tr>
                                                       <tr><th>余额抵扣</th><td><?php  if($row['deductcredit2']>0) { ?>-<?php  echo $row['deductcredit2'];?><?php  } ?></td></tr>
                                                       <tr><th>满额立减</th><td><?php  if($row['deductenough']>0) { ?>-<?php  echo $row['deductenough'];?><?php  } ?></td></tr>
                                                       <tr><th>优惠券优惠</th><td><?php  if($row['couponprice']>0) { ?>-<?php  echo $row['couponprice'];?><?php  } ?></td></tr>
                                                       <tr><th>卖家改价</th><td><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changeprice']),2)?></td></tr>
                                                       <tr><th>卖家改运费</th><td><?php  if(0<$item['changedipatchpriceprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changedipatchpriceprice']),2)?></td></tr>
                                                       </table>"></i></a></td>

            <td style="text-align: center"><?php  if($row['paytype'] == 1) { ?>
                <i class="icow icow-yue text-warning"></i>余额支付
                <?php  } else if($row['paytype'] == 11) { ?>
                <i class="icow icow-kuajingzhifuiconfukuan text-danger" style="font-size: 17px"></i>后台付款
                <?php  } else if($row['paytype'] == 21) { ?>
                <i class="icow icow-weixin text-success" style="font-size: 17px"></i> 微信支付
                <?php  } else if($row['paytype'] == 22) { ?>
                <i class="icow icow-zhifubao text-primary" style="font-size: 17px"></i>支付宝支付
                <?php  } else if($row['paytype'] == 22) { ?>
                <i class="icow icow-iconzhizuomoban text-info" style="font-size: 17px"></i>银联支付
                <?php  } else if($row['paytype'] == 3) { ?>
                <i class="text-primary icow icow-icon" style="font-size: 17px"></i> 货到付款
                <?php  } ?>
            </td>
            <td class="flex" style="text-align: center;justify-content: space-around;-webkit-justify-content: space-around" >

                <?php  if($this->set['level']>=1 && $row['level']==1) { ?>

                <div class='input-group'>
                    <span class='input-group-addon'>一级佣金</span>
                    <span class='input-group-addon' style='width:80px;'><?php  echo $g['commission1'];?></span>

                    <span class='input-group-addon'>
                                                    <?php  if($g['status1']==-1) { ?>
                                                    <span class='label label-default'>未通过</span>
                                                    <?php  } else if($g['status1']==1) { ?>

                                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio'  data-name="status1_<?php  echo $g['id'];?>"  class='status1' value='-1'  name="status1[<?php  echo $g['id'];?>]" /> 不通过</label>
                                                    <label class='radio-inline'  style='margin-top:-7px;'><input type='radio'  data-name="status1_<?php  echo $g['id'];?>"  value='2'   name="status1[<?php  echo $g['id'];?>]"  /> 通过</label>


                                                    <?php  } else if($g['status1']==2) { ?>
                                                    <span class='text-success'>通过</span>
                                                    <?php  } else if($g['status1']==3) { ?>
                                                    <span class='text-warning'>已打款</span>
                                                    <?php  } ?>
                                                </span>
                    <span class='input-group-addon'>备注</span>
                    <input type='text' data-name="content1_<?php  echo $g['id'];?>" class='form-control' name='content1[<?php  echo $g['id'];?>]' style='width:150px;' value="<?php  echo $g['content1'];?>"/>
                </div>

                <?php  } ?>

                <?php  if($this->set['level']>=2  && $row['level']==2) { ?><p>

                <div class='input-group'>
                    <span class='input-group-addon'  style='width:80px;' >二级佣金</span>
                    <span class='input-group-addon' style='background:#fff;'><?php  echo $g['commission2'];?></span>
                    <!--<span class='input-group-addon'>状态</span>-->
                    <span class='input-group-addon' style='background:#fff'>
                                                    <?php  if($g['status2']==-1) { ?>
                                                    <span class='label label-default'>未通过</span>
                                                    <?php  } else if($g['status2']==1) { ?>

                                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio' class='status2' value='-1' data-name="status2_<?php  echo $g['id'];?>"  name="status2[<?php  echo $g['id'];?>]" /> 不通过</label>
                                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio'  value='2'data-name="status2_<?php  echo $g['id'];?>"   name="status2[<?php  echo $g['id'];?>]"  /> 通过</label>

                                                    <?php  } else if($g['status2']==2) { ?>
                                                    <span class='label label-success'>通过</span>
                                                    <?php  } else if($g['status2']==3) { ?>
                                                    <span class='label label-warning'>已打款</span>
                                                    <?php  } ?>
                                                </span>
                    <span class='input-group-addon'>备注</span>
                    <input type='text' data-name="content2_<?php  echo $g['id'];?>" class='form-control' name='content2[<?php  echo $g['id'];?>]' style='width:150px;' value="<?php  echo $g['content2'];?>">
                </div>
                </p>
                <?php  } ?>
                <?php  if($this->set['level']>=2  && $row['level']==3) { ?><p>
                <div class='input-group'>
                    <span class='input-group-addon'  style='width:80px;'>三级佣金</span>
                    <span class='input-group-addon' style='background:#fff;'><?php  echo $g['commission3'];?></span>
                    <!--<span class='input-group-addon'>状态</span>-->
                    <span class='input-group-addon' style='background:#fff'>
                                    <?php  if($g['status3']==-1) { ?>
                                    <span class='label label-default'>未通过</span>
                                    <?php  } else if($g['status3']==1) { ?>

                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio' class='status3' data-name="status3_<?php  echo $g['id'];?>"  value='-1' name="status3[<?php  echo $g['id'];?>]" /> 不通过</label>
                                    <label class='radio-inline' style='margin-top:-7px;'><input type='radio' value='2' data-name="status3_<?php  echo $g['id'];?>"      name="status3[<?php  echo $g['id'];?>]"  /> 通过</label>

                                    <?php  } else if($g['status3']==2) { ?>
                                    <span class='label label-success'>通过</span>
                                    <?php  } else if($g['status3']==3) { ?>
                                    <span class='label label-warning'>已打款</span>
                                    <?php  } ?>
                                </span>
                    <span class='input-group-addon'>备注</span>
                    <input type='text' data-name="content3_<?php  echo $g['id'];?>" class='form-control' name='content3[<?php  echo $g['id'];?>]' style='width:150px;'  value="<?php  echo $g['content3'];?>"/>
                </div>
                </p>
                <?php  } ?>
            </td>
        </tr>
        <tr></tr>
        <?php  } } ?>
        <?php  } } ?>
    </table>
    <?php  if($total>1) { ?>
    <div style="padding: 20px;text-align: right" >
        <ul class="pagination pagination-centered">
            <?php  if(is_array($page_num_arr)) { foreach($page_num_arr as $k => $num) { ?>
            <li <?php  if($num == $page) { ?>class="active"<?php  } ?>>
            <a href="javascript:;" page="<?php  echo $num;?>" class="pager-nav">
                <?php  echo $num;?>
            </a>
            </li>
            <?php  } } ?>
            <li>
                <a href="javascript:;" page="<?php  echo $page+1?>" class="pager-nav">
                    下一页»
                </a>
            </li>
            <li>
                <a href="javascript:;" page="<?php  echo $total;?>" class="pager-nav" class="page-raduis">
                    尾页
                </a>
            </li>

        </ul>
        <span class="record">共<?php  echo $count;?>条记录</span>
    </div>
    <?php  } ?>
</div>
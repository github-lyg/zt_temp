<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        padding: 10px 20px;
    }
    .table > tbody>.trbody > td{
        border-top:none !important;
    }
    .trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden; font-size:12px;}
    .trorder { background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
    .ops { border-right:1px solid #f2f2f2; text-align: center;}
    .popover-content table{
        margin-bottom: 0;
        width:145px;
    }
    .popover-content table tr td, .popover-content table tr th{
        padding: 0;
        height:20px;
        border:none;
    }
</style>
<div class="page-header">
 当前位置：<span class="text-primary">订单统计 </span>
</div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal"  id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="merch.statistics.order" />
        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="col-sm-5">
                <?php  echo tpl_daterange('datetime', array('sm'=>true,'placeholder'=>'下单时间'),true);?>
            </div>
            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name='searchfield'  class='form-control  input-sm select-md'   style="width:120px;">

                            <option value='ordersn' <?php  if($_GPC['searchfield']=='ordersn') { ?>selected<?php  } ?>>订单号</option>
                            <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>会员信息</option>
                            <option value='address' <?php  if($_GPC['searchfield']=='address') { ?>selected<?php  } ?>>收件人信息</option>
                            <option value='merchname' <?php  if($_GPC['searchfield']=='merchname') { ?>selected<?php  } ?>>商户名称</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
                    <span class="input-group-btn">

                        <button class="btn btn-primary" type="submit"> 搜索</button>
                        <?php if(cv('merch.statistics.order.export')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-success">导出</button>
                        <?php  } ?>
                    </span>
                </div>

            </div>
        </div>

    </form>
    <?php  if(count($list)>0) { ?>
    <table class='table table-responsive' style='table-layout: fixed;'>
        <tr style='background:#f8f8f8'>
            <td style='width:60px;border-left:1px solid #f2f2f2;'>商品</td>
            <td style='width:150px;'></td>
            <td style='width:70px;text-align: right;;'>单价/数量</td>
            <td  style='width:100px;text-align: center;'>收货人</td>
            <td style='width:90px;text-align: center;'>支付/配送</td>
            <td style='width:100px;text-align: center;'>价格</td>
            <td style='width:100px;text-align: center;'>商户名称</td>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <?php  if(is_array($row['goods'])) { foreach($row['goods'] as $g) { ?>
        <tr ><td colspan='7' style='height:20px;padding:0;border-top:none;'>&nbsp;</td></tr>
        <tr class='trorder'>
            <td colspan='7' >
                <span style="font-weight: bold;"><?php  echo date('Y-m-d',$row['createtime'])?> <?php  echo date('H:i:s',$row['createtime'])?></span>
                订单编号: <?php  echo $row['ordersn'];?>
            </td>
            </td>
        </tr>
        <tr class="trbody" style="border: 1px solid #efefef;">
            <td style="width:60px;">
                <img src="<?php  echo tomedia($g['thumb'])?>" style="width: 50px; height: 50px;border:1px solid #ccc;padding:1px;" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'"\>
            </td>
            <td style='text-align: left;overflow:hidden;border-left:none;'  ><?php  echo $g['title'];?></td>
            <td style='text-align:right;border-left:none;'> <?php  echo $g['realprice']/$g['total']?><br/>x <?php  echo $g['total'];?></td>
            <td style="text-align: center"><?php  echo $row['addressname'];?></td>
            <td style="text-align: center"><?php  if($row['paytype'] == 1) { ?>
                <span> <i class="icow icow-yue text-warning" style="font-size: 17px;"></i><span>余额支付</span></span>
                <?php  } else if($row['paytype'] == 11) { ?>
                <span> <i class="icow icow-kuajingzhifuiconfukuan text-danger" style="font-size: 17px"></i>后台付款</span>
                <?php  } else if($row['paytype'] == 2) { ?>
                <span> <i class="icow icow-zaixianzhifu text-info" style="font-size: 17px"></i>在线支付</span>
                <?php  } else if($row['paytype'] == 21) { ?>
                <span> <i class="icow icow-weixinzhifu text-success" style="font-size: 17px"></i>微信支付</span>
                <?php  } else if($row['paytype'] == 22) { ?>
                <span><i class="icow icow-zhifubaozhifu text-primary" style="font-size: 17px"></i>支付宝支付</span>
                <?php  } else if($row['paytype'] == 23) { ?>
                <span class="label label-primary">银联支付</span>
                <?php  } else if($row['paytype'] == 3) { ?>
                <span> <i class="text-primary icow icow-icon" style="font-size: 17px"></i>货到付款</span>
                <?php  } ?>
            </td>
            <td style="text-align: center">
                <a  data-toggle='popover' data-placement='right' data-html="true" data-trigger='hover' data-html='true'
                   data-content="<table class='table table-hover'>


                            <tr><th>商品小计</th><td><?php  echo $row['goodsprice'];?></td></tr>
                            <tr><th>运费</th><td><?php  echo $row['dispatchprice'];?></td></tr>
                            <?php  if($row['discountprice']>0) { ?>
                            <tr><th>会员折扣</th><td class='text-danger'><?php  if($row['discountprice']>0) { ?>-<?php  echo $row['discountprice'];?><?php  } ?></td></tr>
                            <?php  } ?>
                            <?php  if($row['deductprice']>0) { ?>
                            <tr><th>积分抵扣</th><td class='text-danger'><?php  if($row['deductprice']>0) { ?>-<?php  echo $row['deductprice'];?><?php  } ?></td></tr>
                             <?php  } ?>
                             <?php  if($row['deductcredit2']>0) { ?>
                            <tr><th>余额抵扣</th><td class='text-danger'><?php  if($row['deductcredit2']>0) { ?>-<?php  echo $row['deductcredit2'];?><?php  } ?></td></tr>
                             <?php  } ?>
                             <?php  if($row['deductenough']>0) { ?>
                            <tr><th>满额立减</th><td class='text-danger'><?php  if($row['deductenough']>0) { ?>-<?php  echo $row['deductenough'];?><?php  } ?></td></tr>
                             <?php  } ?>
                             <?php  if($row['couponprice']>0) { ?>
                            <tr><th>优惠券优惠</th><td class='text-danger'><?php  if($row['couponprice']>0) { ?>-<?php  echo $row['couponprice'];?><?php  } ?></td></tr>
                             <?php  } ?>
                            <tr><th>卖家改价</th><td <?php  if(0<$item['changeprice']) { ?> class='text-default'<?php  } else { ?>class='text-danger'<?php  } ?>><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changeprice']),2)?></td></tr>
                            <tr><th>卖家改运费</th><td <?php  if(0<$item['changedipatchpriceprice']) { ?> class='text-default'<?php  } else { ?>class='text-danger'<?php  } ?>><?php  if(0<$item['changedipatchpriceprice']) { ?>+<?php  } else { ?>-<?php  } ?><?php  echo number_format(abs($item['changedipatchpriceprice']),2)?></td></tr>
                            <tr><th>实际总金额</th><td style='font-weight:bold'><?php  echo $row['price'];?></td></tr>
                            </table>">
                    <b><?php  echo $row['price'];?></b>
                    <i  class="fa fa-question-circle"></i>
                </a>
            </td>
            <td style="text-align: center"><?php  echo $row['merchname'];?></td>
        </tr>
        <?php  } } ?>
        <?php  } } ?>
        <tfoot>
        <tr>
            <td class="text-right" colspan="7">
                <?php  echo $pager;?>
            </td>
        </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何订单!
        </div>
    </div>
    <?php  } ?>

</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--NDAwMDA5NzgyNw==-->
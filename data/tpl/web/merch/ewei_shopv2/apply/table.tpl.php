<?php defined('IN_IA') or exit('Access Denied');?>
<table class="table table-hover  table-responsive ">
    <thead class="navbar-inner">
    <tr>
        <th style="width:25px;"><?php  if($is_check == 1) { ?><input type='checkbox' class="checkall"/><?php  } ?></th>
        <th style='width:180px;'>订单编号</th>
        <th>订单金额</th>
        <th>可提现金额</th>
        <th>抽成比例</th>
        <th>抽成后获得金额</th>
        <th>订单完成时间</th>
        <th style='width:80px;'>状态</th>
    </tr>
    </thead>
</table>

<div style="max-height:500px;overflow:auto;border:none; overflow-x:hidden;">
    <table class="table table-hover  table-responsive " style="table-layout: fixed;border:none;">
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr class="orderlist" data="<?php  echo $row['id'];?>">
            <td style="width:25px;"><?php  if($is_check == 1) { ?><input type='checkbox' class="checkitem" value="<?php  echo $row['id'];?>"/><?php  } ?></td>
            <td style="width:180px;" data-toggle="tooltip" title="<?php  echo $row['nickname'];?>" style="width:80px;">
                <?php  echo $row['ordersn'];?>
            </td>
            <td><?php  echo $row['orderprice'];?></td>
            <td ><?php  echo $row['realprice'];?></td>
            <td><?php  echo $row['payrate'];?>%</td>
            <td><?php  echo round($row['realpricerate'],2)?></td>
            <td><?php  echo date('Y-m-d H:i:s',$row['finishtime'])?></td>
            <td style='width:80px;cursor: pointer'><?php  if(empty($row['merchapply'])) { ?>
                <span class="label label-default">等待</span>
                <?php  } else if($row['merchapply']==1) { ?>
                <span class="label label-primary">提交申请</span>
                <?php  } else if($row['merchapply']==-1) { ?>
                <span class="label label-danger">拒绝申请</span>
                <?php  } else if($row['merchapply']==2) { ?>
                <span class="label label-primary">通过申请</span>
                <?php  } else if($row['merchapply']==3) { ?>
                <span class="label label-primary">完成打款</span>
                <?php  } ?>
            </td>
        </tr>

        <tr >
            <td colspan='8' style="padding: 0">
                <table class='ordertable' style='table-layout:fixed;display: none;' id="orderinfo_<?php  echo $row['id'];?>">

                    <tr>
                        <td style='width:50px'></td>

                        <td style='width:110px'>订单商品总额：</td>
                        <td style='width:100px'><?php  echo $row['goodsprice'];?></td>

                        <td style='width:110px'>快递金额：</td>
                        <td style='width:100px'><?php  echo $row['dispatchprice'];?></td>

                        <td style='width:110px'>订单改价金额</td>
                        <td style='width:100px'><?php  echo $row['changeprice'];?></td>
                    </tr>

                    <tr>
                        <td style='width:50px'></td>

                        <td style='width:110px'>积分抵扣金额：</td>
                        <td style='width:100px'><?php  echo $row['deductprice'];?></td>

                        <td style='width:110px'>余额抵扣金额：</td>
                        <td style='width:100px'><?php  echo $row['deductcredit2'];?></td>

                        <td style='width:110px'>会员折扣金额：</td>
                        <td style='width:100px'><?php  echo $row['discountprice'];?></td>
                    </tr>

                    <tr>
                        <td style='width:50px'></td>

                        <td style='width:100px'>总促销金额：</td>
                        <td style='width:100px'><?php  echo $row['isdiscountprice'];?></td>

                        <td style='width:110px'>满减金额：</td>
                        <td style='width:100px'><?php  echo $row['deductenough'];?></td>

                        <td style='width:110px'>实际支付金额：</td>
                        <td style='width:100px'><?php  echo $row['price'];?></td>
                    </tr>

                    <tr>
                        <td style='width:50px'></td>

                        <td style='width:110px'>商户促销金额：</td>
                        <td style='width:100px'><?php  echo $row['merchisdiscountprice'];?></td>

                        <td style='width:110px'>商户满减金额：</td>
                        <td style='width:100px'><?php  echo $row['merchdeductenough'];?></td>

                        <td style='width:110px'>商户优惠券金额</td>
                        <td style='width:100px'><?php  echo $row['merchcouponprice'];?></td>
                    </tr>

                    <tr>
                        <td style='width:50px'></td>

                        <td style='width:110px'>分销佣金：</td>
                        <td style='width:100px'><?php  echo $row['commission'];?></td>

                        <td style='width:110px'>秒杀优惠：</td>
                        <td style='width:100px'><?php  echo $row['seckilldiscountprice'];?></td>

                        <td style='width:110px'></td>
                        <td style='width:100px'></td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php  } } ?>
        </tbody>
    </table>
</div>

<script>
    $(function () {
        $(".orderlist td:gt(0)").click(function () {
            var data = $(this).parent(".orderlist").attr('data');
            var id = "orderinfo_" + data;
            $("#"+id).toggle();
        })
    })
</script>


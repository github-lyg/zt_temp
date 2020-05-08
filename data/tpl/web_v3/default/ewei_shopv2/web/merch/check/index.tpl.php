<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-header">
    当前位置：<span class="text-primary"><?php  echo $applytitle;?>提现申请</span>

</div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="merch.check.status<?php  echo $action_status;?>" />
        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="col-sm-6">
                <div class='input-group input-group-sm'   >
                   <div class="input-group-select">
                       <select name='timetype'   class='form-control  input-sm select-md' >
                           <option value=''>不按时间</option>
                           <?php  if($status>=1) { ?><option value='applytime' <?php  if($_GPC['timetype']=='applytime') { ?>selected<?php  } ?>>申请时间</option><?php  } ?>
                           <?php  if($status>=2) { ?><option value='checktime' <?php  if($_GPC['timetype']=='checktime') { ?>selected<?php  } ?>>审核时间</option><?php  } ?>
                           <?php  if($status>=3) { ?><option value='paytime' <?php  if($_GPC['timetype']=='paytime') { ?>selected<?php  } ?>>打款时间</option><?php  } ?>
                       </select>
                   </div>
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
                </div>
            </div>

            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name='searchfield'  class='form-control  input-sm select-md'   style="width:110px;"  >
                            <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>商户信息</option>
                            <option value='applyno' <?php  if($_GPC['searchfield']=='applyno') { ?>selected<?php  } ?>>提现单号</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                           <?php if(cv('merch.check.export')) { ?>
                                <button type="submit" name="export" value="1" class="btn btn-success">导出</button>
                                <?php  } ?>
                    </span>
                </div>

            </div>
        </div>
    </form>

    <?php  $col=8?>


    <?php  if(count($list)>0) { ?>
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner">
        <tr>
            <!--<th style="width:25px;"><input type='checkbox' /></th>-->
            <th style="width:200px;">提现单号</th>
            <th>商户信息</th>
            <th>申请金额<br>抽成后金额</th>
            <?php  if($status > 1) { ?>
            <?php  $col++?>
            <th>通过申请金额<br>抽成后金额</th>
            <?php  } ?>
            <?php  if($status == 3) { ?>
            <?php  $col++?>
            <th>实际打款金额</th>
            <?php  } ?>
            <th>抽成比例</th>
            <th>申请订单个数<?php  if($status > 1) { ?><br>通过申请订单个数<?php  } ?></th>
            <th >提现方式</th>
            <?php  if($_W['routes']=='merch.check.status2') { ?>
            <?php  $col++?>
            <th>最终打款</th>
            <?php  } ?>
            <th>申请时间</th>
            <th style="width:40px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <!--<td style="position: relative; "><input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>-->
            <td><?php  echo $row['applyno'];?></td>
            <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
            <td><?php  echo $row['realprice'];?><br><?php  echo $row['realpricerate'];?></td>
            <?php  if($status > 1) { ?>
            <td><?php  echo $row['passrealprice'];?><br><?php  echo $row['passrealpricerate'];?></td>
            <?php  } ?>
            <?php  if($status == 3) { ?>
            <td><?php  echo $row['finalprice'];?></td>
            <?php  } ?>
            <td><?php  echo $row['payrate'];?>%</td>
            <td><?php  echo $row['ordernum'];?><?php  if($status > 1) { ?><br><?php  echo $row['passordernum'];?><?php  } ?></td>
            <td >
                <?php  if(empty($row['applytype'])) { ?>
                <i class="icow icow-weixin text-success"></i>微信钱包
                <?php  } else if($row['applytype']=='2') { ?>
                <i class="icow icow-weixin text-primary"></i>支付宝
                <?php  } else if($row['applytype']=='3') { ?>
                <i class="icow icow-icon text-warning"></i>银行卡
                <?php  } ?>
            </td>
            <?php  if($_W['routes']=='merch.check.status2') { ?>
            <td><?php  echo $row['finalprice'];?></td>
            <?php  } ?>
            <td>
                <?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
            </td>
            <td style="overflow:visible;">
                <?php if(cv('merch.check.detail')) { ?>
                    <a class='btn btn-default btn-sm btn-op btn-operation' href="<?php  echo webUrl('merch/check/detail',array('id' => $row['id'], 'status' => $status))?>">
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="查看详情">
                            <i class='icow icow-chakan-copy'></i>
                       </span>
                    </a>
                <?php  } ?>
                <?php  if($row['status'] != '2') { ?>
                    <!--<a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/check/delete',array('id' => $row['id']));?>" class="btn btn-danger btn-sm" data-confirm='确认要删除此结账单?'>删除</a>-->
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="<?php  echo $col;?>">
                    <?php  echo $pager;?>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何申请!
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--NDAwMDA5NzgyNw==-->
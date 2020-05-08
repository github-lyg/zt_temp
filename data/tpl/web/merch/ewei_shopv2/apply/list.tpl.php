<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>


<div class="page-header">
    当前位置：<span class="text-primary"><?php  echo $applytitle;?>申请</span>
</div>

<div class="page-content">
    <form action="./merchant.php" method="get" class="form-horizontal  table-search" role="form" id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="apply.list<?php  echo $st;?>" />
        <input type="hidden" name="status" value="<?php  echo $status;?>" />
        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="pull-left">
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
            </div>

            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name='timetype'   class='form-control' >
                            <option value=''>不按时间</option>
                            <?php  if($status>=1) { ?><option value='applytime' <?php  if($_GPC['timetype']=='applytime') { ?>selected<?php  } ?>>申请时间</option><?php  } ?>
                            <?php  if($status>=2) { ?><option value='checktime' <?php  if($_GPC['timetype']=='checktime') { ?>selected<?php  } ?>>审核时间</option><?php  } ?>
                            <?php  if($status>=3) { ?><option value='paytime' <?php  if($_GPC['timetype']=='paytime') { ?>selected<?php  } ?>>打款时间</option><?php  } ?>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入申请单号"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                        <?php if(mcv('merch.apply.list.export')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-success ">导出</button>
                        <?php  } ?>
                    </span>
                </div>

            </div>
        </div>
    </form>

    <?php  if(count($list)>0) { ?>
    <?php  $col=7?>
    <table class="table table-hover">
        <thead class="navbar-inner">
        <tr>
            <th>申请单号</th>

            <th>申请金额<br>抽成后金额</th>

            <?php  if($status > 1) { ?>
            <?php  $col++?>
            <th >通过申请金额<br>抽成后金额</th>
            <?php  } ?>

            <?php  if($status == 3) { ?>
            <?php  $col++?>
            <th>实际打款金额</th>
            <?php  } ?>

            <th>抽成比例</th>

            <th>申请订单个数<?php  if($status > 1) { ?><br>通过申请订单个数<?php  } ?></th>

            <th>提现方式</th>

            <?php  if($status==-1) { ?>
            <?php  $col++?>
            <th>无效时间</th>

            <?php  } else if($status>=3) { ?>
            <th>打款时间</th>

            <?php  } else if($status>=2) { ?>
            <th>审核时间</th>

            <?php  } else if($status>=1) { ?>
            <th>申请时间</th>

            <?php  } ?>

            <th style="width: 45px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td><?php  echo $row['applyno'];?></td>
            <td><?php  echo $row['realprice'];?><br><?php  echo $row['realpricerate'];?></td>
            <?php  if($status > 1) { ?>
            <td><?php  echo $row['passrealprice'];?><br><?php  echo $row['passrealpricerate'];?></td>
            <?php  } ?>
            <?php  if($status == 3) { ?>
            <td><?php  echo $row['finalprice'];?></td>
            <?php  } ?>
            <td><?php  echo $row['payrate'];?>%</td>
            <td><?php  echo $row['ordernum'];?><?php  if($status > 1) { ?><br><?php  echo $row['passordernum'];?><?php  } ?></td>

            <td>
                <?php  if(empty($row['applytype'])) { ?>
                <span><i class="icow icow-weixin text-success"></i> <?php  echo $apply_type[$row['applytype']];?></span>
                <?php  } else if($row['applytype']=='2') { ?>
                <span> <i class="icow icow-zhifubaozhifu text-primary"></i><?php  echo $apply_type[$row['applytype']];?></span>
                <?php  } else if($row['applytype']=='3') { ?>
                <span><i class="icow icow-icon text-warning"></i><?php  echo $apply_type[$row['applytype']];?></span>
                <?php  } ?>
            </td>

            <td>
                <?php  if($row['status']!=1) { ?><a data-toggle='popover' data-content="
                             <?php  if($status>=1 && $row['status']!=1) { ?>申请时间: <br/><?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?><?php  } ?>
                             <?php  if($status>=2 && $row['status']!=2) { ?><br/>审核时间: <br/><?php  echo date('Y-m-d',$row['checktime'])?><br/><?php  echo date('H:i',$row['checktime'])?><?php  } ?>
                             <?php  if($status>=3 && $row['status']!=3) { ?><br/>付款时间: <br/><?php  echo date('Y-m-d',$row['paytime'])?><br/><?php  echo date('H:i',$row['paytime'])?><?php  } ?>
                             <?php  if($status==-1) { ?><br/>无效时间: <br/><?php  echo date('Y-m-d',$row['invalidtime'])?><br/><?php  echo date('H:i',$row['invalidtime'])?><?php  } ?>

                                " data-html="true" data-trigger="hover"><?php  } ?>
                <?php  if($status>=1) { ?>
                <?php  echo date('Y-m-d',$row['applytime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
                <?php  } else if($status>=2) { ?>
                <?php  echo date('Y-m-d',$row['checktime'])?><br/><?php  echo date('H:i',$row['applytime'])?>
                <?php  } else if($status>=3) { ?>
                <?php  echo date('Y-m-d',$row['paytime'])?><br/><?php  echo date('H:i',$row['paytime'])?>
                <?php  } else if($status==-1) { ?>
                <?php  echo date('Y-m-d',$row['invalidtime'])?><br/><?php  echo date('H:i',$row['invalidtime'])?>
                <?php  } ?>
                <?php  if($row['status']!=1) { ?><i class="fa fa-question-circle"></i></a><?php  } ?>
            </td>
            <td>
                <?php if(mcv('merch.apply.detail')) { ?>
                <a class='btn btn-default btn-sm btn-op btn-operation' href="<?php  echo merchUrl('apply/detail',array('id' => $row['id'],'status'=>$row['status']))?>">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="查看详情">
                         <i class='icow icow-chakan-copy'></i>
                    </span>
                </a>
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="<?php  echo $col;?>" class="text-right"><?php  echo $pager;?></td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何<?php  echo $applytitle;?>申请申请!
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--913702023503242914-->
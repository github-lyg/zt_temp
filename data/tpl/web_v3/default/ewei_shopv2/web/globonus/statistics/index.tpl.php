<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">股东分红明细</span>
</div>
<div class="page-content">
    <div class="row">
        <div class="col-sm-4" style="width: 50%">
            <div style="border: 1px solid #e7eaec" class="summary_box float-e-margins">
                <div class="summary_title">
                    <span class="text-default title_inner">累计分红</span>
                </div>
                <div class="summary flex">
                    <div class="flex1 flex column">
                        <h2 class="no-margins tcount text-danger"><?php  echo $successBonus;?>元</h2>
<!--                        <span>分红失败金额: <?php  echo $errorBonus;?> 元</span>-->
                    </div>
                </div>
            </div>
        </div>

        <?php  if($_GPC['partnerLevel']!='') { ?>
        <div class="col-sm-4" style="width: 50%">
            <div style="border: 1px solid #e7eaec" class="summary_box float-e-margins">
                <div class="summary_title">
                    <span class="text-default title_inner">等级分红</span>
                </div>
                <div class="summary flex">
                    <div class="flex1 flex column">
                        <h2 class="no-margins tcount text-danger"><?php  echo $shareholderLevelConditionBonus;?> 元</h2>
                        <span>等级累计分红: <?php  echo $shareholderLevelBonus;?> 元</span>
                    </div>
                </div>
            </div>
        </div>
        <?php  } else { ?>
        <div class="col-sm-4" style="width: 50%">
            <div style="border: 1px solid #e7eaec" class="summary_box float-e-margins">
                <div class="summary_title">
                    <span class="text-default title_inner">分红股东</span>
                </div>
                <div class="summary flex">
                    <div class="flex1 flex column">
                        <h2 class="no-margins tcount"><?php  echo $bonusShareholderTotal;?>个</h2>
                        <span>股东数量: <?php  echo $shareholderTotal;?> 个</span>
                    </div>
                </div>
            </div>
        </div>
        <?php  } ?>
    </div>

    <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
        <input type="hidden" name="c" value="site"/>
        <input type="hidden" name="a" value="entry"/>
        <input type="hidden" name="m" value="ewei_shopv2"/>
        <input type="hidden" name="do" value="web"/>
        <input type="hidden" name="r" value="globonus.statistics"/>

        <div class="page-toolbar row m-b-sm m-t-sm">
            <div class="col-sm-4" style="padding-left: 10px">
                <?php  echo tpl_daterange('time', array('sm'=>true, 'placeholder'=>'搜索时间'),true);?>
            </div>
            <div class="col-sm-7 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name='partnerLevel' class='form-control' style="width:120px;">
                            <option value=''>等级</option>
                            <option value='0' <?php  if($_GPC['partnerLevel']=='0') { ?>selected<?php  } ?>><?php echo empty($set['levelname'])?'普通等级': $set['levelname']?></option>
                            <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
                            <option value='<?php  echo $level['id'];?>' <?php  if($_GPC['partnerLevel']==$level['id']) { ?>selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name='status' class='form-control' style="width:100px;">
                            <option value='' <?php  if($_GPC['status']=='') { ?>selected<?php  } ?>>状态</option>
                            <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>未打款</option>
                            <option value='1' <?php  if($_GPC['status']=='1') { ?>selected<?php  } ?>>已打款</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="股东昵称/姓名/手机号"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">搜索</button>
                        <?php if(cv('globonus.statistics')) { ?>
                        <button type="submit" name="export" value="1" class="btn btn-success">导出</button>
                        <?php  } ?>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-hover  table-responsive ">
        <thead class="navbar-inner">
        <tr>
            <th style='width:100px;'>结算单号</th>
            <th style='width:100px;'>订单单号</th>
            <th style='width:100px;'>粉丝</th>
            <th style='width:100px;'>姓名/手机</th>
            <th style='width:80px;'>等级</th>
            <th style='width:80px;'>分红比例</th>
            <th style='width:80px;'>分红</th>
            <th style='width:70px;'>状态</th>
        </tr>
        </thead>
    </table>

    <div style="max-height:500px;overflow:auto;border:none; overflow-x:hidden;">
        <table class="table table-hover  table-responsive " style="table-layout: fixed;border:none;">
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td style='width:100px;'><?php  echo $row['payno'];?></td>
                <td style='width:100px;'><?php  echo $row['ordersn'];?></td>
                <td style='width:100px;'>
                    <?php if(cv('member.list.view')) { ?>
                    <a href="<?php  echo webUrl('member/list/detail',array('id' => $row['mid']));?>" target='_blank'>
                        <img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                        <?php  echo $row['nickname'];?>
                    </a>
                    <?php  } else { ?>
                        <img src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                        <?php  echo $row['nickname'];?>
                    <?php  } ?>
                </td>

                <td style='width:100px;'><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
                <td style='width:80px;'>
                    <?php  if(empty($row['levelname'])) { ?>
                        <?php echo empty($set['levelname'])?'普通等级': $set['levelname']?>
                    <?php  } else { ?>
                        <?php  echo $row['levelname'];?>
                    <?php  } ?>
                </td>
                <td style='width:80px;'><?php  echo $row['bonus'];?>%</td>
                <td style='width:80px;'><?php  echo $row['money'];?></td>
                <td style='width:70px;'>
                    <?php  if(empty($row['status'])) { ?>
                    <span class="label label-default">等待</span>
                    <?php  } else if($row['status']==-1) { ?>
                    <span class="label label-danger">失败</span> <a data-toggle='tooltip' title='<?php  echo $row['reason'];?>'><i
                            class="fa fa-question-circle"></i></a>
                    <?php  } else if($row['status']==1) { ?>
                    <span class="label label-primary">成功</span>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="8" style="text-align: right">
                    <?php  echo $page;?>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

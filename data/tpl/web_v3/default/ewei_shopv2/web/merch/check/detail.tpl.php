<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">

   当前位置：<span class="text-primary"> 提现申请信息
        <small>(申请单号: <?php  echo $item['applyno'];?></small>
        <small>商家信息: <?php  echo $item['realname'];?> <?php  echo $item['mobile'];?>)</small></span>
</div>
<div class="page-content">
    <div class="step-region" >
        <ul class="ui-step ui-step-4" >
            <li <?php  if($item['status']>=1) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-number" >1</div>
            <div class="ui-step-title" >申请中</div>
            <div class="ui-step-meta" ><?php  if(1<=$item['status']) { ?><?php  echo date('Y-m-d',$item['applytime'])?><br/><?php  echo date('H:i:s',$item['applytime'])?><?php  } ?></div>
            </li>
            <li  <?php  if($item['status']>=2) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-number">2</div>
            <div class="ui-step-title">商家审核</div>
            <div class="ui-step-meta"><?php  if(2<=$item['status']) { ?><?php  echo date('Y-m-d',$item['checktime'])?><br/><?php  echo date('H:i:s',$item['checktime'])?><?php  } ?></div>
            </li>
            <li <?php  if($item['status']>=3) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-number" >3</div>
            <div class="ui-step-title">商家打款</div>
            <div class="ui-step-meta" ><?php  if(3<=$item['status']) { ?><?php  echo date('Y-m-d',$item['paytime'])?><br/><?php  echo date('H:i:s',$item['paytime'])?><?php  } ?></div>
            </li>
            <li <?php  if($item['status']==-1) { ?>class="ui-step-done"<?php  } ?>>
            <div class="ui-step-number" >!</div>
            <div class="ui-step-title">无效</div>
            <div class="ui-step-meta" ><?php  if(-1==$item['status']) { ?><?php  echo date('Y-m-d',$item['invalidtime'])?><br/><?php  echo date('H:i:s',$item['invalidtime'])?><?php  } ?></div>
            </li>
        </ul>
    </div>

    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/manage/apply/box', TEMPLATE_INCLUDEPATH)) : (include template('merch/manage/apply/box', TEMPLATE_INCLUDEPATH));?>

    <form action="./index.php" method="get" class="form-horizontal " role="form" id="form1">
        <input type="hidden" name="c" value="site"/>
        <input type="hidden" name="a" value="entry"/>
        <input type="hidden" name="m" value="ewei_shopv2"/>
        <input type="hidden" name="do" value="web"/>
        <input type="hidden" name="id" value="<?php  echo $id;?>"/>
        <input type="hidden" name="status" value="<?php  echo $status;?>"/>
        <input type="hidden" name="r" value="merch.check.detail"/>

        <div class="page-toolbar m-b-sm m-t-sm">
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/manage/apply/applytype', TEMPLATE_INCLUDEPATH)) : (include template('merch/manage/apply/applytype', TEMPLATE_INCLUDEPATH));?>
            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="订单编号"/>
                 <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button>
                    <?php if(cv('merch.check.detail.export')) { ?>
                    <button type="submit" name="export" value="1" class="btn btn-success">导出</button>
                    <?php  } ?>
                </span>
                </div>
            </div>
        </div>

    </form>

    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/manage/apply/table', TEMPLATE_INCLUDEPATH)) : (include template('merch/manage/apply/table', TEMPLATE_INCLUDEPATH));?>

    <div class="form-group">
        <div class="text-left">
                <?php  if($item['status']==1) { ?>
                    <?php if(cv('merch.check.confirm')) { ?>
                        <input type="button" id="btnconfirm" value="通过申请" class="btn btn-success"/>
                    <?php  } ?>

                    <?php if(cv('merch.check.refuse')) { ?>
                     <input type="button" id="btnnoconfirm" value="拒绝所有申请" class="btn btn-warning"/>
                    <?php  } ?>
                <?php  } ?>
            <?php if(cv('merch.check.pay')) { ?>
                <?php  if($item['status']==2) { ?>
                    <div class="page-toolbar m-b-sm m-t-sm">
                        <div class="col-sm-7" style="width: 320px;">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="finalprice" name="finalprice" value="<?php  echo $item['passrealpricerate'];?>" placeholder="打款金额"/>
                                <span class="input-group-btn">
                                 <?php  if($item['applytype']==0 || $item['applytype']==2) { ?>
                                <button class="btn btn-sm btn-danger" id="btnpay" type="button" style="margin-left: 20px;"> 确认打款</button>
                                <?php  } ?>
                                <button class="btn btn-sm btn-warning" id="btnpayhand" type="button" style="margin-left: 20px;">手动处理</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
            <?php  } ?>
        </div>
    </div>
</div>

<script>
    window.partners = [];
    window.current = 0;

    $(function () {

        $('.checkall').click(function () {
            var checked = $(this).prop('checked');
            $('.checkitem').prop('checked', checked);
        });

        $('#btnnoconfirm').click(function () {
            tip.confirm('确认要拒绝所有申请？',function(){
                confirm(-1);
            });
        });

        $('#btnconfirm').click(function () {
            if ($('.checkitem:checked').length<=0) {
                tip.msgbox.err('请选择通过申请的订单!');
                return;
            }

            $('.checkitem:checked').each(function(){
                window.partners.push( $(this).val() );
            });

            tip.confirm('通过申请后无法进行修改，确认吗？',function(){
                confirm(1);
            });
        });

        $('#btnpay').click(function () {
            if ($('#finalprice').isEmpty()) {
                tip.msgbox.err('请输入打款金额!');
                return;
            }
            var finalprice = $('#finalprice').val();
            var msg = '确认要打款' + finalprice + '元吗？';

            tip.confirm(msg,function(){
                $('#btnpay').button('loading');

                $.ajax({
                    url: "<?php  echo webUrl('merch/check/merchpay')?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: "<?php  echo $item['id'];?>", 'finalprice': finalprice, 'handpay': 0
                    },
                    success: function (ret) {
                        $('#btnpay').button('reset');

                        var result = ret.result;
                        if (ret.status != 1) {
                            tip.msgbox.err(result.message);
                            return;
                        }
                        location.href = biz.url("merch.check.status<?php  echo $status;?>");
                    }
                });
            });
        });

        $('#btnpayhand').click(function () {
            if ($('#finalprice').isEmpty()) {
                tip.msgbox.err('请输入打款金额!');
                return;
            }
            var applytype = $('#applytype').val();
            var msg = '手动处理 , 系统不进行任何打款操作!<br/>请确认你已通过线下方式为商户打款!!!<br/>是否进行手动处理?';
            var finalprice = $('#finalprice').val();

            tip.confirm(msg,function(){
                $('#btnpayhand').button('loading');

                $.ajax({
                    url: "<?php  echo webUrl('merch/check/merchpay')?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: "<?php  echo $item['id'];?>", 'finalprice': finalprice, 'handpay': 1
                    },
                    success: function (ret) {
                        $('#btnpayhand').button('reset');

                        var result = ret.result;
                        if (ret.status != 1) {
                            tip.msgbox.err(result.message);
                            return;
                        }
                        location.href = biz.url("merch.check.status<?php  echo $status;?>");
                    }
                });
            });
        });
    });

    function confirm(type){
        if (type == 1) {
            $('#btnconfirm').button('loading');
        } else {
            $('#btnnoconfirm').button('loading');
        }

        $.ajax({
            url: "<?php  echo webUrl('merch/check/confirm')?>",
            type: 'post',
            dataType: 'json',
            data: {
                id: "<?php  echo $item['id'];?>", 'type': type, 'bpid': window.partners
            },
            success: function (ret) {
                if (type == 1) {
                    $('#btnconfirm').button('reset');
                } else {
                    $('#btnnoconfirm').button('reset');
                }
                var result = ret.result;
                if (ret.status != 1) {
                    tip.msgbox.err(result.message);
                    return;
                }
                location.href = biz.url("merch.check.status<?php  echo $status;?>");
            }
        });



    }

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
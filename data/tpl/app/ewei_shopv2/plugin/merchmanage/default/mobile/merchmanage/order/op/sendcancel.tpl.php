<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/common', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/common', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page fui-page-current order-detail-page'>
    <div class="fui-header fui-header-success">
        <div class="fui-header-left">
            <a class="back btn-back"></a>
        </div>
        <div class="title">取消订单发货</div>
        <div class="fui-header-right"></div>
    </div>
    <div class='fui-content navbar'>

        <?php  if($bundles) { ?>
            <div class="fui-title">选择包裹</div>
            <?php  if(is_array($bundles)) { foreach($bundles as $k => $b) { ?>
                <div class="fui-cell-group check-group">
                    <div class="fui-cell">
                        <div class="fui-cell-label">包裹<?php  echo $b['sendtype'];?></div>
                        <div class="fui-cell-info">
                            <input type="checkbox" class="fui-switch fui-switch-small fui-switch-success pull-right" value="<?php  echo $b['sendtype'];?>" />
                        </div>
                    </div>
                    <?php  if(is_array($b['goods'])) { foreach($b['goods'] as $g) { ?>
                        <div class="fui-list goods-list">
                            <div class="fui-list-media">
                                <img src="<?php  echo tomedia($g['thumb'])?>" class="round" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';">
                            </div>
                            <div class="fui-list-inner">
                                <div class="title"><?php  if($g['ispresell']==1) { ?><span class="fui-label fui-label-danger">预售</span><?php  } ?><?php  echo $g['title'];?></div>
                                <div class="subtitle">
                                    <span class="total half">规格: <?php  echo $g['optionname'];?></span>
                                    <span class="total half">数量: <?php  echo $g['total'];?></span>
                                </div>
                            </div>
                        </div>
                    <?php  } } ?>
                </div>
            <?php  } } ?>
        <?php  } ?>


        <div class="fui-title">取消原因</div>
        <div class="fui-cell-group">
            <div class="fui-cell fui-cell-textarea">
                <div class="fui-cell-info">
                    <textarea rows="8" placeholder="取消发货原因" id="remarksend"></textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="fui-navbar params">
        <div class="nav-item btn btn-gray cancel-params">取消</div>
        <div class="nav-item btn btn-success submit-params">确定</div>
    </div>

    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/merchmanage/static/js/order-op.js'],function(modal){
            modal.initCancel({orderid: "<?php  echo $orderid;?>", bundle:"<?php echo $bundles?1:0?>"});
        });
    </script>
</div>

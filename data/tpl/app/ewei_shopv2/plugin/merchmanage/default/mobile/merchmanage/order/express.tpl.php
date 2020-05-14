<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/common', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/common', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page fui-page-current order-detail-page'>
    <div class="fui-header fui-header-success">
        <div class="fui-header-left">
            <a class="back btn-back"></a>
        </div>
        <div class="title">物流信息</div>
        <div class="fui-header-right"></div>
    </div>
    <div class='fui-content navbar'>

        <div class="fui-list-group">
            <?php  if(empty($list)) { ?>
                <div class="fui-list noclick">
                    <div class="fui-list-inner">
                        <div class="title"><i class="icon icon-information"></i> 未查询到物流信息</div>
                    </div>
                </div>
            <?php  } else { ?>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <div class="fui-list noclick">
                <div class="fui-list-media">
                    <i class="icon icon-address"></i>
                </div>
                <div class="fui-list-inner">
                    <div class="subtitle"><?php  echo $item['time'];?></div>
                    <div class="text"><?php  echo $item['step'];?></div>
                </div>
            </div>
            <?php  } } ?>
            <?php  } ?>
        </div>

    </div>
    <div class="fui-navbar">
        <div class="nav-item btn btn-success cancel-params" onclick="window.history.back();">返回</div>
    </div>
</div>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/common', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/common', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page fui-page-current order-detail-page'>
    <div class="fui-header fui-header-success">
        <div class="fui-header-left">
            <a class="back btn-back"></a>
        </div>
        <div class="title"><?php  if($edit_flag==1) { ?>修改物流信息<?php  } else { ?>订单发货<?php  } ?></div>
        <div class="fui-header-right"></div>
    </div>
    <div class='fui-content navbar'>

        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-label">收件人: </div>
                <div class="fui-cell-info"><?php  echo $address['realname'];?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">联系电话: </div>
                <div class="fui-cell-info"><?php  echo $address['mobile'];?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">收货地址: </div>
                <div class="fui-cell-info newline"><?php  echo $address['province'];?> <?php  echo $address['city'];?> <?php  echo $address['area'];?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">详细地址: </div>
                <div class="fui-cell-info newline"><?php  echo $address['address'];?></div>
            </div>
        </div>

        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-label">快递公司</div>
                <div class="fui-cell-info">
                    <select class="fui-input" id="express">
                        <option value="">其他快递</option>
                        <?php  if(is_array($express_list)) { foreach($express_list as $express_item) { ?>
                            <option value="<?php  echo $express_item['express'];?>" <?php  if($item['express']==$express_item['express']) { ?>selected="selected"<?php  } ?>><?php  echo $express_item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">快递单号</div>
                <div class="fui-cell-info">
                    <input type="text" placeholder="请输入快递单号" class="fui-input" value="<?php  echo $item['expresssn'];?>" id="expresssn">
                </div>
                <?php  if(is_weixin()) { ?>
                    <div class="fui-cell-remark " id="btn-qrcode">扫描条形码</div>
                <?php  } ?>
            </div>
        </div>

        <?php  if($order_goods) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell ">
                    <div class="fui-cell-label ">分包裹发货</div>
                    <div class="fui-cell-info">
                        <input type="checkbox" class="fui-switch fui-switch-small fui-switch-success pull-right toggle" data-toggle-check="true" data-show="parcel" id="sendtype" <?php  if($item['sendtype']>0) { ?>checked="checked" disabled="disabled"<?php  } ?>  />
                    </div>
                </div>
            </div>

            <div class="parcel"  <?php  if($item['sendtype']==0) { ?>style="display: none;"<?php  } ?>>
                <?php  if($item['sendtype'] > 0) { ?>
                    <div class="fui-tab fui-tab-success hasborder" style="margin-top: 0.5rem;" id="myTab">
                        <a data-tab="noshipped" class="active">未发货</a>
                        <a data-tab="shipped">已发货</a>
                    </div>
                    <div class="tab-pane" id="noshipped">
                        <div class="fui-list-group nomargin check-group">
                            <?php  if(is_array($noshipped)) { foreach($noshipped as $k => $g) { ?>
                                <div class="fui-list">
                                    <div class="fui-list-media">
                                        <?php  if($g['sendtype']==0) { ?>
                                        <input type="checkbox" class="fui-radio fui-radio-success batch-item-check" name="sendgoodsid[]" value="<?php  echo $g['id'];?>" <?php  if(!empty($item['quality'])) { ?>checked="true"<?php  } ?> />
                                        <?php  } ?>
                                    </div>
                                    <div class="fui-list-media round">
                                        <img src="<?php  echo tomedia($g['thumb'])?>" class="round small" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';">
                                    </div>
                                    <div class="fui-list-inner">
                                        <div class="title"><?php  if($g['ispresell']==1) { ?><span class="fui-label fui-label-danger">预</span><?php  } ?> <?php  echo $g['title'];?></div>
                                        <div class="subtitle" style="color: #666;"><?php  echo $g['optionname'];?></div>
                                    </div>
                                </div>
                            <?php  } } ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="shipped" style="display: none;">
                        <?php  if(is_array($shipped)) { foreach($shipped as $k => $b) { ?>
                            <div class="fui-cell-group <?php  if($k==1) { ?>nomargin<?php  } ?>">
                                <div class="fui-cell">
                                    <div class="fui-cell-info"><i class="icon icon-gifts"></i> 包裹<?php  echo $b['sendtype'];?></div>
                                </div>
                            </div>
                            <div class="fui-list-group nomargin">
                                <?php  if(is_array($b['goods'])) { foreach($b['goods'] as $g) { ?>
                                    <div class="fui-list noclick">
                                        <div class="fui-list-media round">
                                            <img src="<?php  echo tomedia($g['thumb'])?>" class="round small" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';" />
                                        </div>
                                        <div class="fui-list-inner">
                                            <div class="title"><?php  if($g['ispresell']==1) { ?><span class="fui-label fui-label-danger">预</span><?php  } ?> <?php  echo $g['title'];?></div>
                                            <div class="subtitle" style="color: #666;"><?php  echo $g['optionname'];?></div>
                                        </div>
                                    </div>
                                <?php  } } ?>
                            </div>
                        <?php  } } ?>
                    </div>
                <?php  } else { ?>
                    <div class="fui-cell-group">
                        <div class="fui-cell">
                            <div class="fui-cell-info"><i class="icon icon-gifts"></i> 发货商品</div>
                        </div>
                    </div>
                    <div class="fui-list-group nomargin check-group">
                        <?php  if(is_array($order_goods)) { foreach($order_goods as $k => $g) { ?>
                            <div class="fui-list">
                                <div class="fui-list-media">
                                    <?php  if($g['sendtype']==0) { ?>
                                    <input type="checkbox" class="fui-radio fui-radio-success batch-item-check" name="sendgoodsid[]" value="<?php  echo $g['id'];?>" <?php  if(!empty($item['quality'])) { ?>checked="true"<?php  } ?> />
                                    <?php  } ?>
                                </div>
                                <div class="fui-list-media round">
                                    <img src="<?php  echo tomedia($g['thumb'])?>" class="round small" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';">
                                </div>
                                <div class="fui-list-inner">
                                    <div class="title"><?php  if($g['ispresell']==1) { ?><span class="fui-label fui-label-danger">预</span><?php  } ?> <?php  echo $g['title'];?></div>
                                    <div class="subtitle" style="color: #666;"><?php  echo $g['optionname'];?></div>
                                </div>
                            </div>
                        <?php  } } ?>
                    </div>
                <?php  } ?>
            </div>
        <?php  } ?>

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

    </div>
    <div class="fui-navbar params">
        <div class="nav-item btn btn-gray cancel-params">取消</div>
        <div class="nav-item btn btn-success submit-params">确定</div>
    </div>

    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/merchmanage/static/js/order-op.js'],function(modal){
            modal.initSend({orderid: "<?php  echo $orderid;?>", flag: "<?php  echo intval($edit_flag)?>"});
        });
    </script>
</div>

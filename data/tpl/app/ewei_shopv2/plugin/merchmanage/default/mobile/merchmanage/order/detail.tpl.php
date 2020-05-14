<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/common', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/common', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page fui-page-current order-detail-page'>
    <div class="fui-header fui-header-success">
        <div class="fui-header-left">
            <a class="back btn-back"></a>
        </div>
        <div class="title">订单详情</div>
        <div class="fui-header-right"></div>
    </div>
    <div class='fui-content navbar'>

        <div class="fui-list-group result-list nomargin">
            <div class="fui-list order-status">
                <div class="fui-list-inner">
                    <div class="title">
                        <?php  if($item['status'] == 0) { ?>
                        <?php  if($item['paytype']==3) { ?>
                            等待卖家发货
                        <?php  } else { ?>
                            等待买家付款
                        <?php  } ?>
                        <?php  } else if($item['status'] == 1) { ?>
                            <?php  if($item['isverify'] == 1) { ?>等待买家使用
                            <?php  } else if(empty($item['addressid'])) { ?>等待买家取货
                            <?php  } else { ?>
                                <?php  if($item['sendtype'] > 0) { ?>卖家部分发货<?php  } else { ?>等待卖家发货<?php  } ?>
                            <?php  } ?>
                        <?php  } else if($item['status'] == 2) { ?>
                            等待买家收货
                        <?php  } else if($item['status'] == 3) { ?>
                            交易已完成
                        <?php  } else if($item['status'] == -1) { ?>
                            订单已关闭
                        <?php  } ?>
                    </div>
                    <div class="text">订单金额(含运费): ¥ <?php  echo price_format($item['price'])?><span></span></div>
                </div>
                <div class="fui-list-media">
                    <i class="icon icon-money"></i>
                </div>
            </div>
        </div>

        <div class="fui-cell-group info-cell-group" style="table-layout:fixed;">
            <div class="fui-cell">
                <div class="fui-cell-label">订单编号:</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark black"><?php  echo $item['ordersn'];?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">订单状态:</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark">
                    <?php  if($item['status'] == 0) { ?>
                        <?php  if($item['paytype']==3) { ?>
                            <span class="fui-label fui-label-default round">待发货</span>
                        <?php  } else { ?>
                            <span class="fui-label fui-label-default round">待付款</span>
                        <?php  } ?>
                    <?php  } else if($item['status'] == 1) { ?>
                        <span class="fui-label fui-label-danger round">
                            <?php  if($item['isverify'] == 1) { ?>待使用
                            <?php  } else if(empty($item['addressid'])) { ?>待取货
                            <?php  } else { ?>
                                <?php  if($item['sendtype'] > 0) { ?>部分发货<?php  } else { ?>待发货<?php  } ?>
                            <?php  } ?>
                        </span>
                    <?php  } else if($item['status'] == 2) { ?>
                        <span class="fui-label fui-label-warning round">待收货</span>
                    <?php  } else if($item['status'] == 3) { ?>
                        <span class="fui-label fui-label-success round">交易完成</span>
                    <?php  } else if($item['status'] == -1) { ?>
                        <span class="text-default round">已关闭</span>
                    <?php  } ?>
                </div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">支付状态:</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark">
                    <?php  if($item['paytype'] == 0) { ?>未支付
                    <?php  } else if($item['paytype'] == 1) { ?>余额支付
                    <?php  } else if($item['paytype'] == 11) { ?>后台付款
                    <?php  } else if($item['paytype'] == 21) { ?>微信支付
                    <?php  } else if($item['paytype'] == 22) { ?>支付宝支付
                    <?php  } else if($item['paytype'] == 23) { ?>银联支付
                    <?php  } else if($item['paytype'] == 3) { ?>货到付款<?php  } ?>
                </div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">配送方式:</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark black">
                    <?php  if($item['isverify'] == 1) { ?>线下核销
                    <?php  } else if(!empty($item['addressid'])) { ?>
                        快递<?php  if(!empty($dispatch['dispatchname'])) { ?>(<?php  echo $dispatch['dispatchname'];?>)<?php  } ?>
                    <?php  } else if(!empty($item['isvirtualsend']) || !empty($item['virtual'])) { ?>
                        自动发货<?php  if(!empty($item['isvirtualsend'])) { ?>(虚拟物品)<?php  } else { ?>(虚拟卡密)<?php  } ?>
                    <?php  } else if($item['dispatchtype']) { ?>自提
                    <?php  } else { ?>其他
                    <?php  } ?>
                </div>
            </div>
            <?php  if($item['isverify']==1) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label">核销方式:</div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black">
                        <?php  if($item['verifytype']==0) { ?>
                        整单核销
                        <?php  } else if($item['verifytype']==1) { ?>
                        按次核销
                        <?php  } else if($item['verifytype']==2) { ?>
                        按消费码核销
                        <?php  } ?>
                    </div>
                </div>
                <?php  if($item['verifytype']==0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label">消费码:</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">$item['verifycode']}</div>
                    </div>
                    <?php  if($item['verified']) { ?>
                        <div class="fui-cell">
                            <div class="fui-cell-label">核销时间:</div>
                            <div class="fui-cell-info"></div>
                            <div class="fui-cell-remark noremark black"><?php  echo date('Y-m-d H:i:s', $item['verifytime'])?></div>
                        </div>
                        <?php  if(!empty($saler)) { ?>
                            <div class="fui-cell">
                                <div class="fui-cell-label">核销人:</div>
                                <div class="fui-cell-info"></div>
                                <div class="fui-cell-remark noremark black"><?php  echo $saler['nickname'];?>(<?php  echo $saler['salername'];?>)</div>
                            </div>
                        <?php  } ?>
                        <?php  if(!empty($store)) { ?>
                            <div class="fui-cell">
                                <div class="fui-cell-label">核销门店:</div>
                                <div class="fui-cell-info"></div>
                                <div class="fui-cell-remark noremark black"><?php  echo $store['storename'];?></div>
                            </div>
                        <?php  } ?>
                    <?php  } ?>
                <?php  } ?>
            <?php  } ?>
        </div>

        <?php  if($item['verifytype']==1) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-dingdan"></i> 消费记录</div>
                </div>
            </div>
            <div class="fui-list-group nomargin">
                <?php  if(is_array($verifyinfo)) { foreach($verifyinfo as $v) { ?>
                    <div class="fui-list">
                        <div class="fui-list-inner">
                            <div class="subtitle">
                                <div class="total half">核销员: <?php  echo $v['salername'];?>/<?php  echo $v['nickname'];?></div>
                                <div class="total half">核销门店: <?php  echo $v['storename'];?></div>
                            </div>
                            <div class="subtitle">
                                <div class="total half">核销时间: <?php  echo date('Y-m-d H:i',$v['verifytime'])?></div>
                            </div>
                        </div>
                    </div>
                <?php  } } ?>
            </div>
        <?php  } else if($item['verifytype']==2) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-dingdan"></i> 消费码: <?php  echo $item['verifycode'];?></div>
                </div>
            </div>
            <div class="fui-list-group nomargin">
                <?php  if(is_array($verifyinfo)) { foreach($verifyinfo as $v) { ?>
                    <?php  if($v['verified']) { ?>
                        <div class="fui-list">
                            <div class="fui-list-inner">
                                <div class="subtitle">
                                    <div class="total half">消费码: <?php  echo $v['verifycode'];?></div>
                                    <div class="total half">核销门店: <?php  echo $v['storename'];?></div>
                                </div>
                                <div class="subtitle">
                                    <div class="total half">核销员: <?php  echo $v['salername'];?>/<?php  echo $v['nickname'];?></div>
                                    <div class="total half">核销时间: <?php  echo date('Y-m-d H:i',$v['verifytime'])?></div>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                <?php  } } ?>
            </div>
        <?php  } ?>

        <?php  if(empty($order_goods)) { ?>
            <?php  if(!empty($item['expresssn']) && $item['status']>=2 && !empty($item['addressid'])) { ?>
                <div class="fui-cell-group ">
                    <div class="fui-cell">
                        <div class="fui-cell-info"><i class="icon icon-location"></i> 发货信息</div>
                        <a class="fui-cell-remark" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/order/express', array('express'=>$item['express'], 'expresssn'=>$item['expresssn']))?>">查看物流</a>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">快递公司: </div>
                        <div class="fui-cell-info"><?php  if(empty($item['expresscom'])) { ?>其他快递<?php  } else { ?><?php  echo $item['expresscom'];?><?php  } ?></div>
                        <a class="fui-cell-remark text-success" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/order/op/changeexpress', array('id'=>$item['id']))?>">修改</a>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">快递单号: </div>
                        <div class="fui-cell-info newline"><?php  echo $item['expresssn'];?></div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">发货时间: </div>
                        <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $item['sendtime'])?></div>
                    </div>
                </div>
            <?php  } ?>
        <?php  } else { ?>
            <?php  if(is_array($order_goods)) { foreach($order_goods as $index => $og) { ?>
                <div class="fui-cell-group">
                    <div class="fui-cell">
                        <div class="fui-cell-info"><i class="icon icon-gifts"></i> 发货信息 - <span class="text-danger">包裹<?php  echo chr($index+65)?></span></div>
                        <a class="fui-cell-remark" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/order/express', array('express'=>$og['express'], 'expresssn'=>$og['expresssn']))?>">查看物流</a>
                    </div>
                    <?php  if(is_array($og['goods'])) { foreach($og['goods'] as $g) { ?>
                        <a class="fui-list" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/goods/edit', array('id'=>$g['id']))?>">
                            <div class="fui-list-media">
                                <img src="<?php  echo tomedia($g['thumb'])?>" class="round small"/>
                            </div>
                            <div class="fui-list-inner">
                                <div class="subtitle"><?php  echo $g['title'];?></div>
                            </div>
                            <div class="angle"></div>
                        </a>
                    <?php  } } ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label">快递公司</div>
                        <div class="fui-cell-info"><?php  if(empty($og['expresscom'])) { ?>其他快递<?php  } else { ?><?php  echo $og['expresscom'];?><?php  } ?></div>
                        <a class="fui-cell-remark" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/order/op/changeexpress', array('id'=>$item['id']))?>">修改</a>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">快递单号</div>
                        <div class="fui-cell-info newline"><?php  echo $og['expresssn'];?></div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">发货时间</div>
                        <div class="fui-cell-info"><?php  echo date('Y-m-d H:i:s', $og['sendtime'])?></div>
                    </div>
                </div>
            <?php  } } ?>
        <?php  } ?>

        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-info"><i class="icon icon-location"></i> 收件信息</div>
                <?php  if(!empty($item['addressid'])) { ?>
                  
                        <a class="fui-cell-remark text-success" data-nocache="true" href="<?php  echo mobileUrl('merchmanage/order/op/changeaddress', array('id'=>$item['id']))?>">修改</a>
                    
                <?php  } ?>
            </div>
        </div>
        <div class="fui-cell-group nomargin">
            <?php  if(!empty($item['addressid'])) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">收件人: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $user['realname'];?></div>
                </div>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">联系电话: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $user['mobile'];?></div>
                </div>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">收货地址: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $user['address'];?></div>
                </div>
                <?php  if(!empty($item['remark'])) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">留言: </div>
                        <div class="fui-cell-info text-danger newline"><?php  echo $item['remark'];?></div>
                    </div>
                <?php  } ?>
            <?php  } else if($item['isverify']==1 || !empty($item['virtual']) ||!empty($item['isvirtual'])) { ?>
                <?php  if($item['status']>=2 && !empty($item['virtual']) ) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">发货信息: </div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black"><?php  echo str_replace("\n","<br/>", $item['virtual_str'])?></div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">联系人: </div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black"><?php  echo $user['carrier_realname'];?>, <?php  echo $user['carrier_mobile'];?></div>
                    </div>
                <?php  } ?>
            <?php  } else { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">自提码: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $item['verifycode'];?></div>
                </div>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">自提人: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $user['carrier_realname'];?> <?php  echo $user['carrier_mobile'];?></div>
                </div>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">自提点: </div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $user['address'];?>,  <?php  echo $user['realname'];?>, <?php  echo $user['mobile'];?></div>
                </div>
            <?php  } ?>
        </div>

        <?php  if(!empty($item['invoicename'])) { ?>
            <div class="fui-cell-group info-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-label gray">发票抬头:</div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark noremark black"><?php  echo $item['invoicename'];?></div>
                </div>
            </div>
        <?php  } ?>

        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-info"><i class="icon icon-card"></i> 会员信息</div>
            </div>
        </div>
        <div class="fui-list-group nomargin">
            <a class="fui-list" href="#" data-nocache="true">
                <div class="fui-list-media">
                    <img src="<?php  echo $member['avatar'];?>" class="round">
                </div>
                <div class="fui-list-inner">
                    <div class="title"><?php echo empty($member['nickname'])?"未更新":$member['nickname']?> <?php  if(!empty($member['realname'])) { ?><small>(<?php  echo $member['realname'];?>)</small><?php  } ?></div>
                    <div class="subtitle">
                        <div class="total half">手机号: <?php echo empty($member['mobile'])?"未设置":$member['mobile']?></div>
                        <div class="total half">微信号: <?php echo empty($member['weixin'])?"未设置":$member['weixin']?></div>
                    </div>
                </div>
            </a>
        </div>

        <!-- 订单商品明细 -->
        <?php  if(!empty($item['goods'])) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-gifts"></i> 订单商品</div>
                    <div class="fui-cell-remark noremark"><small>(价格单位: 元)</small></div>
                </div>
            </div>
            <div class="fui-list-group goods-list-group nomargin">
                <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $og) { ?>
                    <div class="fui-list goods-list check-param" data-action="diyform-goods-<?php  echo $og['id'];?>">
                        <a class="fui-list-media" href="<?php  echo mobileUrl('merchmanage/goods/edit', array('id'=>$g['id']))?>">
                            <img src="<?php  echo tomedia($og['thumb'])?>" class="round" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';" />
                        </a>
                        <div class="fui-list-inner">
                            <div class="title">
                                <?php  if(!empty($og['diyformdata']) && $og['diyformdata'] != 'false') { ?><span class="fui-label fui-label-warning round">表单</span><?php  } ?>
                                <?php  if($goods['seckill_task']) { ?><span class="fui-label fui-label-danger round"><?php  echo $goods['seckill_task']['tag'];?></span><?php  if($goods['seckill_room']) { ?><span class="fui-label fui-label-primary"><?php echo $goods['seckill_room']['tag']?:$goods['seckill_room']['title']?></span><?php  } ?><?php  } ?>
                                <?php  if(!empty($goods['invoice'])) { ?><label class='fui-label fui-label-success round'>支持开票</label><?php  } ?>
                                <?php  echo $og['title'];?></div>
                            <div class="text goodstitle">规格: <?php  echo $og['optionname'];?> <?php  if(!empty($og['goodssn'])) { ?>编码: <?php  echo $og['goodssn'];?><?php  } ?> <?php  if(!empty($og['productsn'])) { ?>条码: <?php  echo $og['productsn'];?><?php  } ?></div>
                            <div class="subtitle">
                                <div class="total half">单价/数量: <?php  echo $og['marketprice'];?>x<?php  echo $og['total'];?></div>
                                <div class="total half text-right"><?php  if($item['ispackage']) { ?>商品价格<?php  } else { ?>折扣前/后<?php  } ?>: <?php  if($item['ispackage']) { ?>&yen;<?php  echo price_format($og['marketprice'])?><?php  } else { ?><?php  echo price_format($og['orderprice'])?>/<?php  echo price_format($og['realprice'])?><?php  } ?></div>
                            </div>
                        </div>
                    </div>
                <?php  } } ?>
            </div>
        <?php  } ?>

        <!-- 订单价格小计 -->
        <div class="fui-cell-group">
            <div class="fui-cell">
                <div class="fui-cell-label gray">商品小计</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark black">￥<?php  echo price_format($item['goodsprice'] )?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label gray">运费</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark black">￥<?php  echo price_format($item['olddispatchprice'])?></div>
            </div>
            <?php  if(!$item['ispackage']) { ?>
                <?php  if($item['taskdiscountprice']>0 ) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label auto gray">任务活动优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['taskdiscountprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['lotterydiscountprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label auto gray">游戏活动优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['lotterydiscountprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['discountprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">会员折扣</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['discountprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['deductprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">积分抵扣</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['deductprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['deductenough']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label auto gray">商城满额立减</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['deductenough'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['merchdeductenough']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label auto gray">商户满额立减</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['merchdeductenough'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['couponprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">优惠券优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['couponprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['isdiscountprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">促销优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['isdiscountprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['buyagainprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label auto gray">重复购买优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['buyagainprice'])?></div>
                    </div>
                <?php  } ?>
                <?php  if($item['seckilldiscountprice']>0) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label gray">秒杀优惠</div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark black">-￥<?php  echo price_format($item['seckilldiscountprice'])?></div>
                    </div>
                <?php  } ?>
            <?php  } ?>
            <?php  if(intval($item['changeprice'])!=0) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">卖家改价</div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark black">
                        <span style='<?php  if(0<$item['changeprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>'><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo number_format(abs($item['changeprice']),2)?></span>
                    </div>
                </div>
            <?php  } ?>
            <?php  if(intval($item['changedispatchprice'])!=0) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label gray">卖家改运费</div>
                    <div class="fui-cell-info"></div>
                    <div class="fui-cell-remark black">
                        <span style='<?php  if(0<$item['changedispatchprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>'><?php  if(0<$item['changedispatchprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo abs($item['changedispatchprice'])?></span>
                    </div>
                </div>
            <?php  } ?>
            <div class="fui-cell">
                <div class="fui-cell-label auto gray">实付费(含运费)</div>
                <div class="fui-cell-info"></div>
                <div class="fui-cell-remark noremark black">￥<?php  echo price_format($item['price'])?></div>
            </div>
        </div>

        <?php  if(!empty($coupon)) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-gifts"></i> 优惠券优惠: <?php  echo $coupon['couponname'];?></div>
                </div>
                <div class="fui-cell">
                    <div class="fui-cell-label">优惠方式</div>
                    <div class="fui-cell-info">
                        <?php  if($coupon['backtype']==0) { ?>
                        立减 <?php  echo $coupon['deduct'];?> 元
                        <?php  } else if($coupon['backtype']==1) { ?>
                        打 <?php  echo $coupon['discount'];?> 折
                        <?php  } else if($coupon['backtype']==2) { ?>
                        <?php  if($coupon['backmoney']>0) { ?>返 <?php  echo $coupon['backmoney'];?> 余额<?php  } ?>
                        <?php  if($coupon['backcredit']>0) { ?>返 <?php  echo $coupon['backcredit'];?> 积分<?php  } ?>
                        <?php  if($coupon['backredpack']>0) { ?>返 <?php  echo $coupon['backredpack'];?> 红包<?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <?php  if($coupon['backtype']==2) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label">返利方式</div>
                        <div class="fui-cell-info">
                            <?php  if($item['backwhen']==0) { ?>
                            交易完成后(过退款期限)
                            <?php  } else if($item['backwhen']==1) { ?>
                            订单完成后(收货后)
                            <?php  } else { ?>
                            订单付款后
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-label">返利情况</div>
                        <div class="fui-cell-info"><?php  if(empty($coupon['back'])) { ?>未返利<?php  } else { ?>已返利<?php  } ?></div>
                    </div>
                    <?php  if(!empty($coupon['back'])) { ?>
                        <div class="fui-cell">
                            <div class="fui-cell-label">返利时间</div>
                            <div class="fui-cell-info"><?php  echo date('Y-m-d H:i',$coupon['backtime'])?></div>
                        </div>
                    <?php  } ?>
                <?php  } ?>
            </div>
        <?php  } ?>

        <div class="fui-cell-group info-cell-group" style="table-layout:fixed;">
            <?php  if($item['status']>=0) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label">下单时间:</div>
                    <div class="fui-cell-info"><?php  echo date("Y-m-d H:i:d", $item['createtime'])?></div>
                </div>
            <?php  } ?>
            <?php  if($item['status']>=1) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label">支付时间: </div>
                    <div class="fui-cell-info"><?php  echo date("Y-m-d H:i:d", $item['paytime'])?></div>
                </div>
            <?php  } ?>
            <?php  if($item['status']>=2 || ($item['status']==1 && $item['sendtype'] > 0)) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label">
                        <?php  if($item['isverify'] == 1) { ?>确认使用
                        <?php  } else if(!empty($item['addressid'])) { ?>商家发货
                        <?php  } else if(!empty($item['isvirtualsend']) || !empty($item['virtual'])) { ?>自动发货
                        <?php  } else { ?>确认取货
                        <?php  } ?>: </div>
                    <div class="fui-cell-info"><?php  if(2<=$item['status'] || ($item['status']==1 && $item['sendtype'] > 0)) { ?><?php  echo date('Y-m-d H:i:s',$item['sendtime'])?><?php  } ?></div>
                </div>
            <?php  } ?>
            <?php  if($item['status']>=3) { ?>
                <div class="fui-cell">
                    <div class="fui-cell-label">完成时间: </div>
                    <div class="fui-cell-info"><?php  echo date("Y-m-d H:i:d", $item['finishtime'])?></div>
                </div>
            <?php  } ?>
        </div>

        <?php  if(p('commission') && count($agents)>0) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-group"></i> 分销商信息</div>
                </div>
            </div>
            <div class="fui-list-group nomargin">
                <?php  if(is_array($agents)) { foreach($agents as $key => $value) { ?>
                    <a class="fui-list" href="#" data-nocache="true">
                        <div class="fui-list-media round">
                            <img src="<?php  echo tomedia($value['avatar'])?>" class="round" />
                            <div class="title"><?php  echo $key+1?>级分销商</div>
                        </div>
                        <div class="fui-list-inner">
                            <div class="title">
                                <span class="total"><?php echo empty($value['nickname'])?"未更新":$value['nickname']?><?php  if(!empty($value['realname'])) { ?>(<?php  echo $value['realname'];?>)<?php  } ?></span>
                            </div>
                            <div class="subtitle">
                                <span class="total half">佣金: <?php  echo $value['commission'];?>元</span>
                                <span class="total half">手机号: <?php echo empty($value['mobile'])?"未设置":$value['mobile']?></span>
                            </div>
                        </div>
                    </a>
                <?php  } } ?>
            </div>
        <?php  } ?>

        <?php  if(!empty($order_fields) && !empty($order_data)) { ?>
            <div class="fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info"><i class="icon icon-form"></i> 统一下单信息</div>
                </div>
                <?php  $datas = $order_data?>
                <?php  if(is_array($order_fields)) { foreach($order_fields as $key => $value) { ?>
                    <div class="fui-cell">
                        <div class="fui-cell-label"><?php  echo $value['tp_name']?></div>
                        <div class="fui-cell-info"></div>
                        <div class="fui-cell-remark noremark"><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/mdiyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/mdiyform', TEMPLATE_INCLUDEPATH));?></div>
                    </div>
                <?php  } } ?>
            </div>
        <?php  } ?>

        <div class="fui-title center">更多信息请至PC端查看</div>
    </div>

    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/_tpl/order_params', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/_tpl/order_params', TEMPLATE_INCLUDEPATH));?>

    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/merchmanage/static/js/order-detail.js'],function(modal){
            modal.initDetail();
        });
    </script>

   
    <style>.fui-navbar{display: none;}.fui-navbar.params{display: block;}.fui-list-inner .subtitle .total.half{width: 45%}</style>
        <div class="fui-footer order-detail">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/order/ops', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/order/ops', TEMPLATE_INCLUDEPATH));?>
        </div>
   

</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('merchmanage/_menu', TEMPLATE_INCLUDEPATH)) : (include template('merchmanage/_menu', TEMPLATE_INCLUDEPATH));?>
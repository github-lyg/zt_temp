<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl_order">
    <%each list as item%>
        <%if item.merchname && item.merchid>0%>
            <div class="fui-title small"><i class="icon icon-shop"></i> <%item.merchname%></div>
        <%/if%>
        <div class="fui-list-group <%if item.merchname && item.merchid>0%>nomargin<%/if%>" data-order="<%item.id%>">

            <a class="fui-list order-list title-b" href="<?php  echo mobileUrl('mmanage/order/detail')?>&id=<%item.id%>" data-nocache="true">
                <div class="fui-list-media">
                    <span class="fui-label fui-label-danger round"><%if item.statusvalue==0%><%if item.paytypevalue!=3%>未支付<%else%>货到付款<%/if%><%else%><%item.paytype%><%/if%></span>
                </div>
                <div class="fui-list-inner">
                    <div class="row">
                        <div class="row-text" style="font-size: 0.7rem; color: #666"><%item.ordersn%></div>
                    </div>
                    <div class="row gary">
                        <div class="row-text"><%item.createtime%></div>
                    </div>
                </div>
                <div class="angle"></div>
            </a>
            <%each item.goods as g%>
                <div class="fui-list goods-list">
                    <div class="fui-list-media">
                        <img class="round" src="<%g.thumb%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic100.jpg';" />
                    </div>
                    <div class="fui-list-inner">
                        <div class="title"><%g.title%></div>
                        <div class="subtitle">
                            <div class="total">规格: <%g.optiontitle||"无"%> 编码: <%g.goodssn||"无"%></div>
                        </div>
                    </div>
                    <div class="fui-list-angle auto">￥<span class="marketprice"><%calculate(g.realprice/g.total)%><br> x<%g.total%></span></div>
                </div>
            <%/each%>
            <div class="fui-list log-list noclick">
                <div class="fui-list-inner">
                    <div class="row log-row order">
                        <div class="row-text">订单状态</div>
                        <div class="row-remark"><span class="text-danger"><%item.status%></span></div>
                    </div>
                    <%if item.refundstate>0%>
                        <div class="row log-row order">
                            <div class="row-text">维权状态</div>
                            <div class="row-remark">
                                <%if item.rtype=='0'%>退款申请<%/if%>
                                <%if item.rtype=='1'%>退货退款申请<%/if%>
                                <%if item.rtype=='2'%>换货申请<%/if%>
                                <%if item.refundstate=='4'%>(客户退回物品)<%/if%>
                            </div>
                        </div>
                    <%/if%>
                    <%if item.merchname && item.merchid%>
                        <div class="row log-row order">
                            <div class="row-text">店铺名称</div>
                            <div class="row-remark"><%item.merchname%></div>
                        </div>
                    <%/if%>
                    <div class="row log-row order">
                        <div class="row-text">买家昵称</div>
                        <div class="row-remark"><%item.nickname||'未更新'%></div>
                    </div>
                    <div class="row log-row order">
                        <div class="row-text">配送方式</div>
                        <div class="row-remark"><span class="text-success"><%item.dispatchname%></span></div>
                    </div>
                    <%if item.remark%>
                        <div class="row log-row order">
                            <div class="row-text">买家留言</div>
                            <div class="row-remark"><%item.remark%></div>
                        </div>
                    <%/if%>
                </div>
            </div>

            <div class="fui-list-group-title text-right">
                <small class="status">共<span class="text-success"><%item.goodscount%></span>个商品 实付:<span class="text-success">￥<%item.price%></span> <%if item.dispatchprice!='0.00'%>(含运费: ￥<%item.dispatchprice%>元)<%/if%></small>
            </div>

            <div class="fui-list-group-title text-right big">
                <!-- 维权 -->
                <%if item.refundid>0 && item.merchid==0%>
                    <a class="btn btn-success btn-sm order-btn" data-action="refund" data-orderid="<%item.id%>">维权<%item.refundstate>0?"处理":"详情"%></a>
                <%/if%>
                <!-- 未付款 -->
                <%if item.statusvalue==0 && item.merchid==0%>
                    <%if item.paytypevalue==3%>
                        <a class="btn btn-success btn-sm order-btn" data-action="send" data-orderid="<%item.id%>">确认发货</a>
                    <%else%>
                        <%if item.ismerch==0%>
                            <a class="btn btn-sm btn-success order-btn" data-action="payorder" data-orderid="<%item.id%>">确认付款</a>
                        <%/if%>
                    <%/if%>
                <%/if%>

                <!-- 已付款 -->
                <%if item.statusvalue==1 && item.merchid==0%>
                    <%if item.addressid>0%>
                        <?php if(cv('order.op.send')) { ?>
                            <!-- 快递发货 -->
                            <a class="btn btn-success btn-sm order-btn" data-action="send" data-orderid="<%item.id%>">确认发货</a>
                        <?php  } ?>
                    <%else%>
                        <%if item.isverify==1%>
                            <?php if(cv('order.op.verify')) { ?>
                                <!--核销 确认核销-->
                                <a class="btn btn-success btn-sm order-btn" data-action="fetch" data-orderid="<%item.id%>">确认使用</a>
                            <?php  } ?>
                        <%else%>
                            <?php if(cv('order.op.fetch')) { ?>
                                <!--自提 确认取货-->
                                <a class="btn btn-success btn-sm order-btn" data-action="fetch" data-orderid="<%item.id%>">确认<%item.ccard>0?"充值":"取货"%></a>
                            <?php  } ?>
                        <%/if%>
                    <%/if%>
                    <%if item.sendtype>0%>
                        <?php if(cv('order.op.sendcancel')) { ?>
                            <!--取消发货-->
                            <a class="btn btn-success btn-sm order-btn" data-action="sendcancel" data-orderid="<%item.id%>">取消发货</a>
                        <?php  } ?>
                    <%/if%>
                <%/if%>

                <!-- 已发货 -->
                <%if item.statusvalue==2 && item.merchid==0%>
                    <?php if(cv('order.op.sendcancel')) { ?>
                        <a class="btn btn-success btn-sm order-btn" data-action="sendcancel" data-orderid="<%item.id%>">取消发货</a>
                    <?php  } ?>
                    <?php if(cv('order.op.send')) { ?>
                        <a class="btn btn-success btn-sm order-btn" data-action="finish" data-orderid="<%item.id%>">确认收货</a>
                    <?php  } ?>
                <%/if%>
                <%if item.merchid==0%>
                    <a class="btn btn-sm btn-default order-btn" data-action="remarksaler" data-orderid="<%item.id%>"><i class="text-success icon icon-pin" style="font-size: 0.65rem; <%if !item.remarksaler%>display: none;<%/if%>"></i> 备注</a>
                <%/if%>
                <a class="btn btn-default btn-sm" href="<?php  echo mobileUrl('mmanage/order/detail')?>&id=<%item.id%>">查看详情</a>
            </div>
        </div>
    <%/each%>
</script>
<!--青岛易联互动网络科技有限公司-->
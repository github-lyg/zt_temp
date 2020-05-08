<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<script>document.title = "<?php  echo $page_title;?>";</script>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/plugin/dividend/template/mobile/default/static/css/common.css">
<div class="fui-page">
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">提现明细</div>
        <div class="fui-header-right"></div>
    </div>
    <div class="fui-content">
        <div class='moneytop'>预计<?php  echo $this->set['texts']['dividend']?>：+<span id='dividendcount'></span><?php  echo $this->set['texts']['yuan']?></div>
            <div class="flex topnav" id="tab">
                <a class="active" data-tab="status">所有</a>
                <a href="javascript:void(0)" data-tab="status1">待审核</a>
                <a href="javascript:void(0)" data-tab="status2">待打款</a>
                <a href="javascript:void(0)" data-tab="status3">已打款</a>
                <a href="javascript:void(0)" data-tab="status-1">无效</a>
            </div>
        <div class='content-empty' style='display:none;'>
            <i class='icon icon-manageorder'></i><br/>暂时没有任何数据
        </div>
        <div class="orderitem" id="container"></div>
        <div class='infinite-loading'><span class='fui-preloader'></span><span class='text'> 正在加载...</span></div>



        <script id='tpl_dividend_log_list' type='text/html'>
            <%each list as log%>
            <a href="<?php  echo mobileUrl('dividend/log/detail')?>&id=<%log.id%>" data-nocache="true" class="item">
                <div class="text">
                    <div class="type">
                        <%if log.type==0%>
                        <div class="row-text">提现到余额</div>
                        <%else if log.type==1%>
                        <div class="row-text">提现到微信红包</div>
                        <%else if log.type==2%>
                        <div class="row-text">提现到支付宝</div>
                        <%else if log.type==3%>
                        <div class="row-text">提现到银行卡</div>
                        <%/if%>
                    </div>
                    <div class='inner'></div>
                    <div class='price'>+<%log.dividend%></div>
                </div>
                <div class='text' style='margin-top:8rpx;'>
                    <div class='date'><%log.dealtime%></div>
                    <div class='inner'></div>
                    <div class='status <%if log.status==1%>status1<%else if log.status==2%>status2<%else if log.status==3%>status3<%else%>status0<%/if%>'><%log.statusstr%></div>
                </div>
            </a>
            <%/each%>
        </script>

        <script language='javascript'>
            require(['../addons/ewei_shopv2/plugin/dividend/static/js/log.js'], function (modal) {
                modal.init({fromDetail:false});
            });
        </script>

    </div>
</div>
<script language='javascript'>
    var width = window.screen.width *  window.devicePixelRatio;
    var height = window.screen.height *  window.devicePixelRatio;
    var h = document.body.offsetHeight *  window.devicePixelRatio;
    if(height==2436 && width==1125){
        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").addClass('iphonex')
    }
    if(h == 1923){
        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").removeClass('iphonex');
    }
</script>
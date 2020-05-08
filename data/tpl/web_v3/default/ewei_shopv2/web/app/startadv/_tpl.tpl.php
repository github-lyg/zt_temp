<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl_show_menu">
    <style type="text/css">
        .fui-startadv:before {background: <%style.background%>; opacity: <%style.opacity%>;}
    </style>
    <div class="fui-startadv <%params.style%>">
        <div class="inner">
            <%each data as item%>
                <img src="<%imgsrc item.imgurl%>">
            <%/each%>
            <%if count(data)>1%>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            <%/if%>

            <%if params.style!='default' || params.style=='default'&&params.autoclose>0%>
                <div class="close-adv">
                    <div class="close-btn"><%if params.style=='default'&&params.autoclose>0%><%params.autoclose%> <%if params.canclose>0%>关闭<%else%>秒<%/if%><%/if%></div>
                </div>
            <%/if%>
        </div>
    </div>
</script>

<script type="text/html" id="tpl_edit_menu">

    <div class="form-group">
        <div class="col-sm-2 control-label">广告名称</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="未命名自定义菜单" placeholder="请输入名称" value="<%name%>">
            <div class="help-block">注意：广告名称是便于后台查找。</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">是否启用</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="status" value="0" class="diy-bind" data-bind="status" <%if status==0%>checked="checked"<%/if%>>不启用</label>
            <label class="radio-inline"><input type="radio" name="status" value="1" class="diy-bind" data-bind="status" <%if status==1%>checked="checked"<%/if%>>启用</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group" style="display: none;">
        <div class="col-sm-2 control-label">广告样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="style" value="default" class="diy-bind" data-bind-child="params" data-bind="style" data-bind-init="true" <%if params.style=='default'%>checked="checked"<%/if%>>样式一(全屏)</label>
            <label class="radio-inline"><input type="radio" name="style" value="small-bot" class="diy-bind" data-bind-child="params" data-bind="style" data-bind-init="true" <%if params.style=='small-bot'%>checked="checked"<%/if%>>样式二</label>
        </div>
    </div>

    <%if params.style=='default'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">定时关闭</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="autoclose" value="0" class="diy-bind" data-bind-child="params" data-bind="autoclose" data-bind-init="true" <%if params.autoclose==0%>checked="checked"<%/if%>>关闭</label>
                <label class="radio-inline"><input type="radio" name="autoclose" value="3" class="diy-bind" data-bind-child="params" data-bind="autoclose" data-bind-init="true" <%if params.autoclose==3%>checked="checked"<%/if%>>3秒</label>
                <label class="radio-inline"><input type="radio" name="autoclose" value="5" class="diy-bind" data-bind-child="params" data-bind="autoclose" data-bind-init="true" <%if params.autoclose==5%>checked="checked"<%/if%>>5秒</label>
                <label class="radio-inline"><input type="radio" name="autoclose" value="10" class="diy-bind" data-bind-child="params" data-bind="autoclose" data-bind-init="true" <%if params.autoclose==10%>checked="checked"<%/if%>>10秒</label>
                <label class="radio-inline"><input type="radio" name="autoclose" value="15" class="diy-bind" data-bind-child="params" data-bind="autoclose" data-bind-init="true" <%if params.autoclose==15%>checked="checked"<%/if%>>15秒</label>
            </div>
        </div>
        <%if params.autoclose>0%>
            <div class="form-group">
                <div class="col-sm-2 control-label">手动关闭</div>
                <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="canclose" value="0" class="diy-bind" data-bind-child="params" data-bind="canclose" <%if params.canclose==0%>checked="checked"<%/if%>>关闭</label>
                    <label class="radio-inline"><input type="radio" name="canclose" value="1" class="diy-bind" data-bind-child="params" data-bind="canclose" <%if params.canclose==1%>checked="checked"<%/if%>>开启</label>
                </div>
            </div>
        <%/if%>
        <div class="line"></div>
    <%/if%>

    <%if params.style!='default'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">广告背景</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="background" value="<%style.background%>" />
                    <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
                </div>
            </div>
        </div>
        <div class="form-group" style="display: none;">
            <div class="col-sm-2 control-label">背景透明度</div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="slider col-sm-8 " data-value="<%style.opacity%>" data-min="0" data-max="10" data-decimal="10"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.opacity%></span>(最大是1)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="opacity" value="<%style.opacity%>" type="hidden" />
                </div>
            </div>
        </div>
    <%/if%>

    <div class="form-group">
        <div class="col-sm-2 control-label">显示设置</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <%if params.showtype==0%>checked="checked"<%/if%>>每次显示</label>
            <label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <%if params.showtype==1%>checked="checked"<%/if%>>间隔时间显示</label>
        </div>
    </div>

    <%if params.showtype==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">间隔时间</div>
            <div class="col-sm-10">
                <div class="form-group" style="margin-top: 5px; margin-left: 5px;">
                    <div class="slider col-sm-8" data-value="<%params.showtime||60%>" data-min="1" data-max="240"></div>
                    <div class="col-sm-4 control-labe count"><span><%params.showtime||1%></span>分钟</div>
                    <input class="diy-bind input" data-bind-child="params" data-bind="showtime" value="<%params.showtime||60%>" type="hidden" />
                </div>
            </div>
        </div>
    <%/if%>

    <div class="line"></div>

    <div class="form-items indent" data-min="1" data-max="5">
        <div class="alert alert-warning">添加多个将以轮播图形式展现；广告图片建议尺寸500*700</div>
        <div class="inner" id="form-items">
            <%each data as item itemid %>
                <div class="item" data-id="<%itemid%>">
                    <span class="btn-del del-item" title="删除"></span>
                    <div class="item-body">
                        <div class="item-image drag-btn square" style="height: 110px; line-height: 110px;">
                            <img src="<%imgsrc item.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" style="background: #fff; height: 100%; width: 100%" />
                        </div>
                        <div class="item-form">
                            <div class="input-group" style="margin-bottom:0px;">
                                <input type="text" class="form-control input-sm diy-bind" data-bind-parent="<%itemid%>" data-bind-child="data" data-bind="imgurl" data-bind-init="true" id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%item.imgurl%>" />
                                <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                            </div>
                            <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                                <span class="input-group-addon">点击事件</span>
                                <span class="form-control" style="padding-top: 0; box-shadow: none !important;">
                                    <label class="radio-inline"><input type="radio" name="click-<%itemid%>" value="0" class="diy-bind"  data-bind-parent="<%itemid%>" data-bind-child="data" data-bind="click" data-bind-init="true" <%if item.click=='0'%>checked="checked"<%/if%>>跳转链接</label>
                                    <label class="radio-inline"><input type="radio" name="click-<%itemid%>" value="1" class="diy-bind"  data-bind-parent="<%itemid%>" data-bind-child="data" data-bind="click" data-bind-init="true"<%if item.click=='1'%>checked="checked"<%/if%>>关闭广告</label>
                                </span>
                            </div>
                            <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                                <input type="text" class="form-control input-sm diy-bind" data-bind-parent="<%itemid%>" data-bind-child="data" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接" value="<%item.linkurl%>" disabled />
                                <%if item.linkurl%>
                                    <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                                <%/if%>
                                <span class="input-group-addon btn <%if item.click=='0'%>btn-default<%else%>btn-disabled<%/if%>" <%if item.click=='0'%>data-toggle="selectUrl" data-input="#curl-<%itemid%>" data-platform="wxapp"<%/if%>>选择链接</span>
                            </div>
                        </div>
                    </div>
                </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addItem"><i class="fa fa-plus"></i> 添加一个</div>
    </div>

</script>
<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+4-->
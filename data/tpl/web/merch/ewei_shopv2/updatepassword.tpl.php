<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary">修改密码</span>
</div>

<div class="page-content">
    <form id="dataform" action="" method="post" class="form-horizontal form-validate">
        <div class="form-group">
            <label class="col-sm-2 control-label must">原密码</label>
            <div class="col-sm-7 col-xs-12">
                <input type="password" name="password" class="form-control" value="" autocomplete="off"
                       data-rule-required='true'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">新密码</label>
            <div class="col-sm-7 col-xs-12">
                <input type="password" name="newpassword" class="form-control" value="" autocomplete="off"
                       data-rule-required='true'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">确认密码</label>
            <div class="col-sm-7 col-xs-12">
                <input type="password" name="surenewpassword" class="form-control" value="" autocomplete="off"
                       data-rule-required='true'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-7 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"/>
            </div>
        </div>

    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
 
<!--4000097827-->
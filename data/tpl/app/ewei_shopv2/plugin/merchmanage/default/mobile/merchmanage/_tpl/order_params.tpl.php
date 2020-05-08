<?php defined('IN_IA') or exit('Access Denied');?><div class='fui-content params-block'>
    <div class="inner">

        <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $og) { ?>
            <div class="param-item param-diyform-goods-<?php  echo $og['id'];?>">
                <div class="fui-title">提交的资料</div>
                <div class="fui-cell-group">
                    <?php  $datas = $og['diyformdata']?>
                    <?php  if(is_array($og['diyformfields'])) { foreach($og['diyformfields'] as $key => $value) { ?>
                        <div class="fui-cell">
                            <div class="fui-cell-label"><?php  echo $value['tp_name']?></div>
                            <div class="fui-cell-info"></div>
                            <div class="fui-cell-remark noremark"><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/mdiyform', TEMPLATE_INCLUDEPATH)) : (include template('diyform/mdiyform', TEMPLATE_INCLUDEPATH));?></div>
                        </div>
                    <?php  } } ?>
                </div>
            </div>
        <?php  } } ?>

    </div>

    <div class="fui-navbar params">
        <div class="nav-item btn btn-gray cancel-params">取消</div>
    </div>
</div>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">申请结算</div>

    </div>
    <div class='fui-content navbar' >
        <div class='fui-cell-group'>

            <div class='fui-cell'>
                <div class='fui-cell-info'>订单金额</div>
            </div>
            <div class='fui-cell'>
                <div class='fui-cell-label big' style='width:auto;font-size:1.2rem;'>￥</div>
                <div class='fui-cell-info' style='font-size:1.2rem;' ><?php  echo number_format($item['orderprice'],2)?></div>
            </div>
            <div class='fui-cell'>
                <div class='fui-cell-info'>可提现金额</div>
            </div>
            <div class='fui-cell'>
                <div class='fui-cell-label big' style='width:auto;font-size:1.2rem;'>￥</div>
                <div class='fui-cell-info' style='font-size:1.2rem;' ><?php  echo number_format($item['realpricerate'],2)?></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label" style="width: 120px;"><span class="re-g">提现方式</span></div>
                <div class="fui-cell-info">

                    <select id="applytype">
                        <?php  if(is_array($type_array)) { foreach($type_array as $key => $value) { ?>
                        <option value="<?php  echo $key;?>" <?php  if(!empty($value['checked'])) { ?>selected<?php  } ?>><?php  echo $value['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="fui-cell-remark"></div>
            </div>

            <?php  if(!empty($type_array['2']) || !empty($type_array['3'])) { ?>
            <div class="fui-cell ab-group" <?php  if(empty($type_array[2]['checked']) || empty($type_array[3]['checked']) ) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">姓名</div>
                <div class="fui-cell-info"><input type="text" id="realname" name="realname" class='fui-input' value="<?php  echo $last_data['realname'];?>" max="25"/></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($type_array['2'])) { ?>
            <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">支付宝帐号</div>
                <div class="fui-cell-info"><input type="text" id="alipay" name="alipay" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
            </div>

            <div class="fui-cell alipay-group" <?php  if(empty($type_array[2]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">确认帐号</div>
                <div class="fui-cell-info"><input type="text" id="alipay1" name="alipay1" class='fui-input' value="<?php  echo $last_data['alipay'];?>" max="25"/></div>
            </div>
            <?php  } ?>

            <?php  if(!empty($type_array['3'])) { ?>
            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;"><span class="re-g">选择银行</span></div>
                <div class="fui-cell-info">

                    <select id="bankname">
                        <?php  if(is_array($banklist)) { foreach($banklist as $key => $value) { ?>
                        <option value="<?php  echo $bankname;?>" <?php  if(!empty($last_data) && $last_data['bankname'] == $value['bankname']) { ?>selected<?php  } ?>><?php  echo $value['bankname'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="fui-cell-remark"></div>
            </div>

            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">银行卡号</div>
                <div class="fui-cell-info"><input type="text" id="bankcard" name="bankcard" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
            </div>

            <div class="fui-cell bank-group" <?php  if(empty($type_array[3]['checked'])) { ?>style="display: none;"<?php  } ?>>
                <div class="fui-cell-label" style="width: 120px;">确认卡号</div>
                <div class="fui-cell-info"><input type="text" id="bankcard1" name="bankcard1`" class='fui-input' value="<?php  echo $last_data['bankcard'];?>" max="25"/></div>
            </div>
            <?php  } ?>

        </div>

        <a class='btn btn-success block btn-submit <?php  if(!$cansettle) { ?>disabled<?php  } ?>' data-type="1">提交</a>


    </div>
    <script type="text/javascript" src="../addons/ewei_shopv2/plugin/merchmanage/static/js/init.js?v=<?php  echo time()?>"></script>
    <script language='javascript'>
        require(['../addons/ewei_shopv2/plugin/merchmanage/static/js/apply.js'], function (modal) {
            modal.init();
        });
    </script>
</div>


<?php defined('IN_IA') or exit('Access Denied');?><div class="region-goods-details row">
    <div class="region-goods-left col-sm-2">团队分红</div>
    <div class="region-goods-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">是否参与团队分红</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                <label class="radio-inline">
                    <input type="radio"  value="0" name="no_dividend" <?php  if($item['no_dividend']==0) { ?>checked<?php  } ?> /> 参与团队分红
                </label>
                <label class="radio-inline">
                    <input type="radio"  value="1" name="no_dividend" <?php  if($item['no_dividend']==1) { ?>checked<?php  } ?> /> 不参与团队分红
                </label>
                <span class="help-block">如果不参与分销，则不产生团队分红</span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  if($item['no_dividend']==1) { ?>不参与团队分红<?php  } else { ?>参与团队分红<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>

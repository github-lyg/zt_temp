<?php defined('IN_IA') or exit('Access Denied');?><div class="region-goods-details row">
    <div class="region-goods-left col-sm-2" >自定义模板</div>
    <div class="region-goods-right col-sm-10">
        <div class="alert alert-danger">提示：如果系统设置详情页模板，商品也设置，则商品的优先级高于系统的。</div>

        <div class="form-group">
            <label class="col-sm-2 control-label">自定义模板</label>
            <div class="col-sm-9 col-xs-12">
                <select class="form-control" name="diypage">
                    <option value="">请选择商品详情页自定义模板</option>
                    <?php  if(is_array($detailPages)) { foreach($detailPages as $detailPage) { ?>
                    <option value="<?php  echo $detailPage['id'];?>" <?php  if($item['diypage']==$detailPage['id']) { ?>selected="selected"<?php  } ?>><?php  echo $detailPage['name'];?></option>
                    <?php  } } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<!--OTEzNzAyMDIzNTAzMjQyOTE0-->
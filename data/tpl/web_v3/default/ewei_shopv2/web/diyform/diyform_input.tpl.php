<?php defined('IN_IA') or exit('Access Denied');?>
<script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/area/cascade.js"></script>

<?php $field_data_name = empty($field_data_name)?'field_data':$field_data_name?>
<?php  $i=0;?>
<?php  if(is_array($fields)) { foreach($fields as $k1 => $v1) { ?>
<div class="form-group">
    <label class="col-sm-2 control-label <?php  if($v1['tp_must'] == 1) { ?>must<?php  } ?>"><?php  echo $v1['tp_name'];?></label>
    <div class="col-sm-9 col-xs-12">

        <?php  if($v1['data_type'] == 0) { ?>
        <input type="text" class='form-control'
               name='<?php  echo $field_data_name;?><?php  echo $i?>'
               placeholder="<?php  if(!empty($v1['placeholder'])) { ?><?php  echo $v1['placeholder'];?><?php  } else { ?>请输入<?php  echo $v1['tp_name'];?><?php  } ?>"
               value="<?php  echo $f_data[$k1]?>"
               <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        />
        <?php  } else if($v1['data_type']==1) { ?>

              <textarea class="form-control" id='<?php  echo $field_data_name;?><?php  echo $i?>' name='<?php  echo $field_data_name;?><?php  echo $i?>'
                        placeholder="<?php  if(!empty($v1['placeholder'])) { ?><?php  echo $v1['placeholder'];?><?php  } else { ?>请输入<?php  echo $v1['tp_name'];?><?php  } ?>"
                        <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        ><?php  echo $f_data[$k1]?></textarea>

        <?php  } else if($v1['data_type']==2) { ?>

        <select id='<?php  echo $field_data_name;?><?php  echo $i?>' name='<?php  echo $field_data_name;?><?php  echo $i?>' class="form-control"  <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>>
        <option value=''>请选择<?php  echo $v1['tp_name'];?></option>
        <?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?>
        <option value="<?php  echo $v2?>" <?php  if($f_data[$k1] == $v2) { ?>selected<?php  } ?>><?php  echo $v2?></option>
        <?php  } } ?>
        </select>

        <?php  } else if($v1['data_type']==3) { ?>
        <?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?>
        <label class="checkbox-inline">
            <input type="checkbox" name='<?php  echo $field_data_name;?><?php  echo $i?>[]' <?php  if(is_array($f_data[$k1]) &&  in_array($v2, $f_data[$k1])) { ?>checked<?php  } ?> value="<?php  echo $v2?>"/> <?php  echo $v2?>
        </label>
        <?php  } } ?>
        <?php  } else if($v1['data_type']==5) { ?>
            <?php  if($_W['plugin']=='merch' && !empty($_W['merchid'])) { ?>
                <?php  echo tpl_form_field_multi_image2($field_data_name.$i, $f_data[$k1],array('dest_dir'=>'merch/'.$_W['merchid']))?>
            <?php  } else { ?>
                <?php  echo tpl_form_field_multi_image2($field_data_name.$i, $f_data[$k1])?>
            <?php  } ?>

        <?php  } else if($v1['data_type']==6) { ?>
        <input type="tel" class='form-control' id='<?php  echo $field_data_name;?><?php  echo $i?>' name='<?php  echo $field_data_name;?><?php  echo $i?>' placeholder="请输入<?php  echo $v1['tp_name'];?>"
               maxlength="18" value="<?php  echo $f_data[$k1]?>"
               <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        />
        <?php  } else if($v1['data_type']==7) { ?>
        <?php  echo tpl_form_field_date($field_data_name.$i,$f_data[$k1])?>

        <?php  } else if($v1['data_type']==8) { ?>
        <?php  echo tpl_form_field_daterange($field_data_name.$i,array('starttime'=>$f_data[$k1]['0'],'endtime'=>$f_data[$k1]['1']))?>
        <?php  } else if($v1['data_type'] == 9) { ?>

        <span><?php echo $f_data[$k1]['province']!='请选择省份'?$f_data[$k1]['province']:''?>-<?php echo $f_data[$k1]['city']!='请选择城市'?$f_data[$k1]['city']:''?><?php  if(!empty($f_data[$k1]['area'])) { ?>-<?php  echo $f_data[$k1]['area']?><?php  } ?></span>
        <br/><br/>
        <select id="sel-provance<?php  echo $i;?>" name='<?php  echo $field_data_name;?>_province<?php  echo $i;?>' onchange="selectCity('<?php  echo $i;?>');" class="form-control" style='width:150px;display: inline-block' >
            <option value="" selected="true">请选择省份</option>
        </select>
        <select id="sel-city<?php  echo $i;?>" name='<?php  echo $field_data_name;?>_city<?php  echo $i;?>'  onchange="selectcounty(0,0,'<?php  echo $i;?>')" class="form-control" style='width:150px;display: inline-block' >
            <option value="" selected="true">请选择城市</option>
        </select>
        <select id="sel-area<?php  echo $i;?>" name='<?php  echo $field_data_name;?>_area<?php  echo $i;?>'  class="form-control" style='width:150px;display: inline-block;<?php  if(empty($f_data[$k1]['area'])) { ?>display:none;<?php  } ?>' >
            <option value="" selected="true">请选择</option>
        </select>
        <script language='javascript'>
            cascdeInit("<?php  echo $new_area?>","0","<?php echo isset($f_data[$k1]['province'])?$f_data[$k1]['province']:''?>","<?php echo  isset($f_data[$k1]['city'])?$f_data[$k1]['city']:''?>","<?php echo  isset($f_data[$k1]['area'])?$f_data[$k1]['area']:''?>","",'<?php  echo $i;?>');
        </script>

        <?php  } else if($v1['data_type']==11) { ?>
        <input type="text" class='form-control'
               name='<?php  echo $field_data_name;?><?php  echo $i?>'
               placeholder="<?php  if(!empty($v1['placeholder'])) { ?><?php  echo $v1['placeholder'];?><?php  } else { ?>请输入<?php  echo $v1['tp_name'];?><?php  } ?>"
               value="<?php  echo $f_data[$k1]?>"
               style="width: 130px;"
               <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        />
        <?php  } else if($v1['data_type']==12) { ?>
        <input type="text" class='form-control'
               name='<?php  echo $field_data_name;?><?php  echo $i?>[]'
               value="<?php  echo $f_data[$k1]['0']?>"
               style="width: 130px;display: inline-block;"
               <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        />
        <input type="text" class='form-control'
               name='<?php  echo $field_data_name;?><?php  echo $i?>[]'
               value="<?php  echo $f_data[$k1]['1']?>"
               style="width: 130px;display: inline-block;"
               <?php  if($v1['tp_must'] == 1) { ?>data-rule-required='true'<?php  } ?>
        />
        <?php  } else if($v1['data_type']==14) { ?>
            <?php  if(is_array($v1['tp_text'])) { foreach($v1['tp_text'] as $k2 => $v2) { ?>
            <label class="checkbox-inline">
                <input type="radio" name='<?php  echo $field_data_name;?><?php  echo $i?>[]' <?php  if(trim($v2)==trim($f_data[$k1])) { ?>checked<?php  } ?> value="<?php  echo $v2?>"/> <?php  echo $v2?>
            </label>
            <?php  } } ?>
        <?php  } ?>
    </div>
</div>
<?php  $i++?>
<?php  } } ?>

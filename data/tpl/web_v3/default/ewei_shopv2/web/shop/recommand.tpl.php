<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">商品推荐</span>
    <?php if(cv('shop.recommand.setstyle')) { ?>
	    	<span class="pull-right">
                <strong>开启列表样式</strong>
                <input class="js-switch small" id="goodsstyle" type="checkbox" <?php  if(!empty($goodsstyle)) { ?>checked<?php  } ?>
                    data-toggle='ajaxSwitch'
                    data-switch-value='<?php  echo $goodsstyle;?>'
                    data-switch-value0='0|0|0|<?php  echo webUrl('shop/recommand/setstyle',array('goodsstyle'=>1))?>'
                    data-switch-value1='1|0|0|<?php  echo webUrl('shop/recommand/setstyle',array('goodsstyle'=>0))?>'  />
            </span>
    <?php  } ?>
</div>

<div class="page-content">
    <form action="" method="post" class="form-validate">
        <?php if(cv('shop.recommand.main')) { ?>
            <div class="alert alert-primary">提示: 请在下方选择要显示的商品; 不选择则将不显示; 右上角开启列表显示则使用列表样式，不开启则使用默认方块样式显示。</div>
        <?php  } ?>
        <div class="form-group" style="height: auto; overflow:hidden;">
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('shop.recommand.main')) { ?>
                <div class="input-group">
                    <input type="text" id="goodsid_text" name="goodsid_text" value="" class="form-control text" readonly="">
                    <div class="input-group-btn">
                        <button class="btn btn-primary select_goods" type="button">选择商品</button>
                    </div>
                </div>
                <div class="input-group multi-img-details container ui-sortable goods_show">
                    <?php  if(!empty($goods)) { ?>
                    <?php  if(is_array($goods)) { foreach($goods as $g) { ?>
                    <div class="multi-item" data-id="<?php  echo $g['id'];?>" data-name="goodsid" id="<?php  echo $g['id'];?>">
                        <img class="img-responsive img-thumbnail" src="<?php  echo tomedia($g['thumb'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" style="width:100px;height:100px;">
                        <div class="img-nickname"><?php  echo $g['title'];?></div>
                        <input type="hidden" value="<?php  echo $g['id'];?>" name="goodsid[]">
                        <em onclick="removeHtml(<?php  echo $g['id'];?>)" class="close">×</em>
                        <div style="clear:both;"></div>
                    </div>
                    <?php  } } ?>
                    <?php  } ?>
                </div>
                <script>
                    $(function(){
                        var title = '';
                        $('.img-nickname').each(function(){
                            title += $(this).html()+';';
                        });
                        $('#goodsid_text').val(title);
                    })
                    myrequire(['web/goods_selector'],function (Gselector) {
                        $('.select_goods').click(function () {
                            var ids = select_goods_ids();
                            Gselector.open('goods_show','',0,true,'',ids);
                        });
                    })
                    function goods_show(data) {
//                        console.log(data);
                        if(data.act == 1){
                            var html = '<div class="multi-item" data-id="'+data.id+'" data-name="goodsid" id="'+data.id+'">'
                                +'<img class="img-responsive img-thumbnail" src="'+data.thumb+'" onerror="this.src=\'../addons/ewei_shopv2/static/images/nopic.png\'" style="width:100px;height:100px;">'
                                +'<div class="img-nickname">'+data.title+'</div>'
                                +'<input type="hidden" value="'+data.id+'" name="goodsid[]">'
                                +'<em onclick="removeHtml('+data.id+')" class="close">×</em>'
                                +'</div>';

                            $('.goods_show').append(html);
                            var title = '';
                            $('.img-nickname').each(function(){
                                title += $(this).html()+';';
                            });
                            $('#goodsid_text').val(title);
                        }else if(data.act == 0){
                                removeHtml(data.id);
                        }

                    }
                    function removeHtml(id){
                        $("[id='"+id+"']").remove();
                        var title = '';
                        $('.img-nickname').each(function(){
                            title += $(this).html()+';';
                        });
                        $('#goodsid_text').val(title);
                    }
                    function select_goods_ids(){
                        var goodsids = [];
                        $(".multi-item").each(function(){
                            goodsids.push($(this).attr('data-id'));
                        });
                        return goodsids;
                    }
                </script>
                <?php  } else { ?>
                    <div class="input-group multi-img-details container ui-sortable">
                        <?php  if(is_array($goods)) { foreach($goods as $item) { ?>
                            <div data-name="goodsid" data-id="<?php  echo $item['id'];?>" class="multi-item">
                                <img src="<?php  echo tomedia($item['thumb'])?>" class="img-responsive img-thumbnail">
                                <div class="img-nickname"><?php  echo $item['title'];?></div>
                            </div>
                        <?php  } } ?>
                    </div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group" style="height: auto; overflow: hidden;">
            <div class="col-sm-9 col-xs-12">
                <?php if(cv('shop.recommand.main')) { ?>
                    <input type="submit" class="btn btn-primary" value="保存">
                <?php  } ?>
            </div>
        </div>
</form>
</div>
<script language="javascript">
    require(['jquery.ui'],function(){
        $('.multi-img-details').sortable();
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


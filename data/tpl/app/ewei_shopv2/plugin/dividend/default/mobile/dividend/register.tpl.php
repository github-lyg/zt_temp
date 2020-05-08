<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<script>document.title = "<?php  echo $page_title;?>";</script>

<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/plugin/dividend/template/mobile/default/static/css/common.css">

<div class="fui-page fui-page-current page-commission-register">

    <div class="fui-header">

        <div class="fui-header-left">

            <a class="back"></a>

        </div>

        <div class="title">申请<?php  echo $set['texts']['become'];?></div>

        <div class="fui-header-right"></div>

    </div>



    <div class="fui-content">

        <img style='width:100%;position: relative' src="<?php  if(empty($set['regbg'])) { ?>../addons/ewei_shopv2/plugin/dividend/template/mobile/default/static/images/banner.jpg<?php  } else { ?><?php  echo tomedia($set['regbg'])?><?php  } ?>" />

        <?php  if($set['condition']==1 && $status==0 && $member['isheads']==0) { ?>

        <div class="fui-list-group">

            <div class="fui-list-group-title"><i class="icon icon-lights"></i> 友情提醒</div>

            <div class="fui-list">

                <div class="fui-list-inner">

                    <div class="text">本店累计招募一级下线 <span style="color: #cfa943;" class=" text-bold"><?php  echo $member_totalcount;?></span> 人，

                        才可成为&lt;<span style="color: #cfa943;" class=" text-bold"><?php  echo $_W['shopset']['shop']['name'];?></span>&gt;购物中心团队<?php  echo $this->set['texts']['dividend']?>队长，您已招募了 <span style="color: #cfa943; " class=" text-bold"><?php  echo $member_count;?></span>人，请继续努力！</div>

                </div>

            </div>

        </div>

        <a class="btn  block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl('commission')?>">继续去招募</a>

        <?php  } ?>



        <?php  if($set['condition']==2 && $status==0 && $member['isheads']==0) { ?>

        <div class="fui-list-group">

            <div class="fui-list-group-title"><i class="icon icon-lights"></i> 友情提醒</div>

            <div class="fui-list">

                <div class="fui-list-inner">

                    <div class="text">本店累计招募一级下线分销商 <span style="color: #cfa943;" class=" text-bold"><?php  echo $commissiondownline_totalcount;?></span> 人，

                        才可成为&lt;<span style="color: #cfa943;" class=" text-bold"><?php  echo $_W['shopset']['shop']['name'];?></span>&gt;购物中心团队<?php  echo $this->set['texts']['dividend']?>队长，您已有 <span style="color: #cfa943; " class=" text-bold"><?php  echo $commissiondownline_count;?></span> 一级下线成为分销商，请继续努力！</div>

                </div>

            </div>

        </div>

        <a class="btn  block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl('commission')?>">继续去招募</a>

        <?php  } ?>



        <?php  if($set['condition']==3 && $status==0 && $member['isheads']==0) { ?>

        <div class="fui-list-group">

            <div class="fui-list-group-title"><i class="icon icon-lights"></i> 友情提醒</div>

            <div class="fui-list">

                <div class="fui-list-inner">

                    <div class="text">本店累计佣金总额为 <span style="color: #cfa943;" class=" text-bold"><?php  echo $total_commission_totalcount;?></span> <?php  echo $this->set['texts']['yuan']?>，

                        才可成为&lt;<span style="color: #cfa943;" class=" text-bold"><?php  echo $_W['shopset']['shop']['name'];?></span>&gt;购物中心团队<?php  echo $this->set['texts']['dividend']?>队长，您已拥有 <span style="color: #cfa943; " class=" text-bold"><?php  echo $totalcommissioncount;?></span> <?php  echo $this->set['texts']['yuan']?>佣金，请继续努力！</div>

                </div>

            </div>

        </div>

        <a class="btn  block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl('commission')?>">继续去招募</a>

        <?php  } ?>

        <?php  if($set['condition']==4 && $status==0 && $member['isheads']==0) { ?>

        <div class="fui-list-group">

            <div class="fui-list-group-title"><i class="icon icon-lights"></i> 友情提醒</div>

            <div class="fui-list">

                <div class="fui-list-inner">

                    <div class="text">本店累计<?php  echo $this->set['texts']['withdraw']?>佣金 <span style="color: #cfa943;" class=" text-bold"><?php  echo $cash_commission_totalcount;?></span> <?php  echo $this->set['texts']['yuan']?>，

                        才可成为&lt;<span style="color: #cfa943;" class=" text-bold"><?php  echo $_W['shopset']['shop']['name'];?></span>&gt;购物中心团队<?php  echo $this->set['texts']['dividend']?>队长，您已<?php  echo $this->set['texts']['withdraw']?> <span style="color: #cfa943; " class=" text-bold"><?php  echo $cash_commission_count;?></span> <?php  echo $this->set['texts']['yuan']?>佣金，请继续努力！</div>

                </div>

            </div>

        </div>

        <a class="btn  block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl('commission')?>">继续去招募</a>

        <?php  } ?>



        <?php  if($member['headsstatus']==1 && $member['isheads']==1) { ?>

        <div class='content-info'>

            <i class='icon icon-roundcheck text-success'></i>

            <br/><span class="text-success">您的申请已经审核通过！</span>

            <br/><a class="btn block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl()?>">去商城逛逛</a>

        </div>

        <?php  } ?>

        <?php  if($member['headsstatus']==0 && $member['isheads']==1) { ?>

        <div class='content-info' >

            <i class='icon icon-time'></i>

            <br/><span class="">谢谢您的支持，请等待审核！</span>

            <br/><a class="btn block" style="background: #1b1a20; color: #cfa943; border-color: #1b1a20;" href="<?php  echo mobileUrl()?>">去商城逛逛</a>

        </div>

        <?php  } ?>



        <?php  if(empty($member['headsstatus']) &&  empty($member['isheads']) && $set['condition']==0) { ?>

        <div class="fui-cell-group">

            <div class='welcome'>欢迎加入<span><?php  echo $set['texts']['center'];?></span>，请填写申请信息</div>





            <?php  if($template_flag) { ?>



            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('diyform/formfields', TEMPLATE_INCLUDEPATH)) : (include template('diyform/formfields', TEMPLATE_INCLUDEPATH));?>



            <?php  } else { ?>

            <div class='applymsg'>

                <div class='flex msgitem'>

                    <div>姓名</div>

                    <input class="text" type='text'  name="realname"  id="realname" value="<?php  echo $member['realname'];?>" placeholder='请填写真实姓名，用于结算' placeholder-style="color:#ccc"/>

                </div>

                <div class='flex msgitem'>

                    <div>手机号</div>

                    <input  class="text" type='number' name="mobile" id="mobile" value="<?php  echo $member['mobile'];?>" placeholder='请填写手机号' placeholder-style="color:#ccc"/>

                </div>

                <?php  } ?>

                <?php  if($set['open_protocol'] == 1) { ?>

                <div class='flex msgitem' style='border: none'>

                    <div>我已阅读并了解<span class="look" style="color: #cfa943;">【<?php  echo $set['applytitle'];?>】</span></div>

                    <input class="consent"  id="agree" type="checkbox" checked="checked">

                </div>

                <?php  } ?>

            </div>

            <div class="agreebtn btn-submit" >申请<?php  echo $set['texts']['become'];?></div>

            <?php  if($set['register_bottom'] == 0) { ?>

            <div class='specialadvan'>

                <div class='specialitem'>

                    <icon class='icon icon-tequan' style="margin-right: 0.3rem;color: #cfa943;"></icon>

                    <span><?php  echo $set['texts']['agent']?>特权</span>

                </div>

                <div class='flex'>

                    <icon class='icon icon-yishenqingyongjin' style="margin-right: 0.3rem;color: #cfa943;"></icon>

                    <div>

                        <div>销售拿<?php  echo $this->set['texts']['dividend']?></div>

                        <div class='smallfont'>成为<?php  echo $set['texts']['agent']?>后卖出商品，您可以获得<?php  echo $this->set['texts']['dividend']?></div>

                    </div>

                </div>

            </div>

            <?php  } else if($set['register_bottom'] == 1) { ?>

            <div class='specialadvan'>

                <div class='flex'>

                    <icon class='icon icon-tequan' style="margin-right: 0.3rem;color: #cfa943;"></icon>

                    <div>

                        <div class='subtitle'><?php  echo $set['register_bottom_title1'];?></div>

                        <div class='text'><?php  echo $set['register_bottom_content1'];?></div>

                    </div>

                </div>

                <div class='flex'>

                    <icon class='icon icon-yishenqingyongjin' style="margin-right: 0.3rem;color: #cfa943;"></icon>

                    <div>

                        <div class='subtitle'><?php  echo $set['register_bottom_title2'];?></div>

                        <div class='text'><?php  echo $set['register_bottom_content2'];?></div>

                    </div>

                </div>

            </div>

            <?php  } else if($set['register_bottom'] == 2) { ?>

            <div class='specialadvan'>

                <div class="row">

                    <?php  echo $set['register_bottom_content'];?>

                </div>

            </div>

            <?php  } ?>

        </div>

        <?php  } ?>

    </div>





    <div class="fui-modal1 popup-modal" >

        <div class="inner-con">

            <div class="qrcode">

                <div class="inner1">

                    <div class="title"><?php  echo $set['applytitle'];?></div>

                    <div class="text"><?php  echo $set['applycontent'];?></div>

                </div>

                <div class="inner-btn" style="padding: 0.5rem;">

                    <div class="btn btn-danger" style="width: 100%; margin: 0;">我已阅读</div>

                </div>

            </div>

        </div>

        <div class="close"><i class="icon icon-roundclose"></i></div>

    </div>



    <script language="javascript">

        require(['../addons/ewei_shopv2/plugin/dividend/static/js/register.js'], function (modal) {

            modal.init("<?php  echo $mid;?>",<?php  echo json_encode($apply_set)?>);



        })

        $(function () {

            //协议弹窗

            $('.look').click(function(){

                $(".fui-modal1.popup-modal").css('display', 'block')

            })

            $('.close').click(function(){

                $(".fui-modal1.popup-modal").css('display', 'none')

            })

            $('.inner-btn').click(function(){

                $(".fui-modal1.popup-modal").css('display', 'none')

            })

        })

    </script>



</div>

</div>




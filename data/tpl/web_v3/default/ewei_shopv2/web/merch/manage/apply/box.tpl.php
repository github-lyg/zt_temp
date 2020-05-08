<?php defined('IN_IA') or exit('Access Denied');?><style>
    h2{
        padding: 30px;
    }
</style>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">申请的金额(抽成后)</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins yesterday-count text-danger"><span id="bonusmoney_pay"><?php  echo $item['realpricerate'];?></span> 元</h2>
                    <small>抽成前的金额: <?php  echo $item['realprice'];?> 元</small>
                </div >
            </div>
        </div>
    </div>

    <?php  if($status > 1) { ?>
    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">通过申请的金额(抽成后)</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins yesterday-count text-danger"><span id="passbonusmoney_pay"><?php  echo $item['passrealpricerate'];?></span> 元</h2>
                    <small>抽成前的金额: <?php  echo $item['passrealprice'];?> 元</small>
                </div >
            </div>
        </div>
    </div>
    <?php  } ?>

    <?php  if($item['status']==3) { ?>
    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">实际打款金额</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins today-count text-danger"><?php  echo $item['finalprice'];?> 元</h2>
                </div >
            </div>
        </div>
    </div>
    <?php  } ?>
    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">申请的订单金额</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins today-count text-danger"><?php  echo $item['orderprice'];?> 元</h2>
                    <small>订单个数: <?php  echo $item['ordernum'];?> 个</small>
                </div >
            </div>
        </div>
    </div>

    <?php  if($status > 1) { ?>
    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">通过申请的订单金额</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins today-count text-danger"><?php  echo $item['passorderprice'];?> 元</h2>
                    <small>订单个数: <?php  echo $item['passordernum'];?> 个</small>
                </div >
            </div>
        </div>
    </div>
    <?php  } ?>

    <div class="col-md-4 col-sm-4">
        <div class="summary_box float-e-margins" style="border: 1px solid #e7eaec">
            <div class="summary_title">
                <span class="text-default title_inner">抽成比例</span>
            </div>
            <div class="summary flex">
                <div class="flex1 flex column">
                    <h2 class="no-margins today-count "><?php  echo $item['payrate'];?> %</h2>
                </div >
            </div>
        </div>
    </div>

</div>
<!--913702023503242914-->
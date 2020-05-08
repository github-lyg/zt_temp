<?php defined('IN_IA') or exit('Access Denied');?><div class="fui-cell-group fui-cell-click transparent" style="margin-top: <?php  echo $diyitem['style']['margintop'];?>px;">
    <a class="fui-cell external changepwd" href="<?php  echo $diyitem['params']['bindurl'];?>">
        <div class="fui-cell-text" style="text-align: center; color: <?php  echo $diyitem['style']['maincolor'];?>;border-color: <?php  echo $diyitem['style']['maincolor'];?>;background: <?php  echo $diyitem['style']['subcolor'];?>"><p>修改密码</p></div>
    </a>
    <a class="fui-cell external btn-logout" href="<?php  echo $diyitem['params']['logouturl'];?>">
        <div class="fui-cell-text" style="text-align: center; color:<?php  echo $diyitem['style']['subcolor'];?>;background:<?php  echo $diyitem['style']['maincolor'];?>"><p>退出登录</p></div>
    </a>
</div>
<!--4000097827-->
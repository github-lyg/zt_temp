<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:850px;'>
<table class="table table-hover" style="min-width:850px;">
    <tbody>   
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
            <td><img src='<?php  echo tomedia($row['avatar'])?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' /> <?php  echo $row['nickname'];?></td>
            <td><?php  echo $row['realname'];?></td>
            <td><?php  echo $row['mobile'];?></td>
            <td style="width:80px;"><a href="javascript:;" onclick='biz.selector.set(this,<?php  echo json_encode($row);?>)'>选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr> 
            <td colspan='4' align='center'>未找到会员</td>
        </tr>
        <?php  } ?>
    </tbody>
</table>
    </div>
<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+454mI5p2D5omA5pyJ-->
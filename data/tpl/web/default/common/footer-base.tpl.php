<?php defined('IN_IA') or exit('Access Denied');?></div>
	<div class="container-fluid footer text-center" role="footer">	
		<div class="friend-link">
			<?php  if(empty($_W['setting']['copyright']['footerright'])) { ?>
				<a href="http://www.myxiangyun.com">祥云网络科技</a>
				
			<?php  } else { ?>
				<?php  echo $_W['setting']['copyright']['footerright'];?>
			<?php  } ?>
		</div>
		<div class="copyright">我们的使命：为客户提供最有价值的创业平台，用真心服务好每一个客户</div>
	</div>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
	<?php  if(!empty($_GPC['m']) && !in_array($_GPC['m'], array('keyword', 'special', 'welcome', 'default', 'userapi')) || defined('IN_MODULE')) { ?>
	<script>
		if(typeof $.fn.tooltip != 'function' || typeof $.fn.tab != 'function' || typeof $.fn.modal != 'function' || typeof $.fn.dropdown != 'function') {
			require(['bootstrap']);
		}
	</script>
	<?php  } ?>
	</div>
	
		<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/index.php?c=utility&a=visit&do=showjs&type=<?php echo FRAME;?>"></script>
	
</body>
</html>
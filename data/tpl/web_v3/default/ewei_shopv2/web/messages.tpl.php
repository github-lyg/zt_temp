<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
	当前位置：<span class="text-primary">消息群发任务 </span>
</div>

<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal" role="form">
	<input type="hidden" name="c" value="site" />
	<input type="hidden" name="a" value="entry" />
	<input type="hidden" name="m" value="ewei_shopv2" />
	<input type="hidden" name="do" value="web" />
	<input type="hidden" name="r"  value="messages" />

	<div class="page-toolbar m-b-sm m-t-sm">
		<div class="col-sm-6">
			<span class="">
				<?php if(cv('messages.add')) { ?>
				<a class='btn btn-primary btn-sm' href="<?php  echo webUrl('messages/add')?>"><i class="fa fa-plus"></i> 添加任务</a>
				<?php  } ?>
			</span>
		</div>
		<div class="col-sm-6 pull-right">
			<div class="input-group">				 
				<input type="text" class="form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">

					<button class="btn btn-primary" type="submit"> 搜索</button> </span>
			</div>
		</div>
	</div>
</form>

<?php  if(count($list)>0) { ?>

<form action="" method="post" >

	<table class="table table-hover table-responsive">
		<thead>
			<tr>
				<th>任务名称</th>
				<th>发送条数/未发送数/成功数/失败数</th>
				<th>状态</th>
				<th style="width: 160px;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<tr>
				<td><?php  echo $row['title'];?></td>
				<td><?php  echo $row['num'];?>/<?php  echo $row['nosend'];?>/<?php  echo $row['sendsuccess'];?>/<?php  echo $row['sendfail'];?></td>
				<td><?php  echo $row['statustext'];?></td>

				<td  style="overflow:visible;">
							<?php if(cv('messages.run')) { ?>
							<a  class="btn btn-default btn-op btn-operation"   data-toggle="ajaxRemove"  href="<?php  echo webUrl('messages/build', array('id' => $row['id']))?>">
								<span data-toggle="tooltip" data-placement="top" title="" data-original-title="生成发送列表">
                                        <i class='icow icow-tianjia'></i>
                                   </span>
							</a>
							<?php  } ?>
							<?php if(cv('messages.run')) { ?>
							<a class="btn btn-default btn-op btn-operation" href="<?php  echo webUrl('messages/run', array('id' => $row['id']))?>">
								<span data-toggle="tooltip" data-placement="top" title="" data-original-title="开始发送">
                                        <i class='icow icow-kaishi1'></i>
                                   </span>
							</a>
							<?php  } ?>
							<?php if(cv('messages.edit|messages.view')) { ?>
							<a class="btn btn-default btn-op btn-operation" data-toggle="ajaxRemove" href="<?php  echo webUrl('messages/reset', array('id' => $row['id']))?>">
								<span data-toggle="tooltip" data-placement="top" title="" data-original-title="重置发送">
                                        <i class='icow icow-refurbish'></i>
                                   </span>
							</a>
							<?php  } ?>
							<?php if(cv('messages.edit|messages.view')) { ?>
							<a class="btn btn-default btn-op btn-operation" href="<?php  echo webUrl('messages/edit', array( 'id' => $row['id']))?>">
								 <span data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(cv('messages.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>">
                                   <?php if(cv('messages.edit')) { ?>
                                    <i class="icow icow-bianji2"></i>
                                     <?php  } else { ?>
                                     <i class="icow icow-chakan-copy"></i>
                                     <?php  } ?>
                                 </span>
							</a>
							<?php  } ?>
							<?php if(cv('messages.delete')) { ?>
							<a class="btn btn-default btn-op btn-operation" data-toggle="ajaxRemove"  href="<?php  echo webUrl('messages/delete', array('id' => $row['id']))?>"  title='删除' data-confirm="确认删除此任务吗？">
								<span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                                        <i class='icow icow-shanchu1'></i>
                                   </span>
							</a>
							<?php  } ?>
							<?php if(cv('messages.view')) { ?>
							<a class="btn btn-default btn-op btn-operation" href="<?php  echo webUrl('messages/showsign', array( 'id' => $row['id']))?>">
								<span data-toggle="tooltip" data-placement="top" title="" data-original-title="查看发送日志">
                                        <i class='icow icow-chakan-copy'></i>
                                   </span>
							</a>
							<?php  } ?>
				</td>
			</tr>
			<?php  } } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right">	<?php  echo $pager;?>  </td>
			</tr>
		</tfoot>
	</table>
	<?php  } else { ?>
	<div class='panel panel-default'>
		<div class='panel-body' style='text-align: center;padding:30px;'>
			暂时没有任何任务!
		</div>
	</div>
	<?php  } ?>
</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

<!--913702023503242914-->
<div id="main"><div class="block" id="block-tables">
<h2 class="title"><?php __('Tags');?></h2>
<div class="content">
<div class="inner">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0" class="table">
<tr>
	<th class="first"><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('tag');?></th>
	<th class="last"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tags as $tag):
	$class = ' class="odd"';
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tag['Tag']['id']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['tag']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $tag['Tag']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $tag['Tag']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $tag['Tag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table><div class="actions-bar">
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array('tag' => 'span'), null, array('tag' => 'span', 'class'=>'disabled'));?>
	<?php echo $paginator->numbers(array('separator' => null));?>
	<?php echo $paginator->next(__('next', true).' >>', array('tag' => 'span'), null, array('tag' => 'span', 'class'=>'disabled'));?>
</div><div class="clear"></div></div></div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
	<ul class="navigation">
		<li><?php echo $html->link(__('New Tag', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div>
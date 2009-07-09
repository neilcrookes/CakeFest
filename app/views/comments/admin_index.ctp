<div id="main"><div class="block" id="block-tables">
<h2 class="title"><?php __('Comments');?></h2>
<div class="content">
<div class="inner">
<?php echo $this->element('admin_pagination_count'); ?><table cellpadding="0" cellspacing="0" class="table">
<tr>
	<th class="first"><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('post_id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('website');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
	<th><?php echo $paginator->sort('active');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="last"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($comments as $comment):
	$class = ' class="odd"';
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $comment['Comment']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($comment['Post']['title'], array('controller'=> 'posts', 'action'=>'view', $comment['Post']['id'])); ?>
		</td>
		<td>
			<?php echo $comment['Comment']['name']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['email']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['website']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['comment']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['active']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['created']; ?>
		</td>
		<td>
			<?php echo $comment['Comment']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $comment['Comment']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $comment['Comment']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table><div class="actions-bar">
<?php echo $this->element('admin_pagination_links'); ?><div class="clear"></div></div></div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
	<ul class="navigation">
		<li><?php echo $html->link(__('New Comment', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div>
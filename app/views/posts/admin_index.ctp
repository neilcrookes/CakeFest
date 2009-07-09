<div id="main"><div class="block" id="block-tables">
<h2 class="title"><?php __('Posts');?></h2>
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
	<th><?php echo $paginator->sort('category_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('slug');?></th>
	<th><?php echo $paginator->sort('abstract');?></th>
	<th><?php echo $paginator->sort('body');?></th>
	<th><?php echo $paginator->sort('comment_count');?></th>
	<th><?php echo $paginator->sort('active');?></th>
	<th><?php echo $paginator->sort('published');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="last"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($posts as $post):
	$class = ' class="odd"';
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $post['Post']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($post['Category']['name'], array('controller'=> 'categories', 'action'=>'view', $post['Category']['id'])); ?>
		</td>
		<td>
			<?php echo $post['Post']['title']; ?>
		</td>
		<td>
			<?php echo $post['Post']['slug']; ?>
		</td>
		<td>
			<?php echo $post['Post']['abstract']; ?>
		</td>
		<td>
			<?php echo $post['Post']['body']; ?>
		</td>
		<td>
			<?php echo $post['Post']['comment_count']; ?>
		</td>
		<td>
			<?php echo $post['Post']['active']; ?>
		</td>
		<td>
			<?php echo $post['Post']['published']; ?>
		</td>
		<td>
			<?php echo $post['Post']['created']; ?>
		</td>
		<td>
			<?php echo $post['Post']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $post['Post']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $post['Post']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?>
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
		<li><?php echo $html->link(__('New Post', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Categories', true), array('controller'=> 'categories', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Category', true), array('controller'=> 'categories', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Comments', true), array('controller'=> 'comments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'comments', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tags', true), array('controller'=> 'tags', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Tag', true), array('controller'=> 'tags', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div>
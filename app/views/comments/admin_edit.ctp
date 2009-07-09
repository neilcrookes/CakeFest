<div id="main"><div class="block" id="block-forms">
<h2 class="title"><?php __('Edit Comment');?></h2>
<div class="content">
<div class="inner">
<?php echo $form->create('Comment', array('class' => 'form'));?>
	<?php
		echo $admin->input('id');
		echo $admin->input('post_id');
		echo $admin->input('name');
		echo $admin->input('email');
		echo $admin->input('website');
		echo $admin->input('comment');
		echo $admin->input('active');
	?>
<?php echo $form->end('Submit');?>
</div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
<div class="actions">
	<ul class="navigation">
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comment.id'))); ?></li>
		<li><?php echo $html->link(__('List Comments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div></div>
<div class="comments form">
<?php echo $form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Edit Comment');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('post_id');
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('website');
		echo $form->input('comment');
		echo $form->input('active');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comment.id'))); ?></li>
		<li><?php echo $html->link(__('List Comments', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>

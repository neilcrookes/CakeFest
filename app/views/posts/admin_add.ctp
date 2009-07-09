<div id="main"><div class="block" id="block-forms">
<h2 class="title"><?php __('Add Post');?></h2>
<div class="content">
<div class="inner">
<?php echo $form->create('Post', array('class' => 'form'));?>
	<?php
		echo $admin->input('category_id');
		echo $admin->input('title');
		echo $admin->input('slug');
		echo $admin->input('abstract');
		echo $admin->input('body');
		echo $admin->input('comment_count');
		echo $admin->input('active');
		echo $admin->input('published');
		echo $admin->input('Tag');
	?>
<?php echo $form->end('Submit');?>
</div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
<div class="actions">
	<ul class="navigation">
		<li><?php echo $html->link(__('List Posts', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Categories', true), array('controller'=> 'categories', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Category', true), array('controller'=> 'categories', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Comments', true), array('controller'=> 'comments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comment', true), array('controller'=> 'comments', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tags', true), array('controller'=> 'tags', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Tag', true), array('controller'=> 'tags', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div></div>
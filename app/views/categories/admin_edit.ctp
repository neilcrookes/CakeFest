<div id="main"><div class="block" id="block-forms">
<h2 class="title"><?php __('Edit Category');?></h2>
<div class="content">
<div class="inner">
<?php echo $form->create('Category', array('class' => 'form'));?>
	<?php
		echo $admin->input('id');
		echo $admin->input('parent_id');
		echo $admin->input('lft');
		echo $admin->input('rght');
		echo $admin->input('name');
		echo $admin->input('slug');
		echo $admin->input('direct_child_count');
		echo $admin->input('child_count');
		echo $admin->input('post_count');
		echo $admin->input('active');
	?>
<?php
echo $form->submit(__('Save', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';
echo $form->end(array('name' => 'submit', 'label' => __('Save and Go Back', true), 'class' => 'button', 'div' => false)) . ' or ';
if (isset($previousPage)) echo ' or ' . $html->link(__('Back to '.$previousPage['title'], true), $previousPage['uri']);
?>
</div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
<div class="actions">
	<ul class="navigation">
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Category.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Category.id'))); ?></li>
		<li><?php echo $html->link(__('List Categories', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div></div>
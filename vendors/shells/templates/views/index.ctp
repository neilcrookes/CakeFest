
        <table class="table">
          <tr>
            <th class="first"><input type="checkbox" class="checkbox toggle" /></th>
            <th>ID</th>
            <th>Login</th>
            <th>Name</th>
            <th>Surname</th>
            <th class="last">&nbsp;</th>
          </tr>
          <tr class="odd">
            <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>1</td><td>hulk</td><td>Hulk</td><td>Hogan</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
          </tr>
          <tr class="even">
            <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>2</td><td>ultimate</td><td>Ultimate</td><td>Warrior</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
          </tr>
          <tr class="odd">
            <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>3</td><td>andre</td><td>Andre</td><td>The Giant</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
          </tr>
          <tr class="even">
            <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>4</td><td>machoman</td><td>Macho Man</td><td>Randy Savage</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
          </tr>
        </table>
        <div class="actions-bar">
          <div class="actions">
            <input type="submit" class="button" value="Delete" />
          </div>
          <div class="pagination">
            <span class="disabled prev_page">« Previous</span><span class="current">1</span><a rel="next" href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><a href="#">10</a><a href="#">11</a><a rel="next" class="next_page" href="#">Next »</a>
          </div>
          <div class="clear"></div>
        </div>




      <div id="main">


<div class="block" id="block-tables">
  <h2><?php echo "<?php __('{$pluralHumanName}');?>";?></h2>
  <p>
  <?php echo "<?php
  echo \$paginator->counter(array(
  'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
  ));
  ?>";?>
  </p>
  <div class="content">
    <div class="inner">
      <form action="#" class="form">
<table cellpadding="0" cellspacing="0">
<tr>
<?php  foreach ($fields as $field):?>
	<th><?php echo "<?php echo \$paginator->sort('{$field}');?>";?></th>
<?php endforeach;?>
	<th class="actions"><?php echo "<?php __('Actions');?>";?></th>
</tr>
<?php
echo "<?php
\$i = 0;
foreach (\${$pluralVar} as \${$singularVar}):
	\$class = 'odd';
	if (\$i++ % 2 == 0) {
		\$class = 'even';
	}
?>\n";
	echo "\t<tr class=\"<?php echo \$class;?>\">\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller'=> '{$details['controller']}', 'action'=>'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td>\n\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>\n\t\t</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$html->link(__('View', true), array('action'=>'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
	 	echo "\t\t\t<?php echo \$html->link(__('Edit', true), array('action'=>'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
	 	echo "\t\t\t<?php echo \$html->link(__('Delete', true), array('action'=>'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

echo "<?php endforeach; ?>\n";
?>
</table>
      </form>
    </div>
  </div>
</div>
<div class="paging">
<?php echo "\t<?php echo \$paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>\n";?>
 | <?php echo "\t<?php echo \$paginator->numbers();?>\n"?>
<?php echo "\t<?php echo \$paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>\n";?>
</div>
<div class="actions">
	<ul>
		<li><?php echo "<?php echo \$html->link(__('New {$singularHumanName}', true), array('action'=>'add')); ?>";?></li>
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\t\t<li><?php echo \$html->link(__('List ".Inflector::humanize($details['controller'])."', true), array('controller'=> '{$details['controller']}', 'action'=>'index')); ?> </li>\n";
				echo "\t\t<li><?php echo \$html->link(__('New ".Inflector::humanize(Inflector::underscore($alias))."', true), array('controller'=> '{$details['controller']}', 'action'=>'add')); ?> </li>\n";
				$done[] = $details['controller'];
			}
		}
	}
?>
	</ul>
</div>

      </div>

      <div id="sidebar">
        <div class="block">
          <h3>Sidebar</h3>
          <ul class="navigation">
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
        </div>
        <div class="block">
          <h3>Simple Block</h3>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
      </div>
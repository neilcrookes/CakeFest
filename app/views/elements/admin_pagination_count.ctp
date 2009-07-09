<p>
<?php
//Sets the update and indicator elements by DOM ID
$paginator->options(array('update' => 'content', 'indicator' => 'spinner'));

echo $paginator->counter(array(
  'format' => __('Showing records %start% to %end% of %count%', true)
));
?>
</p>
<p>
<?php
echo $paginator->counter(array(
  'format' => __('Showing records %start% to %end% of %count%', true)
));
?>
</p>
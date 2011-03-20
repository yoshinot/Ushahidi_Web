<?php
/**
 * Mobile pagination style
 * 
 * @preview Previous  1 2 3 5 6 7 8 9 10 11 12 13 14  25 26  Next 
 */
?>

	<?php if ($next_page): ?>
		<a href="<?php echo str_replace('{page}', $next_page, $url) ?>" accesskey="#">[#]次へ</a>
	<?php else: ?>
	<?php endif ?>

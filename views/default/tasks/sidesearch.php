<?php
	$filter = $vars['filter'];
?>

<div class="sidebarBox">

<h3><?php echo $vars['searchtitle'] . ' ' .elgg_echo('tasks:searchtag'); ?></h3>
<form id="taskssearchform" action="<?php echo $vars['url']; ?>mod/tasks/everyone.php?" method="get">
	<input type="text" name="tag" value="<?php echo $tag_string; ?>" onclick="if (this.value=='<?php echo $tag_string; ?>') { this.value='' }" class="search_input" />
	<input type="hidden" name="filter" value="<?php echo $filter; ?>" />	
	<input type="submit" value="<?php echo elgg_echo('search:go'); ?>" />
</form>
</div> 

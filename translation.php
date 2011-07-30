<?php

	/**
	 * Elgg tasks plugin everyone page
	 * 
	 * @package Elggtasks
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 */

	// Start engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		
	// Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
		
	// List tasks
		$area2 = elgg_view_title(elgg_echo('Translation tasks'));
		set_context('search6');
		$area2 .= list_entities('object','tasks');
		set_context('tasks');

    
		// Get categories, if they're installed
		global $CONFIG;
		
		$area3 = elgg_view('blog/categorylist', array(
			'baseurl' => $CONFIG->wwwroot . 'pg/categories/list/?subtype=tasks&category=',
			'subtype' => 'tasks'
		));

	// Format page
$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2, $area3);
		
	// Draw it
		echo page_draw(elgg_echo('tasks:everyone'),$body);

?>
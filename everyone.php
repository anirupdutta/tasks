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
		
		$filter = get_input('filter');
		$tagsearch = get_input('tag');
		if(!$filter)
		{
			$filter = '11';
		}

	// List tasks
		$area2 = elgg_view_title(elgg_echo("tasks:task_type_{$filter}") . ' Tasks');
		set_context($filter);
		if(!empty($tagsearch)) {
			if($filter == '11')
			{
				$options = array (
				      'metadata_name' =>'tags',
				      'metadata_value' => $tagsearch,
				);
				$show = elgg_list_entities_from_metadata($options);
				if(!empty($show))
				{
					$area2 .= $show;
				}
				else 
				{
					$area2 .= 'No task found based on the searched criteria';
				}
			}
			else {
				$options = array (
					'task_type' => $filter,
					'tags'  => $tagsearch,
				);
				$show = list_entities_from_metadata_multi($options,'object','tasks');
				if(!empty($show))
				{
				      $area2 .= $show;
				}
				else
				{
				      $area2 .= 'No task found based on the searched criteria';
				}
			}
		}
		else {
			if($filter == '11') {
				$area2 .= list_entities('object','tasks');
			}
			else {
				$options = array (
				      'metadata_name' =>'task_type',
				      'metadata_value' => $filter,
				);
				$area2 .= elgg_list_entities_from_metadata($options);
			}
		}
		set_context('tasks');
		
    
		// Get categories, if they're installed
		global $CONFIG;
		$searchtitle = elgg_echo("tasks:task_type_{$filter}");
		$area3 = elgg_view('tasks/sidesearch',array('filter' => $filter,'searchtitle' => $searchtitle));
		$area3 .= elgg_view('blog/categorylist', array(
			'baseurl' => $CONFIG->wwwroot . 'pg/categories/list/?subtype=tasks&category=',
			'subtype' => 'tasks'
		));
		
	// Format page
		$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2, $area3);
		
	// Draw it
		echo page_draw(elgg_echo("tasks:task_type_{$filter}") . ' Tasks',$body);

?>
<?php

	/**
	 * Elgg tasks plugin form
	 * 
	 * @package Elggtasks
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 */

	// Have we been supplied with an entity?
		if (isset($vars['entity'])) {
			
			$guid = $vars['entity']->getGUID();
			$title = $vars['entity']->title;
			$description = $vars['entity']->description;
			$incentives = $vars['entity']->incentives;
			$incentivesdes = $vars['entity']->incentivesdes;
			$attachments = $vars['entity']->attachments;
			$tags = $vars['entity']->tags;
			$access_id = $vars['entity']->access_id;
			$owner = $vars['entity']->getOwnerEntity();
			$highlight = 'default';
			$start_date = $vars['entity']->start_date;
			$end_date = $vars['entity']->end_date;
			$task_type = $vars['entity']->task_type;
			$status = $vars['entity']->status;
			$assigned_to = $vars['entity']->assigned_to;
			$percent_done = $vars['entity']->percent_done;
			$work_remaining = $vars['entity']->work_remaining;
			$write_access_id = $vars['entity']->write_access_id;
			$container_id = $vars['entity']->getContainer();
			$container = get_entity($container_id);

			
		} else {
			
			$guid = 0;
			$title = get_input('title',"");
			$description = "";
			$attachments = "";
			//$address = get_input('address',"");
			$highlight = 'all';
			
			if ($address == "previous")
				$address = $_SERVER['HTTP_REFERER'];
			$tags = array();
			
			// bootstrap the access permissions in the entity array so we can use defaults
			if (defined('ACCESS_DEFAULT')) {
				$vars['entity']->access_id = ACCESS_DEFAULT;
				$vars['entity']->write_access_id = ACCESS_DEFAULT;
			} else {
				$vars['entity']->access_id = 0;
				$vars['entity']->write_access_id = 0;
			}
			
			$shares = array();
			$owner = $vars['user'];
			
			
			$container_id = get_input('container_guid');
			$container = get_entity($container_id);
			
		}

		$assign_list = array();
		$assign_list[0] = "";
		$assign_list[$_SESSION['user']->getGUID()] = $_SESSION['user']->name;
		if($container instanceof ElggGroup){

			$assign_list1 = $container->getMembers(300);
			
			foreach($assign_list1 as $members) {
				$assign_list[$members->getGUID()] = $members->name;
			}
				
		}else{
     
			$assign_list1 = $_SESSION['user']->getFriends("", 300, $offset = 0);
			foreach($assign_list1 as $friends) {
				$assign_list[$friends->getGUID()] = $friends->name;
			}
    }	
?>


<div class="contentWrapper_nowhite">
	<form action="<?php echo $vars['url']; ?>action/tasks/add" method="post">
		<?php echo elgg_view('input/securitytoken'); ?>
		<p>
			<label>
				<?php 	//echo elgg_echo('title'); ?>
				<?php

						echo elgg_view('input/text',array(
								'internalname' => 'title',
								'value' => $title,
						)); 
				
				?>
			</label>
		</p>
	<?php
		// Ajout de FXN pour gérer les catégories dans les tasks
		$cats = elgg_view('categories',$vars);
		if (!empty($cats)) {
		?>
		  <p>
				<?php 
					echo $cats;
				?>

			</p>
		<?php
					
				}
		
		?>
		<table class="tasks" width="100%">
			<tr>
				<td width="23%">
					<label>
						<?php 	echo elgg_echo('tasks:start_date'); ?>
						<?php
								echo elgg_view('input/text',array(
										'internalname' => 'start_date',
										'value' => $start_date,
										'class' => 'tiny date',
								)); 
						
						?>
					</label>
					</td>
					<td width="23%">
					<label>
						<?php 	echo elgg_echo('tasks:end_date'); ?>
						<?php
		
								echo elgg_view('input/text',array(
										'internalname' => 'end_date',
										'value' => $end_date,
										'class' => 'tiny date',
		
								)); 
						
						?>
					</label>
					</td>
						<style>
							.input_pulldown{
								width:96%;
							}
							.ui-datepicker-trigger{
								padding:4px;
								margin-bottom:-7px;						
							}
						</style>
					<td width="30%">
					<label>
						<?php 	echo elgg_echo('tasks:percent_done'); ?>
						<?php
							echo elgg_view('input/pulldown', array(
									'internalname' => 'percent_done',
									'options_values' => array( '0' => elgg_echo('tasks:task_percent_done_0'),
												   '1' => elgg_echo('tasks:task_percent_done_1'),
												   '2' => elgg_echo('tasks:task_percent_done_2'),
												   '3' => elgg_echo('tasks:task_percent_done_3'),
									                           '4' => elgg_echo('tasks:task_percent_done_4'),
									                           '5' => elgg_echo('tasks:task_percent_done_5'),
									                         ),
									'value' => $percent_done,
								));
						?>
					</label>
					
					</td>
				</tr>
				<tr>
				<td width="33%">
				<label>
				<?php echo elgg_echo('tasks:task_type'); ?>	
				<?php
					echo elgg_view('input/pulldown', array(
							'internalname' => 'task_type',
							'options_values' => array( '0' => "",
										   '1' => elgg_echo('tasks:task_type_1'),
										   '2' => elgg_echo('tasks:task_type_2'),
										   '3' => elgg_echo('tasks:task_type_3'),
							                           '4' => elgg_echo('tasks:task_type_4'),
							                           '5' => elgg_echo('tasks:task_type_5'),
										   '6' => elgg_echo('tasks:task_type_6'),
										   '7' => elgg_echo('tasks:task_type_7'),
				                                 	           '8' => elgg_echo('tasks:task_type_8'),
							                           '9' => elgg_echo('tasks:task_type_9'),
							                           '10' => elgg_echo('tasks:task_type_10'),
							                         ),
							'value' => $task_type,
						));
				?>
				</label>
				</td>
				<td width="33%">
				<label>
				<?php echo elgg_echo('tasks:status'); ?>	
				<?php
					echo elgg_view('input/pulldown', array(
							'internalname' => 'status',
							'options_values' => array( '0' => "",
										   '1' => elgg_echo('tasks:task_status_1'),
										   '2' => elgg_echo('tasks:task_status_2'),
										   '3' => elgg_echo('tasks:task_status_3'),
							                           '4' => elgg_echo('tasks:task_status_4'),
							                           '5' => elgg_echo('tasks:task_status_5'),
							                         ),
							'value' => $status,
						));
				?>
				</label>
				</td>
				<td width="30%">
				<label>
				<?php echo elgg_echo('tasks:assigned_to'); ?>	
				<?php
					echo elgg_view('input/pulldown', array(
							'internalname' => 'assigned_to',
							'options_values' => $assign_list,
							'value' => $assigned_to
						));
				?>
				</label>
			</td>
			</tr>
		</table>
		<br />
		<p class="longtext_editarea">
			<label>
				<?php 	echo elgg_echo('description'); ?>
				<br />
				<?php

						echo elgg_view('input/longtext',array(
								'internalname' => 'description',
								'value' => $description,
								
						)); 
				
				?>
			</label>
		</p>
		<p class="longtext_editarea">
			<label>
				<?php 	echo elgg_echo('Attachment/examples links'); ?>
				<br />
				<p>Put links of any references that you would want to give. To upload a file (<a href="<?php echo $vars['url']; ?>pg/file/new" target="_blank">click here</a>), then paste the file link below</p>
				<?php

						echo elgg_view('input/longtext',array(
								'internalname' => 'attachments',
								'value' => $attachments,
								
						)); 
				
				?>
			</label>
		</p>
		<?php
		    if(isadminloggedin()){
		?>
		<p>
			<label>
				<?php 	
					echo elgg_echo('tasks:incentives'); 
				?>
				<?php
					echo elgg_view('input/pulldown', array(
							'internalname' => 'incentives',
							'options_values' => array( '0' => elgg_echo('tasks:noincentives'),
							'1' => elgg_echo('tasks:company1'),
							'2' => elgg_echo('tasks:company2'),
							'3' => elgg_echo('tasks:company3'),
						),
					    'value' => $incentives
					));
				?>
			</label>
			<p class="longtext_editarea">
				<label>
				      <?php 	echo elgg_echo('tasks:incentivesdescription'); ?>
				      <?php

						echo elgg_view('input/longtext',array(
								'internalname' => 'incentivesdes',
								'value' => $incentivesdes,
								
						)); 
				
				      ?>
				</label>
			</p>
		</p>
		<?php
		    }
		    else
		    {
		?>
			  <?php
				if(!empty($vars['entity']->incentives) || $vars['entity']->incentives!=0)
				{
			  ?>
					  <h3 class="settings">Incentives</h3>
			  <?php
					  if($vars['entity']->incentives == 1) {
					  ?>
						  <img src = "http://www.troopp.com/explore/images/spykar.png"/>
					  <?php	      
					  }
					  if($vars['entity']->incentives == 2) {
					  ?>
						  <img src = "http://www.troopp.com/explore/images/sk.png"/>
					  <?php	      
					  }
					  if($vars['entity']->incentives == 3) {
					  ?>
						  <img src = "http://www.troopp.com/explore/images/all.png"/>
					  <?php	      
					  }
					  ?>
					  <?php
					  if(!empty($vars['entity']->incentivesdes)) {
					  ?>
						  <div class="sharing_item_description" style="border: 1px solid #eee;padding:5px;">
							  <?php echo elgg_view('output/longtext', array('value' => $vars['entity']->incentivesdes)); ?>
						  </div>
					  <?php
					  }
				}
			}
		?>
		<p>
			<label>
				<?php 	echo elgg_echo('tags'); ?>
				<?php

						echo elgg_view('input/tags',array(
								'internalname' => 'tags',
								'value' => $tags,
						)); 
				
				?>
			</label>
		</p>
		<p>
			<label>
				<?php 	echo elgg_echo('tasks:access'); ?>
				<?php

						echo elgg_view('input/access',array(
								'internalname' => 'access',
								'value' => $access_id,
						)); 
				
				?>
			</label>
		</p>
		<p>
			<label>
				<?php 	echo elgg_echo('tasks:write_access'); ?>
				<?php

						echo elgg_view('input/access',array(
								'internalname' => 'write_access',
								'value' => $write_access_id,
						)); 
				
				?>
			</label>
		</p>
	

		<p>
			<?php echo $vars['container_guid'] ? elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => $vars['container_guid'])) : ""; ?>
			<input type="hidden" name="task_guid" value="<?php echo $guid; ?>" />
			<input type="submit" value="<?php echo elgg_echo('save'); ?>" />
		</p>
	</form>


</div>


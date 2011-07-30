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

	// List tasks


	// Format page
		$body = elgg_view_layout('', $area1, $area2, $area3);
		
	// Draw it
		echo page_draw(elgg_echo('tasks:everyone'),$body);
	
	$user = $_SESSION[ 'user' ];

	if (is_plugin_enabled('profile_manager')) {
	      $user_type = get_entity($user->custom_profile_type);
	      if ($user_type) {
		      $user_type = $user_type->getTitle();
	      }
	}

?>

<div id="page_container">
		 <div id="page_wrapper" >


		  <div style="padding:10px;top:130px; position:absolute;width:990px;z-index:10;">
		  <h3 class="settings" style="background:white;width:960px;">What Skill do you want to contribute to the world today? Select one and get going! &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<g style="font-weight:normal;">
		  <?php if($user_type || isadminloggedin()){ ?>
			To add a task <a href="<?php $CONFIG->wwwroot ?>../../pg/tasks/<?php echo $user->username; ?>/add"> click here</a>
																																																																												 
		  <?php 
		  }
		  else
		  { 
		  ?>
			To go to task board <a href="everyone.php"> click here</a>
		  <?php
		  }
		  ?>
</g></h3>
<section class="slide-up-boxes">

			<a href="<?php echo $vars['url'] . 'everyone.php?filter=1'?>">
				<h5>Consulting</h5>
				<div style="font-size:1em;">Help strategize and brainstorm with non-profits to take them to the next level.</div>				
			</a>
				
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=2'?>">
				<h5>Web Development</h5>
					<div style="font-size:1em;">Advanced/ beginner in webdev? We are sure you can contribute here!</div>				
			</a>
			
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=3'?>">
				<h5>Writing / Editing</h5>
				<div style="font-size:1em;">Use your literary skills to help Non-profits </div>				
			</a>
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=4'?>">
				<h5>Research</h5>
				<div style="font-size:1em;">You love to explore? Researcher by profession? Contribute here</div>				
			</a>
				
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=5'?>">
				<h5>Creative skills</h5>
					 <div style="font-size:1em;">Music, videography, photography, painting, sculpting ... Creative people help here</div>				
			</a>
			
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=6'?>">
				<h5>Translations</h5>
				<div style="font-size:1em;">We all know atleast 2 languages. Lets put that to use. Translate!</div>				
			</a>
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=7'?>">
				<h5>Vocation Training/ Modules</h5>
				<div style="font-size:1em;">Help NGOs prepare their training modules and vocational training kits.</div>				
			</a>
				
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=8'?>">
				<h5>Design</h5>
				<div style="font-size:1em;">Together we can beautify the entire Non-profit sector. Designers come on in!</div>				
			</a>
				<a href="<?php echo $vars['url'] . 'everyone.php?filter=9'?>">
				<h5>Marketing / Media</h5>
					 <div style="font-size:1em;">Enable them to reach the masses, help them be heard.</div>				
			</a>
				
			<a href="<?php echo $vars['url'] . 'everyone.php?filter=10'?>">
				<h5>Others</h5>
				<div style="font-size:1em;">Didn't find something relevant? No worries. Enter here, there is plenty in store for you!</div>				
			</a>

		</section>

</div></div></div>

<style>


/*slide up boxes*/
	.slide-up-boxes a { 
			display: block; 
			height: 130px;
			background: #fff; 
			border: 1px solid #ccc; 
			height: 100px; 
			overflow: hidden; 
			width:158px;
			float:left;
			margin:7px;
			padding:10px;
			
		}
		
		.slide-up-boxes h5 { 
			color: #333; 
			text-align: center;
			height: 100px; 
			font: italic 17px/65px Georgia, Serif;    /* Vertically center text by making line height equal to height */
			 opacity: 1;
			 -webkit-transition: all 0.2s linear; 
			 -moz-transition: all 0.2s linear; 
			 -o-transition: all 0.2s linear;
			 line-height:100%;
			 padding-top: 30px;
		}
		
		.slide-up-boxes a:hover h5 { 
			margin-top: -100px; 
			opacity: 0;
			padding-top:0px;
		}
		
		.slide-up-boxes div { 
			position: relative; 
			color: white; 
			font: 12px Georgia, Serif;
			height: 80px; 
			padding: 10px; 
			opacity: 0; 
			-webkit-transform: rotate(6deg); 
			-webkit-transition: all 0.4s linear; 
			-moz-transform: rotate(6deg); 
			-moz-transition: all 0.4s linear; 
			-o-transform: rotate(6deg); 
			-o-transition: all 0.4s linear; 
		}
		.slide-up-boxes a:hover div { 
			opacity: 1; 
			-webkit-transform: rotate(0); 
			-moz-transform: rotate(0); 
			-o-transform: rotate(0); 
		}
		.slide-up-boxes a:nth-child(1) div { background: #bf001f ;  }
		.slide-up-boxes a:nth-child(2) div { background: #367db2 ; }
		.slide-up-boxes a:nth-child(3) div { background: #393838 ; }
		.slide-up-boxes a:nth-child(4) div { background: #bf001f ;  }
		.slide-up-boxes a:nth-child(5) div { background: #367db2 ; }
		.slide-up-boxes a:nth-child(6) div { background: #393838 ; }
		.slide-up-boxes a:nth-child(7) div { background: #bf001f ;  }
		.slide-up-boxes a:nth-child(8) div { background: #367db2 ; }
		.slide-up-boxes a:nth-child(9) div { background: #bf001f ;  }
		.slide-up-boxes a:nth-child(10) div { background: #393838 ; }




</style>
<?php
				if(!empty($vars['entity']->incentives) || $vars['entity']->incentives!=0)
				{
			  ?>
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
				} 
			?>
<br />
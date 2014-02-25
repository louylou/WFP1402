<!-- This the Group Home Content, Profile list, Calendar & last Resort -->

<section id="groups">	
	<ul>
		<li><a href="<?php echo base_url()."groups/".$this->session->userdata('userId'); ?>">Create or Join a Group</a></li>
		<li>Group: <?php echo ucwords($this->session->userdata('groupName')); ?></li>		
	</ul>
</section>

<section>
	<div id='profileList'>		
	<h1>ALL GIFT PROFILES</h1>

	<ul>
		<!--<?php $id = $this->db->where('groupname_id', $this->session->userdata('groupId'));
			$id = $this->db->from('groupnames');
			$count = $id->count_all_results();
		?>-->
		<li>1 - <?php echo $this->db->count_all_results('groupnames'); ?> Profiles</li><!--$count;-->
	</ul>

	<ul>	
			 
		<?php 
		if (is_array($users) ) {
			foreach ($users as $user): 
			$link = base_url()."profile/".$user['user_id']; 
		?> 
	
			<li>
				<a href="<?php echo $link; ?>"><img src='<?php echo base_url(); ?>assets/images/nopicSmall.jpg' alt="Photo of an outlined body figure holder a present, represents the user's profile photo."/></a>
				<a href="<?php echo $link; ?>"><?php echo $user['user_fullname']; ?></a>
			</li> 		
		<?php endforeach; } else { 
			$link = base_url()."profile/".$users[0]['user_id'];
		?>
			<li><?php echo 'Welcome! Start by Creating or Joining a group.'; ?></li>
			<li>	
				<a href="<?php echo $link; ?>"><img src='<?php echo base_url(); ?>assets/images/nopicSmall.jpg' alt="Icon of two party hats."/></a>
				<a href="<?php echo $link; ?>"><?php echo $this->session->userdata('username'); ?></a>			
			</li>
		<?php } ?>
	</ul>
	
	</div> <!--end profileList-->	

	<div id='calendar'>	
	<h1>EVENTS CALENDAR</h1>
	
		<ol>
			<li><a href='<?php echo base_url()."addEvents/".$this->session->userdata('userId'); ?>'>Add Event</a></li>
			<li><a href='<?php echo base_url(); ?>allEvents'>View All </a></li>
		</ol>
		<ul>	
		<?php if ($events > 0) {
			foreach ($events as $event):
			
				$link = base_url()."profile/".$event['event_user_id'];
				$date = date("m/d", strtotime( $event['event_date']));
				$day = date("D", strtotime( $event['event_date']));
		 ?>
				<li class='party'>(<?php echo $day; ?>)<?php echo '&nbsp'; ?><span><?php echo $date; ?></span> - <?php echo $event['user_fullname']; ?>
				<a href="<?php echo $link; ?>"><?php echo $event['event_title']; ?></a>
				</li>
	
			<?php endforeach; } else { ?>
				<li>
					No Events Yet.
				</li>	
			<?php } ?>	
		</ul>
	</div>

	<div id='lastResort'>
	<h1>Last Resort</h1>
		<ul>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg' alt="Icon of a bouquet of flowers, represents the flower website it is linked to."/><span>Same Day Delivery</span><a href='http://www.ftd.com'>www.ftd.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg' alt="Icon of a bouquet of flowers, represents the flower website it is linked to."/><span>Same Day Delivery</span><a href='http://www.fromyouflowers.com'>www.fromyouflowers.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg' alt="Icon of a bouquet of flowers, represents the flower website it is linked to."/><span>Over Night Delivery</span><a href='http://www.proflowers.com'>www.proflowers.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/basket.jpg' alt="Icon of a basket of fruit, represents the gift basket website it is linked to."/><span>Express Delivery</span><a href='http://www.harryanddavid.com'>www.harryanddavid.com</a></li>
		</ul>
	</div>
		

</section>	




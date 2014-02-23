<!-- This the Group Home Content, Profile list, Calendar & last Resort -->

<section id="groups">	
	<ul>
		<li><a href="<?php echo base_url()."groups/".$this->session->userdata('userId'); ?>">Create or Join a Group</a></li>
		<li id="groupName">Group: <?php echo $this->session->userdata('groupName'); ?></li>				
	</ul>
</section>


<section>
	<div id='profileList'>		
	<h1>ALL GIFT PROFILES</h1>

	<ul>
		<?php $id = $this->db->where('groupname_id', $this->session->userdata('groupId'));
			$id = $this->db->from('groupnames');
			$count = $id->count_all_results();
		?>
		<li>1 - <?php echo $count; ?> Profiles</li>
	</ul>

	<ul>	
			
		<?php
		if ($this->session->userdata('groupId') == $users[0]['groupname_id']) {
			foreach ($users as $user): 
			$link = base_url()."profile/".$user['user_id']; 
		?> 
	
			<li>
				<a href="<?php echo $link; ?>"><img src='<?php echo base_url(); ?>assets/images/nopicSmall.jpg'/></a>
				<a href="<?php echo $link; ?>"><?php echo $user['user_fullname']; ?></a>
			</li> 		
		<?php endforeach; } else { 
			$link = base_url()."profile/".$users[0]['user_id'];
		?>
			<li>
				<a href="<?php echo $link; ?>"><img src='<?php echo base_url(); ?>assets/images/nopicSmall.jpg'/></a>
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
		<?php 		
		foreach ($events as $event):
			
			$link = base_url()."profile/".$event['event_user_id'];//should it be user_id instead?
			$date = date("m/d", strtotime( $event['event_date']));
			$day = date("D", strtotime( $event['event_date']));
			 
		 ?>
				<li class='party'>(<?php echo $day; ?>)<?php echo '&nbsp'; ?><span><?php echo $date; ?></span> - <?php echo $event['user_fullname']; ?>
				<a href="<?php echo $link; ?>"><?php echo $event['event_title']; ?></a>
				</li>
	
			<?php endforeach; ?>
		</ul>
	</div>

	<div id='lastResort'>
	<h1>Last Resort</h1>
		<ul>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg'/><span>Same Day Delivery</span><a href='http://www.ftd.com'>www.ftd.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg'/><span>Same Day Delivery</span><a href='http://www.fromyouflowers.com'>www.fromyouflowers.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/flowers.jpg'/><span>Over Night Delivery</span><a href='http://www.proflowers.com'>www.proflowers.com</a></li>
			<li><img src='<?php echo base_url(); ?>assets/images/basket.jpg'/><span>Express Delivery</span><a href='http://www.harryanddavid.com'>www.harryanddavid.com</a></li>
		</ul>
	</div>
		

</section>	




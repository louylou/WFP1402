<section id="breadcrumbs">
	<ul><!--."groupHome/".$this->session->userdata('userId')-->
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<li><a href="<?php echo base_url(); ?>allEvents"> All Events</a></li>
	</ul>
</section>

<section id="allEvents">

	<h1>ALL SPECIAL EVENTS</h1>
		
		<p>Events Listed: ALL</p>
		<p><a href='<?php echo base_url()."addEvents/".$this->session->userdata("userId")?>'>Add Event</a></p>
		<ul>	
		<?php 
		//print_r($events);
		
		foreach ($events as $event):
			
			$link = base_url()."profile/".$event['event_user_id'];
			$date = date("m/d", strtotime( $event['event_date']));
			$day = date("D", strtotime( $event['event_date']));
			$starttime = date("g:i", strtotime( $event['event_starttime']));
			$endtime =date("g:i", strtotime( $event['event_endtime']));	 
		 ?>
				<li class='party'>(<?php echo $day; ?>)<?php echo '&nbsp'; ?><span><?php echo $date; ?></span> - <?php echo $event['user_fullname']; ?>
				<a href="<?php echo $link; ?>"><?php echo $event['event_title']; ?></a>
				<?php echo $starttime; ?> - <?php echo $endtime; ?>
				<?php echo '&nbsp'; ?>
				<?php echo $event['event_location']; ?>
				</li>
	
			<?php endforeach; ?>
		</ul>
				
</section>
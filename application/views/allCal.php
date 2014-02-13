<section id="breadcrumbs">
	<ul>
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<li><a href="<?php echo base_url(); ?>allEvents"> All Events</a></li>
	</ul>
</section>

<section id="allEvents">

	<h1>ALL SPECIAL EVENTS</h1>
		
		<p>Events Listed: ALL</p>
		<p><a href="<?php echo base_url(); ?>addEvents">Add Event</a></p>

		<ul>	
		<?php 
		//print_r($events);
		
		foreach ($events as $event):
			
			$link = base_url()."profile/".$event['event_user_id'];
			$date = date("m/d", strtotime( $event['event_date']));
			$day = date("D", strtotime( $event['event_date']));
			 
		 ?>
				<li class='birthday'>(<?php echo $day; ?>)<?php echo '&nbsp'; ?><span><?php echo $date; ?></span> - <?php echo $event['user_fullname']; ?>
				<a href="<?php echo $link; ?>"><?php echo $event['event_title']; ?></a>
				</li>
	
			<?php endforeach; ?>
		</ul>
				
</section>
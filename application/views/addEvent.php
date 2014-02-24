<section id="breadcrumbs">
	<ul><!--."groupHome/".$this->session->userdata('userId')-->
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<li><a href="<?php echo base_url(); ?>allEvents"> All Events >></a></li>
		<li><a href="<?php echo base_url()."addEvents/".$this->session->userdata('userId')?>"> Add Event </a></li>
	</ul>
</section>

<section id="addEvent">

	<h1>Add an Event</h1>
	
	<?php echo form_open(base_url()."addEvents/".$this->session->userdata('userId')); ?> 
	
	<legend>Hi <?php echo $this->session->userdata('username'); ?>, create an event to remind and celebrate with the group.</legend>
	
		<p>
			<?php
			$data = array(
				'name' => 'eventTitle',
				'id' => 'eventTitle',
				'placeholder' => 'ex: 25th Birthday!',
				'size' => '90'
			
			);
			echo form_label('Event Title:', 'eventTitle');
			echo form_error('eventTitle');
			echo form_input($data, set_value('eventTitle')); ?>
		</p>
		<p>
			<?php			
			$options = array(
				//$key => $value
				'' => 'Please Choose An Event Type', 
				'birthday' => 'Birthday',
				'graduation' => 'Graduation',
				'special' => 'Special Party',
				'holiday' => 'Holiday Party',			
			);
			echo form_label('Event Type:', 'eventType');
			echo form_error('eventType');
			
			echo form_dropdown('eventType', $options ); //$proInfo //if no error add ,'special' after $options
			 
			?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'location',
				'id' => 'location',
				'placeholder' => 'ex: 1001 Somestreet, city, state, zip',
				'size' => '90'
			
			);
			echo form_label('Location:', 'location');
			echo form_error('location');
			echo form_input($data, set_value('location')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'date',
				'id' => 'date',
				'placeholder' => 'YYYY/MM/DD',
				'size' => '15'
			
			);
			echo form_label('Date:', 'date');
			echo form_error('date');
			echo form_input($data, set_value('date')); ?>
		</p>

		<p>
			<?php
			$data = array(
				'name' => 'startTime',
				'id' => 'startTime',
				'placeholder' => 'hh:mm:ss',
				'size' => '15'
			);
			echo form_label('Start Time:', 'startTime');
			echo form_error('startTime');
			echo form_input($data, set_value('startTime')); 
			
			$am = array(
				'Am' => 'AM',
				'Pm' => 'PM',			
			);
			echo form_error('am');
			echo form_dropdown('am', $am); 
			?>
		</p>
		
		<p>
			<?php
			$data = array(
				'name' => 'endTime',
				'id' => 'endTime',
				'placeholder' => 'hh:mm:ss',
				'size' => '15'
			);
			echo form_label('End Time:', 'endTime');
			echo form_error('endTime');
			echo form_input($data, set_value('endTime')); 
			
			$pm = array(
				'Am' => 'AM',
				'Pm' => 'PM',			
			);
			echo form_error('pm');
			echo form_dropdown('pm', $pm); 
			?>
		</p>
	
		<p>
			<?php
			$data = array(
				'name' => 'addEvent',
				'id' => 'addEvent'
			);
			echo form_submit($data, 'Add Event'); ?>
		</p>
	
	<?php echo form_close(); ?>
	<p><img src="<?php echo base_url(); ?>assets/images/eventPic.jpg"/></p>
	
</section>	
	
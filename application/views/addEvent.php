<section id="breadcrumbs">
	<ul>
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<li><a href="<?php echo base_url(); ?>allEvents"> All Events >></a></li>
		<li><a href="<?php echo base_url(); ?>addEvents"> Add Event </a></li>
	</ul>
</section>

<section id="addEvent">

	<h1>Add an Event</h1>
	
	<?php echo form_open(base_url()); ?>
	<legend>Create An Account</legend>
	
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
		<!--<p>
			<?php
			$data = array(
				'birthday' => 'Birthday',
				'grad' => 'Graduation',
				'sParty' => 'Special Party',
				'hParty' => 'Holiday Party',			
			);
			//echo form_label('Event Type:', 'lastName');
			//echo form_error('');
			echo form_dropdown($data, 'birthday'); ?>
		</p>-->
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
				'placeholder' => '00:00',
				'size' => '15'
			);
			echo form_label('Start Time:', 'startTime');
			echo form_error('startTime');
			echo form_input($data, set_value('startTime')); ?>
			
		<!--	<?php
			$data = array(
				'am' => 'AM',
				'pm' => 'PM',
			);
			//echo form_label('Event Type:', 'lastName');
			//echo form_error('');
			echo form_dropdown($data, 'AM'); 
			?>-->
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'endTime',
				'id' => 'endTime',
				'placeholder' => '00:00',
				'size' => '15'
			);
			echo form_label('End Time:', 'endTime');
			echo form_error('endTime');
			echo form_input($data, set_value('endTime')); ?>
		</p>
	
		<p>
			<?php
			$data = array(
				'name' => 'submit',
				'id' => 'submit'
			);
			echo form_submit($data, 'Submit'); ?>
		</p>
	
	<?php echo form_close(); ?>
	<p><img src="<?php echo base_url(); ?>assets/images/eventPic.jpg"/></p>
	
</section>	
	
<!--	
		<form>
			<fieldset>
			
				<p>
					<label for="eventTitle">Event Title:</label>
					<input type="text" name="eventTitle" id="eventTitle" placeholder="ex: 25th Birthday!" min="1" max="50" size="93">
				</p>
				<p>
					<label for="eventType">Event Type:</label>
					<select>
						  <option value="birthday">Birthday</option>
						  <option value="Graduation">Graduation</option>
						  <option value="party">Special Party</option>
						  <option value="holiday">Holiday Party</option>
					</select>
				</p>
				<p>
					<label for="location">Location:</label>
					<input type="text" name="location" id="location" placeholder="ex: 1001 Somestreet, city, state, zip" min="1" max="100" size="93">
				</p>
				<p>
					<label for="date">Date: </label>
					<input type="text" name="date" id="date" placeholder="ex: 04/25/14" min="1" max="10" size="10">
				</p>
				<p>
					<label for="time">Time Start: </label>
					<input type="text" name="time" id="time" placeholder="00:00" min="1" max="5" size="3">
					
					<select>
						  <option value="am">AM</option>
						  <option value="pm">PM</option>
					</select>
				</p>
				<p>
					<label for="timeEnd">Time End: </label>
					<input type="text" name="timeEnd" id="timeEnd" placeholder="00:00" min="1" max="5" size="3">

					<select>
						  <option value="am">AM</option>
						  <option value="pm">PM</option>
					</select>
				</p>	
				<p>	
					<input type="submit" name="submit" value="Add Event" />
				</p>
			</fieldset>
		</form>	
		<p><img src="<?php echo base_url(); ?>assets/images/eventPic.jpg"/></p>

</section>
-->


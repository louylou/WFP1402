<section id="breadcrumbs">
	<ul>
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<li><a href="<?php echo base_url(); ?>groups">Group Accounts</a></li>
	</ul>
</section>

<section id="groupPage">
			
	<h1>Create or Join a Group</h1>

		
	<?php echo form_open( base_url()."editProfile/".$this->session->userdata('userId') ); ?>
	<legend>Create a unique group name.</legend>
		
		<p><!-- Creating a group input-->
			<?php 
			$data = array(
				'name' => 'newGroup',
				'id' => 'newGroup',
				'placeholder' => 'Create a descriptive and unique Group Name.', //$placeholder,
				'size' => '50'			
			);
			echo form_label('New Group Name:', 'newGroup');
			echo form_input($data, set_value('newGroup')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'createGroup',
				'id' => 'createGroup'
			);
			echo form_submit($data, 'Create Group'); ?>
		</p>
		
		<legend>Join a Group. <span>(make sure everything is spelled correctly).</span></legend>
		
		<p> <!-- Joining a group input-->
			<?php
			
			$data = array(
				'name' => 'joiningGroup',
				'id' => 'joiningGroup',
				'placeholder' => 'Type the correct Group Name you wish to join.', //$placeholder,
				'size' => '50'			
			);
			echo form_label('Group Name:', 'joiningGroup');
			echo form_input($data, set_value('joiningGroup')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'joinGroup',
				'id' => 'joinGroup'
			);
			echo form_submit($data, 'Join Group'); ?>
		</p>
	
	<?php echo form_close(); ?>

</section>	
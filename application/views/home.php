
<!-- The CTA photo, Why Join? and Create an Account Section on the Home page-->
		
<section id="cta">
	<p><img src="<?php echo base_url(); ?>assets/images/ctaImg.jpg" alt="Image of a woman's hands holding a small wrapped present" /></p>
</section>


<section id="registration">

	<div>
		<h1>Why Join?</h1>			
		<p> 
			Perfect For Me is a non-profit website that allows people to make a group 
			account to share each other’s gift profile to find and buy the perfect gift! 
		</p>
		<p>
			Includes - having your own gift profile where you can add gifts you want others to buy for you!
			A group calendar where everyone can add personal occasions for fellow group members to remember and celebrate!
			And the "Last Resort" which is a list of websites that do fast delivery if you need the perfect gift ASAP!
		</p>
		<p>
			Give it a try! Join today!
		</p>
				
	</div>
	<!--
	$attr = array (
	'class'=>'name of class to style the fieldset'
	);
	<?php echo form_fieldset("Create An Account", $attr); ?>-->
	
	<?php echo form_open(base_url()); ?>
	<legend>Create An Account</legend>
	
		<p><!--was 'firstName'-->
			<?php
			$s = $this->session->userdata('loggedIn'); 
			$helloUser = $this->session->userdata('username');//displays correct user name
			if (!$s){
				$data = array(
					'name' => 'fullname',
					'id' => 'fullname',
					'placeholder' => 'Full Name',
					'size' => '75'			
				);
				echo form_label('Full Name:', 'fullname');
				echo form_error('fullname');
				echo form_input($data, set_value('fullname')); 
			} else {
				echo "<h4>Welcome, ".ucwords($helloUser)."!</h4>";
			}?>
		</p>
		<!--<p>
			<?php
			$data = array(
				'name' => 'lastName',
				'id' => 'lastName',
				'placeholder' => 'Last Name',
				//'value' => set_value('email'),
				'size' => '75'
			
			);
			echo form_label('Last Name:', 'lastName');
			echo form_error('lastName');
			echo form_input($data, set_value('lastName')); ?>
		</p>-->
		<p>
			<?php
			if (!$s){
				$data = array(
					'name' => 'newEmail',
					'id' => 'newEmail',
					'placeholder' => 'Email',
					//'value' => set_value('email'),
					'size' => '75'
		
				);
				echo form_label('Email:', 'newEmail');
				echo form_error('newEmail');
				echo form_input($data, set_value('newEmail')); 
			}?>			
		</p>

		<p>
			<?php
			if (!$s){
				$data = array(
					'name' => 'newPassword',
					'id' => 'newPassword',
					'placeholder' => 'Password',
					//'value' => set_value('password'),
					'size' => '75'
				);
				echo form_label('Password:', 'newPassword');
				echo form_error('newPassword');
				echo form_password($data, set_value('newPassword')); 
			}?>
		</p>
		<p>
			<?php
			if (!$s){
				$data = array(
					'name' => 'c_pwd',
					'id' => 'c_pwd',
					'placeholder' => 'Confirm Password',
					//'value' => set_value('password'),
					'size' => '75'
				);
				echo form_label('Confirm:', 'c_pwd');
				echo form_error('c_pwd');
				echo form_password($data, set_value('c_pwd')); 
			}?>
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
	<!--<?php echo form_fieldset_close(); ?>-->




<!--
	<form>
		<fieldset>
			<legend>Create An Account</legend>				
			<p>
				<label for="firstName">First Name:</label>
				<input type="text" name="firstName" id="firstName" placeholder="" min="1" max="100" size="75">
			</p>
			<p>
				<label for="lastName">Last Name:</label>
				<input type="text" name="lastName" id="lastName" placeholder="" min="1" max="100" size="75">
			</p>
			<p>
				<label for="accountEmail">Email: </label>
				<input type="text" name="accountEmail" id="accountEmail" placeholder="" min="1" max="100" size="75">
			</p>
			<p>
				<label for="accountPassword">Password: </label>
				<input type="password" name="accountPassword" id="accountPassword" placeholder="" min="1" max="100" size="75">
			</p>	
			<p>	
				<input type="submit" name="submit" />
			</p>
		</fieldset>
	</form>
-->

</section>		

<section id="breadcrumbs">
	<ul>
		<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> 
		<!--<li><a href="<?php echo base_url()."profile/".$user['user_id'];?>"> User Profile >></a></li>-->
		<li><a href="<?php echo base_url(); ?>editProfile"> Edit Profile</a></li>
	</ul>
</section>

<section id="editProfile">
		
	<h1>Hannah Elizabeth Davis</h1>
	<p><a href=""><img src="<?php echo base_url(); ?>assets/images/bri.jpg"/></a></p>
	<p>Upload New Photo <span>(295px X 295px)</span> - <a href="">Choose File</a></p>
	
	<?php echo form_open(base_url()); ?>
	<legend>Add/Delete Your Likes & Dislikes</legend>
		<p>
			<?php
			$data = array(
				'name' => 'clothes',
				'id' => 'clothes',
				'placeholder' => 'ex: Hipster, BoHo Chic, Preppy...',
				'size' => '90'			
			);
			echo form_label('Clothes Style:', 'clothes');
			echo form_input($data, set_value('clothes')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'food',
				'id' => 'food',
				'placeholder' => 'ex: Italian, Mexican, Chinese...',
				'size' => '90'			
			);
			echo form_label('Food Style:', 'food');
			//echo form_error('food');
			echo form_input($data, set_value('food')); ?>
		</p>

		<p>
			<?php
			$data = array(
				'name' => 'movies',
				'id' => 'movies',
				'placeholder' => 'ex: Action, Horror, Romance...',
				'size' => '90'			
			);
			echo form_label('Movie Genre:', 'movies');
			//echo form_error('movies');
			echo form_input($data, set_value('movies')); ?>
		</p>

		<p>
			<?php
			$data = array(
				'name' => 'hobbies',
				'id' => 'hobbies',
				'placeholder' => 'ex: Hiking, Reading, Cooking...',
				'size' => '90'
			);
			echo form_label('Hobbies:', 'hobbies');
			//echo form_error('hobbies');
			echo form_input($data, set_value('hobbies')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'other',
				'id' => 'other',
				'placeholder' => 'ex: You Want the Lord of the Rings BluRay Collection...',
				'size' => '90'
			);
			echo form_label('Other:', 'other');
			//echo form_error('other');
			echo form_input($data, set_value('other')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'dislikes',
				'id' => 'dislikes',
				'placeholder' => 'ex: Socks, Toothbrushes, Pink Bunny Suit... ',
				'size' => '90'
			);
			echo form_label('Other:', 'dislikes');
			//echo form_error('dislikes');
			echo form_input($data, set_value('dislikes')); ?>
		</p>
	
		<p>
			<?php
			$data = array(
				'name' => 'editSave',
				'id' => 'editSave'
			);
			echo form_submit($data, 'Save'); ?>
		</p>
	
	<?php echo form_close(); ?>

</section><!-- end profileLikes -->		

<section id="addGift">
<?php echo form_open(base_url()); ?>
	<legend>Add Gift Items To Your Gift List</legend>
		<p>
			<?php
			$data = array(
				'name' => 'item',
				'id' => 'item',
				'placeholder' => 'ex: MacBook Pro 15 inch Laptop',
				'size' => '100'			
			);
			echo form_label('Item Name:', 'item');
			echo form_error('price');
			echo form_input($data, set_value('item')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'price',
				'id' => 'price',
				'placeholder' => 'ex: $1,350.00',
				'size' => '20'			
			);
			echo form_label('Price:', 'price');
			echo form_error('price');
			echo form_input($data, set_value('price')); ?>
		</p>

		<p>
			<?php
			$data = array(
				'name' => 'url',
				'id' => 'url',
				'placeholder' => 'ex: www.apple.com/macbookpro',
				'size' => '100'			
			);
			echo form_label('URL (optional):', 'url');
			echo form_error('url');
			echo form_input($data, set_value('url')); ?>
		</p>
		<p>
			<?php
			$data = array(
				'name' => 'addGift',
				'id' => 'addGift'
			);
			echo form_submit($data, 'Add Gift'); ?>
		</p>
	
	<?php echo form_close(); ?>

</section><!-- end addGift -->

<section id="giftList">	
	<h1>All Gift Requests</h1>
	<form>
		<select>
		   <option value="price">Price</option>
		   <option value="name">Name</option>
		</select>
	</form>
	<ul>
		<li>1 - 13 ( 24 )</li>
		<li><a href="">View All </a></li>
	</ul>
	
	<table>
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>URL <span>(optional)</span></th>
		</tr>
		<tr>
			<td>Mountain Bike</td>
			<td>$369.99</td>
			<td><a href="">Link to specific Item</a></td>
		</tr>
		
	
	</table>
</section>
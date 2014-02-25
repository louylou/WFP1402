<section id="breadcrumbs">
<ul><!--was ."groupHome/".$this->session->userdata('userId')-->
	<li><a href="<?php echo base_url(); ?>groupHome">Group Home >></a></li> <!--links call the functions in the controller--> 
	<li><a href="<?php echo base_url()."profile/".$proInfo[0]['user_id']; ?>"> User Profile</a></li>
</ul>
</section>

<section id="profile">

	<h1><?php echo $proInfo[0]['user_fullname']; ?></h1>
		
	<p><a href=""><img src="<?php echo base_url(); ?>assets/images/nopic.jpg" alt="Photo of an outlined body figure holder a present, represents the user's profile photo."/></a></p>
	
	<?php $link = base_url()."editProfile/".$proInfo[0]['user_id']; ?>
	
	<?php if ($this->session->userdata('userId') == $proInfo[0]['user_id']) { ?>
	
		<p><a href="<?php echo $link; ?>">Edit Profile ( Upload Photo, Add Gifts )</a></p>
	
	<?php } ?>
	
	<form>
		<fieldset>
			<legend>Likes & Dislikes</legend>	
			
			<?php foreach ($proInfo as $like): ?> 				
				<p>
					<label for="clothing">Clothing Style</label>
					<input type="text" name="clothing" id="clothing" placeholder="<?php echo $like['likes_clothes']; ?>" min="1" max="100" size="90" disabled>
				</p>
				<p>
					<label for="food">Food Style</label>
					<input type="text" name="food" id="food" placeholder="<?php echo $like['likes_food']; ?>" min="1" max="100" size="90" disabled>
				</p>
				<p>
					<label for="movie">Movie Genre</label>
					<input type="text" name="movie" id="movie" placeholder="<?php echo $like['likes_movies']; ?>" min="1" max="100" size="90" disabled>
				</p>
				<p>
					<label for="hobbie">Hobbies </label>
					<input type="text" name="hobbie" id="hobbie" placeholder="<?php echo $like['likes_hobbies']; ?>" min="1" max="100" size="90" disabled>
				</p>
				<p>
					<label for="other">Other</label>
					<input type="text" name="other" id="other" placeholder="<?php echo $like['likes_other']; ?>" min="1" max="100" size="90" disabled>
				</p>
				<p>
					<label for="dislikes">Gift Dislikes </label>
					<input type="text" name="dislikes" id="dislikes" placeholder="<?php echo $like['dislikes']; ?>" min="1" max="100" size="90" disabled>
				</p>	
			<?php endforeach; ?>
		
		</fieldset>
	</form>
</section><!-- end profileLikes -->		

<section id="giftList">	
	<h1>All Gift Requests</h1>
	<form>
		<select>
			  <option value="price">Price</option>
			  <option value="name">Name</option>
		</select>
	</form>
	<ul>
	
	<?php $id = $this->db->where('gift_user_id', $proInfo[0]['user_id']);
		$id = $this->db->from('gifts');
		$count = $id->count_all_results();
	?>
		<li>1 - <?php echo $count; ?></li>
		<li><a href="">View All </a></li>
	</ul>
		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>URL <span>(optional)</span></th>
			</tr>
			
		<?php 
		if (is_array($gifts)) {
		foreach ($gifts as $gift): 
			$link= $gift['gift_url']; 
		?> 	
			<tr>
				<td><?php echo $gift['gift_name']; ?></td>
				<td>$<?php echo $gift['gift_price']; ?></td>
				<?php if ($link != '') { ?>
					<td><a href="<?php echo $link; ?>">Link to specific Item</a></td>
				<?php } else { ?>
					<td></td>
				<?php } ?>
			
			</tr>
		<?php endforeach; }
		
		else { ?>	
			<tr>
				<td>No gifts listed yet</td>
				<td>$</td>
				<td></td>
			</tr>		
		<?php }?>
		
		</table>
</section>
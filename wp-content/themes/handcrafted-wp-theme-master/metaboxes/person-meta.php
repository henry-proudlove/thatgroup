<div class="my_meta_control">
	<?php $mb->the_field('job-title'); ?>
		<div>
			<h4>Job Title </h4>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		</div>
		<div>
			<h4>Layout</h4>
		<?php
			$mb->the_field('big-small');
			if(is_null($mb->get_the_value()))
				$mb->meta[$mb->name] = 'small';
		?>
			<div><input type="radio" name="<?php $mb->the_name(); ?>" value="small"<?php echo $mb->is_value('small')?' checked="checked"':''; ?>/><span>Small</span></div>
			
			<div><input type="radio" name="<?php $mb->the_name(); ?>" value="big"<?php echo $mb->is_value('big')?' checked="checked"':''; ?>/><span>Big</span></div>
			
			<label><em>Choose whether person's profile image will be big or small on about page</em><br></label>
		</div>
		<div>
			<h4>Qualifications</strong></h4>
			<?php $options = array('length' => 1, 'limit' => 3); ?>
			<?php while($mb->have_fields_and_multi('reviews', $options)): ?>
			<?php $mb->the_group_open(); ?>
		
				<?php $mb->the_field('quali'); ?>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<a href="#" class="dodelete">Delete Qualification</a>
				<?php $mb->the_group_close(); ?>
			<?php endwhile; ?>
			<label><em>Acronym of Person's Qualification</em><br></label>
			
			<a href="#" class="docopy-reviews button">Add Qualification</a>
		</div>
	
</div>


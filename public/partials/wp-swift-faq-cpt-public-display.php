<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/wp-swift-wordpress-plugins
 * @since      1.0.0
 *
 * @package    Wp_Swift_Faq_Cpt
 * @subpackage Wp_Swift_Faq_Cpt/public/partials
 */
while ( have_posts() ) : the_post(); $post_id = get_the_id(); ?>

    <div class="faq-cpt">

        <?php if ( isset($options['wp_swift_faq_cpt_checkbox_support_featured_image']) && has_post_thumbnail( $post_id ) ) : ?>
            <img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="Image for <?php get_the_title() ?>">
        <?php endif;

		if (isset($options['wp_swift_faq_cpt_checkbox_visibility'])): 
		?>
			<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
		<?php else: ?>
			<h4><?php the_title() ?></h4>
		<?php endif; ?>

			<div class="entry-content"><?php the_content();?></div>

		<?php
		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_attribution'])):
			if ( get_field('attribution') ) : ?>
				<h6 class="attribution"><?php echo get_field('attribution'); ?></h6>
			<?php endif;
		endif;

		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_position_or_status'])):
			if ( get_field('position_or_status') ) : ?>
				<div class="position-or-status"><?php echo get_field('position_or_status'); ?></div>
			<?php endif;
		endif;

		if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_location'])):
			if ( get_field('location') ) : ?>
				<div class="location"><?php echo get_field('location'); ?></div>
			<?php endif;
		endif;

		if (isset($options['wp_swift_faq_cpt_checkbox_visibility'])): ?>
			<div class="read-more"><a href="<?php the_permalink() ?>" class="button">Read More</a></div>
		<?php endif; ?>		

	</div><!-- @end .team-member -->
	<br>

	<?php 
endwhile;
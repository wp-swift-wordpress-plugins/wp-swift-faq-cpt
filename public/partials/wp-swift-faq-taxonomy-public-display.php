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

$question_categories = get_terms( array(
    'taxonomy' => 'question_category',
) );

foreach ($question_categories as $key => $question_category): ?>
<div class="question-category">
	<h3 class="faq-header"><a href="<?php echo get_term_link( $question_category->term_id );; ?>"><?php echo $question_category->name; ?></a></h3>
	
	<?php if ($question_category->description): ?>
		<div class="faq-description"><?php echo $question_category->description ?></div>
	<?php endif;
	
	$posts = get_posts(array(
		'posts_per_page'	=> -1,
		'post_type'			=> 'faq',
		'tax_query' => array(
		    array(
			    'taxonomy' => 'question_category',
			    'field' => 'id',
			    'terms' => $question_category->term_id,
		    ),
		),
	));

	if( $posts ): ?>
		
		<ul class="questions">
			
		<?php foreach( $posts as $post ): 
			
			setup_postdata( $post );
			
			?>
			<li class="question">
				<a class="questions-link" href="<?php echo get_the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
				<?php if ($debug && empty( $post->post_content ) ) echo "<code>// to do</code>"; ?>
				<?php if ($answers): ?>
					<div class="question-answer"><?php echo get_the_content($post->ID, ''); ?></div>
				<?php endif ?>
			</li>
		
		<?php endforeach; ?>
		
		</ul>
		
		<?php wp_reset_postdata(); ?>

	<?php endif;
	endforeach;
	?>
</div><!-- @end .question-category -->

<?php if ($debug): ?>
	<div class="callout warning">
		<h5>// to do</h5>
		<p>Questions with a <code>// to do</code> are currently awaiting to be assigned answers.</p>
		<small>This is temporary feature that will not be visible in production.<br>This can be turned off by changing the WYSIWYG shortcode from <code>[faq-cat to-do="true"]</code> to <code>[faq-cat]</code>.</small>
	</div>
<?php endif;
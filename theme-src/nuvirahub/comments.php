<?php
/**
 * Comments template.
 *
 * @package Nuvirahub
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="nv-glass" style="margin-top:32px">
	<?php if ( have_comments() ) : ?>
		<h3 style="font-family:'Syne',sans-serif;font-size:18px;margin-bottom:20px"><?php echo esc_html( get_comments_number() ); ?> Comments</h3>
		<ul style="list-style:none;margin:0;padding:0">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ul',
					'avatar_size' => 40,
				)
			);
			?>
		</ul>
		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_submit' => 'nv-btn-primary',
		)
	);
	?>
</div>

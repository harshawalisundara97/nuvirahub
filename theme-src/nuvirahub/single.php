<?php
/**
 * Single post template.
 *
 * @package Nuvirahub
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="nv-page-hero nv-reveal">
		<div class="nv-page-hero-bg"></div>
		<div class="nv-tag"><?php the_category( ', ' ); ?></div>
		<h1 style="font-size:clamp(28px,4vw,44px)"><?php the_title(); ?></h1>
		<div class="nv-post-meta" style="justify-content:center;margin-top:16px"><span><?php echo esc_html( get_the_date() ); ?></span><span>&middot;</span><span>By <?php the_author(); ?></span></div>
	</div>

	<article class="nv-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', array( 'style' => 'width:100%;border-radius:16px;margin-bottom:32px' ) ); ?>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div style="margin-top:24px">',
				'after'  => '</div>',
			)
		);
		?>
	</article>

	<div class="nv-section" style="padding-top:0">
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</div>
	<?php
endwhile;

get_footer();

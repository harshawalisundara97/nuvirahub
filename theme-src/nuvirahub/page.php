<?php
/**
 * Generic page template (fallback for pages without a custom template).
 *
 * @package Nuvirahub
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="nv-page-hero nv-reveal">
		<div class="nv-page-hero-bg"></div>
		<h1 style="font-size:clamp(28px,4vw,44px)"><?php the_title(); ?></h1>
	</div>
	<?php $nv_is_woo_page = function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ); ?>
	<article class="<?php echo $nv_is_woo_page ? 'nv-content nv-content-wide' : 'nv-content'; ?>">
		<?php
		the_content();
		wp_link_pages();
		?>
	</article>
	<?php
endwhile;

get_footer();

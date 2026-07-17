<?php
/**
 * Template Name: Nuvirahub Sitemap
 *
 * Human-readable sitemap — every published page, blog post, and product
 * category. Pure WP_Query/get_pages() output, no content dependency.
 *
 * @package Nuvirahub
 */

get_header();

$nv_pages = get_pages(
	array(
		'sort_column' => 'menu_order,post_title',
		'post_status' => 'publish',
	)
);

$nv_posts = get_posts(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 50,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$nv_cats = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
	)
);
if ( is_wp_error( $nv_cats ) ) {
	$nv_cats = array();
}
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Sitemap</div>
	<h1>Every page,<br><span>in one place</span></h1>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-sitemap-grid">
		<div class="nv-sitemap-col">
			<h3>Pages</h3>
			<ul class="nv-sitemap-list">
				<?php foreach ( $nv_pages as $pg ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $pg->ID ) ); ?>"><?php echo esc_html( $pg->post_title ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php if ( ! empty( $nv_cats ) ) : ?>
			<div class="nv-sitemap-col">
				<h3>Shop Categories</h3>
				<ul class="nv-sitemap-list">
					<?php foreach ( $nv_cats as $cat ) : ?>
						<li><a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $nv_posts ) ) : ?>
			<div class="nv-sitemap-col">
				<h3>Blog Posts</h3>
				<ul class="nv-sitemap-list">
					<?php foreach ( $nv_posts as $post_item ) : ?>
						<li><a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>"><?php echo esc_html( get_the_title( $post_item->ID ) ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer();

<?php
/**
 * Archive template (categories, tags, dates, author).
 *
 * @package Nuvirahub
 */

get_header();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Archive</div>
	<h1 style="font-size:clamp(28px,4vw,44px)"><?php the_archive_title(); ?></h1>
</div>

<div class="nv-section">
	<?php
	$nv_blog_cats = get_categories( array( 'number' => 8 ) );
	if ( $nv_blog_cats ) :
		?>
		<div class="nv-tabs nv-reveal" role="tablist" style="margin:0 auto 32px;justify-self:center;flex-wrap:wrap">
			<a class="nv-tabp<?php echo ( ! is_category() ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">All</a>
			<?php foreach ( $nv_blog_cats as $nv_bc ) : ?>
				<a class="nv-tabp<?php echo is_category( $nv_bc->term_id ) ? ' active' : ''; ?>" href="<?php echo esc_url( get_category_link( $nv_bc->term_id ) ); ?>"><?php echo esc_html( $nv_bc->name ); ?></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="nv-blog nv-reveal">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div style="height:160px;overflow:hidden;border-bottom:1px solid var(--border)"><?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%;height:100%;object-fit:cover' ) ); ?></div>
						<?php else : ?>
							<div class="nv-blog-thumb">&#9998;</div>
						<?php endif; ?>
					</a>
					<div class="nv-blog-body">
						<div class="nv-blog-meta"><span><?php echo esc_html( get_the_date() ); ?></span></div>
						<h3 class="nv-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="nv-blog-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<a class="nv-read-more" href="<?php the_permalink(); ?>">Read article &rarr;</a>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<div style="margin-top:40px"><?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?></div>
	<?php else : ?>
		<div class="nv-glass">Nothing found in this archive.</div>
	<?php endif; ?>
</div>

<?php
get_footer();

<?php
/**
 * Main index / blog listing template.
 *
 * @package Nuvirahub
 */

get_header();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Insights</div>
	<h1>Thoughts on<br><span>design &amp; growth</span></h1>
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

	<div style="display:grid;grid-template-columns:2fr 1fr;gap:32px;align-items:start" class="nv-blog-layout">
		<div>
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
								<div class="nv-blog-meta"><span><?php echo esc_html( get_the_date() ); ?></span><span>&middot;</span><span><?php the_category( ', ' ); ?></span></div>
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
				<div class="nv-glass">No posts yet. Once you publish your first blog post, it will appear here automatically.</div>
			<?php endif; ?>
		</div>

		<aside style="display:flex;flex-direction:column;gap:20px">
			<div class="nv-glass">
				<h4 style="font-family:'Syne',sans-serif;font-size:15px;font-weight:600;margin-bottom:16px">Categories</h4>
				<div style="display:flex;flex-direction:column;gap:8px">
					<?php
					$cats = get_categories( array( 'number' => 6 ) );
					if ( $cats ) {
						foreach ( $cats as $cat ) {
							echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" style="display:flex;justify-content:space-between;font-size:13px;padding:8px 0;border-bottom:1px solid var(--border);color:var(--muted2)"><span>' . esc_html( $cat->name ) . '</span><span style="color:var(--accent2)">' . esc_html( $cat->count ) . '</span></a>';
						}
					} else {
						echo '<span style="font-size:13px;color:var(--muted)">No categories yet.</span>';
					}
					?>
				</div>
			</div>
			<div class="nv-glass">
				<h4 style="font-family:'Syne',sans-serif;font-size:15px;font-weight:600;margin-bottom:12px">Newsletter</h4>
				<p style="font-size:12px;color:var(--muted2);margin-bottom:14px">Get our best content monthly &mdash; no spam.</p>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="nuvirahub_newsletter">
					<?php wp_nonce_field( 'nuvirahub_newsletter', 'nuvirahub_newsletter_nonce' ); ?>
					<input type="email" name="nv_newsletter_email" placeholder="Your email" required style="width:100%;background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:8px;padding:9px 12px;font-size:13px;color:var(--text);font-family:'DM Sans',sans-serif;outline:none;margin-bottom:10px;box-sizing:border-box">
					<button class="nv-btn-primary" style="width:100%;padding:9px;font-size:13px" type="submit">Subscribe</button>
				</form>
			</div>
		</aside>
	</div>
</div>

<?php
get_footer();

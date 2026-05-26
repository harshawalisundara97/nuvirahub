<?php
/**
 * Header template.
 *
 * @package Nuvirahub
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="nv-nav" id="nv-nav">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nv-logo">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Nuvirahub' );
		}
		?>
	</a>

	<button class="nv-toggle" id="nv-toggle" aria-label="Menu">&#9776;</button>

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nv-links',
			)
		);
	} else {
		nuvirahub_fallback_menu();
	}
	?>

	<?php
	$contact = nuvirahub_get_page_by_title( 'Contact' );
	$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
	?>
	<a href="<?php echo esc_url( $contact_url ); ?>" class="nv-cta">Get Started</a>
</nav>

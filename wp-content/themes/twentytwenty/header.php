<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/custom.css" type="text/css" media="screen" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://use.fontawesome.com/76ae660831.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.web-fonts.ge/fonts/bpg-nino-mtavruli/css/bpg-nino-mtavruli.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
wp_body_open();
?>

<header id="site-header" class="header-footer-group" role="banner">

    <div class="header-inner section-inner">

        <div class="header-titles-wrapper">

            <?php

            // Check whether the header search is activated in the customizer.
            $enable_header_search = get_theme_mod( 'enable_header_search', true );
            ?>

            <div class="header-titles">

                <?php
                // Site title or logo.
                twentytwenty_site_logo();

                ?>

            </div><!-- .header-titles -->

            <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
            </button><!-- .nav-toggle -->

        </div><!-- .header-titles-wrapper -->

        <div class="header-navigation-wrapper">

            <?php
            if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
                ?>

                <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">

                    <ul class="primary-menu reset-list-style">

                        <?php
                        if ( has_nav_menu( 'primary' ) ) {

                            wp_nav_menu(
                                array(
                                    'container'  => '',
                                    'items_wrap' => '%3$s',
                                    'theme_location' => 'primary',
                                )
                            );

                        } elseif ( ! has_nav_menu( 'expanded' ) ) {

                            wp_list_pages(
                                array(
                                    'match_menu_classes' => true,
                                    'show_sub_menu_icons' => true,
                                    'title_li' => false,
                                    'walker'   => new TwentyTwenty_Walker_Page(),
                                )
                            );

                        }
                        ?>

                    </ul>

                </nav><!-- .primary-menu-wrapper -->

                <?php
            }

            ?>

        </div><!-- .header-navigation-wrapper -->

    </div><!-- .header-inner -->

    <?php
    // Output the search modal (if it is activated in the customizer).
    if ( true === $enable_header_search ) {
        get_template_part( 'template-parts/modal-search' );
    }
    ?>

</header><!-- #site-header -->

<?php
// Output the menu modal.
get_template_part( 'template-parts/modal-menu' );

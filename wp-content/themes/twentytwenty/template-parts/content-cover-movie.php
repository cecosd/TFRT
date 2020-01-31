<?php
/**
 * Displays the content when the cover template is used.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="border-top cover-header<?php echo $cover_header_classes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>"<?php echo $cover_header_style; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) ?>>
        <div class="cover-header-inner-wrapper">
            <div class="cover-header-inner-movie">
                <div class="cover-color-overlay"></div>

                <header class="entry-header has-text-align-center">
                    <div class="w-25 d-inline">
                        <?php
                        $movie_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        ?>
                            <?php if( $movie_img ) : ?>
                            <img src="<?php echo $movie_img; ?>" />
                            <?php endif; ?>
                    </div>
                    <div class="entry-header-inner w-75 d-inline section-inner medium vertical-top">

                        <?php

                        /**
                         * Allow child themes and plugins to filter the display of the categories in the article header.
                         *
                         * @since 1.0.0
                         *
                         * @param bool Whether to show the categories in article header, Default true.
                         */
                        $show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

                        if ( true === $show_categories && has_category() ) {
                            ?>
                            <div class="entry-categories mx-2">
                                <div class="entry-categories-inner float-left">
                                    <?php the_category( ' ' ); ?>
                                </div><!-- .entry-categories-inner -->
                            </div><!-- .entry-categories --><br>
                            <?php
                        }

                        the_title( '<h1 class="entry-title text-black text-left w-100 float-left mx-2">', '</h1>' );
                        ?>
                        <?php
                        $release =
                        $dd = _e('Director', 'twentytwenty');
                        $description = get_post_meta($post->ID, 'prefix_taskdescription', true);
                        $year = get_post_meta($post->ID, 'prefix_taskyear', true);
                        $rating = get_post_meta($post->ID, 'prefix_taskimdb', true);
                        $director = get_post_meta($post->ID, 'prefix_taskdirector', true);
                        echo '<h3 class="text-left float-left text-black size-normal ml-2 w-100">'; _e('Year of release', 'twentytwenty'); echo': ' .$year. '</h3>';
                        echo '<p class="text-left w-50 ml-2 float-left text-black size-normal">'; _e('Director', 'twentytwenty'); echo': ' .$director. '</p>';
                        echo '<p class="text-left w-50 float-left text-black size-normal"><i class="fa fa-imdb text-black" aria-hidden="true"></i> ' .$rating. '</p>';
                            echo '<p class="text-left size-normal float-left text-black mx-2">ISBN: ' . $description . '</p>';

                        ?>

                    </div><!-- .entry-header-inner -->
                </header><!-- .entry-header -->
                <?php
                the_content();
                ?>
            </div><!-- .cover-header-inner -->
        </div><!-- .cover-header-inner-wrapper -->
    </div><!-- .cover-header -->
</article><!-- .post -->

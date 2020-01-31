<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
    <h3 class="text-center"><?php echo single_cat_title(); ?></h3>
    <div class="box-container">
        <?php
        $category = get_queried_object();
        $cat = $category->term_id;
        $args = array(
            'post_type'=> 'movie',
            'order'    => 'ASC',
            'cat' => $cat
        );
        $lang = pll_default_language($value);

        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
            $year = get_post_meta($post->ID, 'prefix_taskyear', true);
            $description = get_post_meta($post->ID, 'prefix_taskdescription', true);


            ?>

            <a href="<?php echo get_permalink(); ?>" class="none-decor"><div class="movie-box">
                    <?php get_template_part( 'template-parts/featured-image' ); ?>
                    <h4><?php echo get_the_title(); ?></h4>
                    <p><b><?php echo $year; ?></b></p>
                    <p><?php echo $description; ?></p>
                </div></a>

            <?php get_template_part( 'template-parts/pagination' ); ?>

        <?php endwhile; ?>

        <?php else: ?>
            <h1><?php _e( 'No movies here!', 'twentytwenty' ); ?></h1>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>

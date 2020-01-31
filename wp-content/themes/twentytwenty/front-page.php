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
$path=$_SERVER['REQUEST_URI'];
?>

<main id="site-content" role="main">
    <form action="<?php echo get_site_url().$path=$_SERVER['REQUEST_URI']; ?>" method="POST" id="filter">
        <?php

        $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) );

            echo '<select name="categoryfilter" class="w-7 select-cat">';
        if (isset($_POST['categoryfilter'])){
            echo '<option value="'.$_POST['categoryfilter'].'">'.get_cat_name( $category_id = $_POST['categoryfilter'] ).'</option>';
        }
        else{
            echo '<option>';_e( 'Category', 'twentytwenty' );echo'</option>';
        }
            foreach ( $terms as $term ) :
                echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
            endforeach;
            echo '</select>';


        ?>
        <input class="w-7" type="text" <?php  if (isset($_POST['year_min'])){echo'value="'.$_POST['year_min'].'"';} ?> name="year_min" placeholder="<?php _e( 'Min Year', 'twentytwenty' ); ?>" />
        <input class="w-7" type="text" <?php  if (isset($_POST['year_max'])){echo'value="'.$_POST['year_max'].'"';} ?> name="year_max" placeholder="<?php _e( 'Max Year', 'twentytwenty' ); ?>" />
        <label class="w-7">
            <input type="radio" <?php  if ($_POST['date'] == "ASC"){echo'checked';} ?> name="date" value="ASC" /> <?php _e( 'Date: Ascending', 'twentytwenty' ); ?>
        </label>
        <label class="w-7">
            <input type="radio" <?php  if ($_POST['date'] == "DESC"){echo'checked';} ?> name="date" value="DESC" selected="selected" /><?php _e( 'Date: Descending', 'twentytwenty' ); ?>
        </label>
        <button class="w-7"><?php _e( 'Apply Filter', 'twentytwenty' ); ?></button>
        <input type="hidden" name="lang" value="<?php echo pll_current_language(); ?>">
        <input type="hidden" name="action" value="myfilter">
    </form>
    <div class="box-container" id="response">
        <div class="swiper-container">
            <div class="swiper-wrapper" id="response">
                <?php
                $args = array(
                    'post_type'=> 'movie',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'lang' => $_POST['lang'],
                    'order'	=> $_POST['date'] // ASC or DESC
                );

                if( isset( $_POST['categoryfilter'] ) ){
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $_POST['categoryfilter']
                        )
                    );
                }

                if( isset( $_POST['year_min'] ) && $_POST['year_min'] || isset( $_POST['year_max'] ) && $_POST['year_max'] || isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' )
                    $args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true


                if( isset( $_POST['year_min'] ) && $_POST['year_min'] && isset( $_POST['year_max'] ) && $_POST['year_max'] ) {
                    $args['meta_query'][] = array(
                        'key' => 'prefix_taskyear',
                        'value' => array( $_POST['year_min'], $_POST['year_max'] ),
                        'type' => 'numeric',
                        'compare' => 'between'
                    );
                } else {

                    if( isset( $_POST['year_min'] ) && $_POST['year_min'] )
                        $args['meta_query'][] = array(
                            'key' => 'prefix_taskyear',
                            'value' => $_POST['year_min'],
                            'type' => 'numeric',
                            'compare' => '>'
                        );


                    if( isset( $_POST['year_max'] ) && $_POST['year_max'] )
                        $args['meta_query'][] = array(
                            'key' => 'prefix_taskyear',
                            'value' => $_POST['year_max'],
                            'type' => 'numeric',
                            'compare' => '<'
                        );
                }

                $the_query = new WP_Query( $args );
                if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

                    $year = get_post_meta($post->ID, 'prefix_taskyear', true);
                    $description = get_post_meta($post->ID, 'prefix_taskdescription', true);
                    $post_slug = $post->post_name;
                    ?><div class="swiper-slide">
                    <a href="<?php echo pll_current_language().'/'.$post_slug; ?>" class="none-decor"><div class="movie-box">
                            <?php get_template_part( 'template-parts/featured-image' ); ?>
                            <h4><?php echo get_the_title(); ?></h4>
                            <p><b><?php echo $year; ?></b></p>
                            <p><?php echo $description; ?></p>
                        </div></a>
                    </div>

                <?php endwhile; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <?php get_template_part( 'template-parts/pagination' ); ?>
        <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <h1><?php _e( 'No movies here!', 'twentytwenty' ); ?></h1>
        <?php endif; ?>
    </div>
</main><!-- #site-content -->
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<script>
    jQuery(function($){
        $('#filter').submit(function(){
            var filter = $('#filter');

            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(), // form data
                type:filter.attr('method'), // POST
                beforeSend:function(xhr){
                    filter.find('button').text('<?php _e( 'Processing...', 'twentytwenty' ); ?>');
                    },
                success:function(data){
                    filter.find('button').text('<?php _e( 'Apply Filter', 'twentytwenty' ); ?>');
                    $('body').html(data);

                }
            });
            return false;
        });
    });
</script>
<?php get_footer(); ?>

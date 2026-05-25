<?php
/**
 * The main template file
 *
 * @package starbiz
 */

get_header(); ?>

<div class="container site-main-padding">
<div class="row">
    <div class="col-md-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title mb-3">
                            <a href="<?php the_permalink(); ?>" class="entry-title-link"><?php the_title(); ?></a>
                        </h2>
                    </header>

                    <div class="entry-content">
                        <?php
                        if ( is_home() || is_archive() ) {
                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                </article>
            <?php endwhile;

            // Pagination
            the_posts_pagination( array(
                'prev_text' => __( 'Previous', 'starbiz' ),
                'next_text' => __( 'Next', 'starbiz' ),
            ) );

        else :
            echo '<p>' . __( 'No posts found.', 'starbiz' ) . '</p>';
        endif;
        ?>
    </div>

    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>
</div>
</div>

<?php get_footer(); ?>

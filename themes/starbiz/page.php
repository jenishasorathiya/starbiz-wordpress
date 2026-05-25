<?php
/**
 * Template for displaying pages
 *
 * @package starbiz
 */

get_header(); ?>

<div class="container">
<div class="row">
    <div class="col-md-12">
        <?php
        while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
                <header class="entry-header mb-3">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php
            // If comments are open or at least one comment, load comment template
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        endwhile;
        ?>
    </div>
</div>
</div>

<?php get_footer(); ?>

<?php

/**
 * The single blog page
 *
 * @package starbiz
 */

get_header(); ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail( 'large', ['class' => 'img-fluid rounded shadow'] ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Title -->
                    <h1 class="mb-3 fw-bold"><?php the_title(); ?></h1>

                    <!-- Meta Info -->
                    <div class="text-muted mb-4 small">
                        <span class="me-3"><i class="bi bi-person"></i> <?php the_author(); ?></span>
                        <span class="me-3"><i class="bi bi-calendar-event"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="bi bi-chat"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
                    </div>

                    <div class="post-excerpt mb-4">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-2">Read More</a>
                    </div>

                    <!-- Content -->
                    <div class="post-content mb-5">
                        <?php the_content(); ?>
                    </div>

                    <!-- Categories & Tags -->
                    <div class="mb-4">
                        <strong>Categories:</strong> <?php the_category( ', ' ); ?><br>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>

    </div>
</div>

<?php get_footer(); ?>
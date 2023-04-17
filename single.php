<?php
get_header(); ?>

    <div class="container-fluid px-0 single-page">
        <div class="row">
            <?php while( have_posts() ): ?>
                <div class="single-page-feature">
                    <?php if ( has_post_thumbnail() ) :
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>

                        <img
                                src="<?=$featured_image[0]?>"
                                loading="lazy"
                                alt="<?=the_title()?>"
                        />

                        <div class="container">
                            <h1>
                                <?=the_title()?>
                            </h1>
                        </div>
                    <?php endif; ?>
                </div>

                <?php the_post(); ?>

                <div class="container">
                    <div class="row gy-5">
                        <div class="single-page-info col-md-3 order-last order-md-first">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) : ?>
                                <div class="category">
                                    <strong>Kategorie</strong> | <?=the_category()?>
                                </div>
                            <?php endif; ?>
                            <div class="date">
                                <strong>Publikováno</strong> | <?=the_date()?>
                            </div>
                            <div class="author">
                                <strong>Autor</strong> |
                                <?=get_avatar( get_the_author_meta('ID'), 100 )?>

                                <a
                                    href="<?=esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"
                                    class="author-archive">
                                    <?=the_author()?>
                                </a>
                            </div>
                        </div>

                        <div class="single-page-content col-md-8">
                            <?=the_content()?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

<?php
get_footer();

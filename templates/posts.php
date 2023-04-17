<?php

/**
 * Template Name: Výpis příspěvků
 */

get_header(); ?>

    <div class="container blog">
        <div class="row gy-5 align-items-start">

            <?php require get_theme_file_path( 'components/breadcrumbs.php' ); ?>

            <?php
            $args = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );

            function get_excerpt(){
                $page_object = get_page( $post->ID );
                $content = explode('<!--more-->', $page_object->post_content);
                return "<p>$content[0]</p>";
            }

            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-4 blog-item">
                        <?=the_post_thumbnail('full')?>

                        <a href="<?=the_permalink()?>">
                            <h3>
                                <?=the_title()?>
                            </h3>
                        </a>

                        <?=get_excerpt()?>

                        <a href="<?=the_permalink()?>" class="button button-primary">
                            Zobrazit více
                        </a>
                    </div>
                <?php endwhile;endif; ?>
        </div>
    </div>

<?php
get_footer();

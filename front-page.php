<?php
get_header();

include 'components/hero.php'; ?>

    <div class="container blog">
        <div class="row gy-5 align-items-start">
            <?php
            $args = array(
                'posts_per_page' => 3,
                'offset' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );

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

                        <?php
                            $content = get_the_content();
                            $content = strip_tags($content);
                            echo '<p>'. substr($content, 0, 100) . '</p>';
                        ?>

                        <a href="<?=the_permalink()?>" class="button button-secondary">
                            Zobrazit více
                        </a>
                    </div>
                <?php endwhile;endif; ?>
        </div>
    </div>

<?php
get_footer();

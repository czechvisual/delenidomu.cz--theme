<div id="about" class="about container">
    <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col-12 col-md-6">
                <img src="<?=get_template_directory_uri() . '/assets/img/about_image.svg'?>" alt="<?=get_the_title()?>" loading="lazy">
            </div>

            <div class="col-12 col-md-6 about-content">
                <?php
                $about = get_field('about'); ?>

                <h1>
                    <?=$about['title']?>
                </h1>

                <h5>
                    <?=$about['description']?>
                </h5>
            </div>

        <?php endwhile; ?>
    </div>

    <div class="row mt-5">

        <?php
        $args = array(
            'post_type' => 'Team',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC'
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            $counter = 1;
            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="col">
                    <div class="about-item">
                        <?php
                        $image = get_field('photo');
                        $url = $image['url'];
                        $alt = $image['alt']; ?>

                        <div class="about-item-header">
                            <img src="<?php echo esc_url($url); ?>" loading="lazy" alt="<?php echo esc_attr($alt); ?>"/>

                            <div>
                                <h4 class="title">
                                    <?=get_the_title()?>
                                </h4>

                                <div class="job">
                                    <?=the_field('job')?>
                                </div>
                            </div>
                        </div>

                        <p>
                            <?=get_the_content()?>
                        </p>
                    </div>
                </div>

        <?php endwhile;endif; ?>

    </div>
</div>

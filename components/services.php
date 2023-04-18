<div id="services" class="services container">
    <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col text-center">
                <?php
                $services = get_field('services'); ?>

                <h1>
                    <?=$services['title']?>
                </h1>

                <h5>
                    <?=$services['description']?>
                </h5>
            </div>

        <?php endwhile; ?>
    </div>

    <div class="row mt-5 gy-4">

        <?php
        $args = array(
            'post_type' => 'Services',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC'
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="services-item">
                        <img src="<?=get_the_post_thumbnail_url()?>" loading="lazy" alt="<?=get_the_title()?>"/>

                        <div class="services-item-content">
                            <h4 class="title">
                                <?=get_the_title()?>
                            </h4>

                            <p>
                                <?=get_the_content()?>
                            </p>
                        </div>
                    </div>
                </div>

        <?php endwhile;endif; ?>

    </div>
</div>

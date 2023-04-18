<div id="contact" class="contact container">
    <div class="row gy-5">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col-12 col-md-6 contact-content">
                <?php
                $about = get_field('contact'); ?>

                <h1 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
                    <?=$about['title']?>
                </h1>

                <h5>
                    <?=$about['description']?>
                </h5>

                <h5 class="email">
                    <?=$about['email']?>
                </h5>

                <h5 class="phone">
                    <?=$about['phone']?>
                </h5>
            </div>

            <div class="col-12 col-md-6 d form-container wow slideInRight" data-wow-duration="1s" data-wow-offset="10">
                <?=do_shortcode('[contact-form-7 id="111" title="Poptávkový formulář"]')?>
            </div>

        <?php endwhile; ?>
    </div>

    <div class="row gy-4 mt-5">

        <?php
        $args = array(
            'post_type' => 'Team',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC'
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="col">
                    <div class="contact-item">
                        <div class="contact-item-header">
                            <img src="<?=get_the_post_thumbnail_url()?>" loading="lazy" alt="<?=get_the_title()?>"/>

                            <div>
                                <h4 class="title">
                                    <?=get_the_title()?>
                                </h4>

                                <div class="job">
                                    <?=the_field('job')?>
                                </div>
                            </div>
                        </div>

                        <?php
                        $contact_info = get_field('contact_info');
                        ?>

                        <ul>
                            <li class="address">
                                <?=$contact_info['address']?>
                            </li>

                            <li class="email">
                                <?=$contact_info['email']?>
                            </li>

                            <li class="phone">
                                <?=$contact_info['phone']?>
                            </li>

                            <li class="website">
                                <?=$contact_info['website']?>
                            </li>
                        </ul>
                    </div>
                </div>

        <?php endwhile;endif; ?>

    </div>
</div>

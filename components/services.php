<div id="services" class="services container">
    <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col text-center">
                <?php
                $services = get_field('services'); ?>

                <h1 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
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

<div id="services" class="services-banner container-fluid">
    <div class="row">
        <div class="container text-center">

            <h3 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
                Snažíme se vždy o nalezení řešení na míru zohledňující individuální potřeby klienta.
            </h3>

            <p>

                <?php
                $sub_services = array('Prohlášení vlastníka', 'změna prohlášení vlastníka', 'dohoda o změně práv a povinností', 'odstranění vad prohlášení vlastníka', 'prohlášení vlastníka dotčených jednotek', 'smlouva o výstavbě', 'střešní nástavba', 'půdní vestavba', 'stavební úpravy domů', 'dělení jednotek', 'slučování jednotek', 'rozšiřování jednotek', 'změny jednotek', 'stavební úpravy jednotek', 'likvidace', 'bytové spoluvlastnictví', 'práva a povinnosti vlastníků jednotek');

                foreach($sub_services as $value): ?>


                    <?=$value?> <span>.</span>

                <?php endforeach; ?>

            </p>
        </div>
    </div>
</div>

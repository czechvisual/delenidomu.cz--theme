<div class="services-for container">
    <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col text-center">
                <h1 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
                    Komu jsou služby určeny?
                </h1>
            </div>

        <?php endwhile; ?>
    </div>

    <div class="row mt-5 gy-4">

        <?php
        $services_for = array(
            '01' => array(
                'image'  => '/assets/img/services_for/services_number_01.svg',
                'title'  => 'Vlastníci a spoluvlastníci nemovitostí',
            ),
            '02' => array(
                'image'  => '/assets/img/services_for/services_number_02.svg',
                'title'  => 'Developeři',
            ),
            '03' => array(
                'image'  => '/assets/img/services_for/services_number_03.svg',
                'title'  => 'Bytová družstva, společenství vlastníků jednotek',
            ),
            '04' => array(
                'image'  => '/assets/img/services_for/services_number_04.svg',
                'title'  => 'Advokátní kanceláře, advokáti, notáři a další',
            )
        );

        foreach($services_for as $parameter => $values): ?>

                <div class="col-12 col-md-6">
                    <div class="services-for-item">
                        <img src="<?= get_template_directory_uri() . $values['image'] ?>" loading="lazy" alt="<?= $values['title'] ?>" />

                        <h5 class="title">
                            <?= $values['title'] ?>
                        </h5>
                    </div>
                </div>

        <?php endforeach; ?>

    </div>
</div>

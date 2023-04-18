<div class="price container-fluid">
    <div class="container">
        <div class="row">

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="col-12 price-content">
                    <?php
                    $price = get_field('price'); ?>

                    <h1 class="wow slideInRight" data-wow-duration="1s" data-wow-offset="10">
                        <?=$price['title']?>
                    </h1>

                    <h5>
                        <?=$price['description']?>
                    </h5>
                </div>

            <?php endwhile; ?>

        </div>
    </div>
</div>

<div id="reference" class="reference container">
    <div class="row">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col text-center">
                <h1 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
                    Reference
                </h1>
            </div>

        <?php endwhile; ?>
    </div>

    <div class="row mt-5 gy-4 align-items-start reference-carousel owl-carousel owl-theme">

        <?php
        $args = array(
            'post_type' => 'Reference',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC'
        );

        $overlay_images = array(
            get_template_directory_uri() . '/assets/img/reference_overlay/overlay_01.svg',
            get_template_directory_uri() . '/assets/img/reference_overlay/overlay_02.svg',
            get_template_directory_uri() . '/assets/img/reference_overlay/overlay_03.svg',
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <?php $random_image = $overlay_images[array_rand($overlay_images)]; ?>

                <div class="reference-item">
                    <?php
                    $noimg = get_template_directory_uri() . '/assets/img/noimg.svg';
                    $condition = (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url(): $noimg; ?>

                        <img src="<?=$condition?>" class="feature" loading="lazy" alt="<?=get_the_title()?>"/>

                        <img src="<?=$random_image?>" class="feature overlay" loading="lazy"/>

                    <div class="reference-item-content">
                        <h3 class="title">
                            <?=the_field('type')?>
                        </h3>

                        <h5 class="subtitle">
                            <?=get_the_title()?>
                        </h5>

                        <p>
                            <?=get_the_content()?>
                        </p>

                        <a href="<?=the_field('link')?>">
                            Zobrazit více
                        </a>
                    </div>
                </div>

        <?php endwhile;endif; ?>

    </div>
</div>


<script>
  jQuery(document).ready(function(){
    jQuery(".reference-carousel").owlCarousel(
      {
        center: false,
        items: 1,
        lazyLoad: true,
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 450,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      }
    );
  });
</script>

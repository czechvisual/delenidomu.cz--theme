<div class="features container-fluid">
    <div class="container">
        <div class="row align-items-start features-carousel owl-carousel owl-theme">

            <?php
            $args = array(
                'post_type' => 'Features',
                'posts_per_page' => -1,
                'orderby' => 'post_date',
                'order' => 'ASC'
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) :
                $counter = 1;
                while ($query->have_posts()) : $query->the_post(); ?>

                    <div class="col features-item">
                        <span><?= $counter ?></span>

                        <h4 class="title"><?=get_the_title()?></h4>

                        <p>
                            <?=get_the_content()?>
                        </p>
                    </div>

            <?php $counter++; endwhile;endif;wp_reset_postdata(); ?>

        </div>
    </div>
</div>

<script>
  jQuery(document).ready(function(){
    jQuery(".features-carousel").owlCarousel(
      {
        center: false,
        items: 1,
        lazyLoad: true,
        loop: false,
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
            items: 3
          },
          1000: {
            items: 4
          }
        }
      }
    );
  });
</script>

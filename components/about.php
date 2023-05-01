<div id="about" class="about container">
    <div class="row gy-5">

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="col-12 col-md-6">
                <div id="video-container" class="video-container">
                    <canvas id="animation"></canvas>
                </div>

                <script>
                  const html = document.documentElement;
                  const canvas = document.getElementById("animation");
                  const context = canvas.getContext("2d");

                  const frameCount = 90;
                  const currentFrame = index => (
                    `<?=get_template_directory_uri() . '/assets/img/about_sequence/'?>${index.toString().padStart(4, '0')}.webp`
                  )

                  const preloadImages = () => {
                    for (let i = 1; i < frameCount; i++) {
                      const img = new Image();
                      img.src = currentFrame(i);
                    }
                  };

                  const img = new Image()
                  img.src = currentFrame(1);
                  canvas.width=2000;
                  canvas.height=2000;
                  img.onload=function(){
                    context.drawImage(img, 0, 0);
                  }

                  const updateImage = index => {
                    img.src = currentFrame(index);
                    context.drawImage(img, 0, 0);
                  }

                  // Výpočet limitů
                  const widthDevice = window.innerWidth;

                  var minimal;
                  var maximal;

                  if (widthDevice < 768) {
                    minimal = 300;
                    maximal = 6200;
                  } else if (widthDevice < 900) {
                    minimal = 300;
                    maximal = 3700;
                  } else if (widthDevice < 1024) {
                    minimal = 300;
                    maximal = 4400;
                  } else if (widthDevice < 1200) {
                    minimal = 300;
                    maximal = 4100;
                  } else if (widthDevice < 1440) {
                    minimal = 300;
                    maximal = 3900;
                  } else {
                    minimal = 300;
                    maximal = 3900;
                  }

                  const limits = {
                    minimal: minimal,
                    maximal: maximal
                  }

                  const minimalLimit = minimal;
                  const maximalLimit = maximal ;

                  window.addEventListener('scroll', () => {
                    const scrollTop = html.scrollTop - minimalLimit;
                    const maxScrollTop = html.scrollHeight - window.innerHeight - maximalLimit;
                    const scrollFraction = scrollTop / maxScrollTop;
                    const frameIndex = Math.min(
                      frameCount - 1,
                      Math.ceil(scrollFraction * frameCount)
                    );

                    requestAnimationFrame(() => updateImage(frameIndex + 1))
                  });

                  preloadImages()
                </script>

            </div>

            <div class="col-12 col-md-6 about-content">
                <?php
                $about = get_field('about'); ?>

                <h1 class="wow slideInRight" data-wow-duration="1s" data-wow-offset="10">
                    <?=$about['title']?>
                </h1>

                <h5>
                    <?=$about['description']?>
                </h5>
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
                    <div class="about-item">
                        <div class="about-item-header">
                            <?php if ( has_post_thumbnail() ): ?>

                                <img src="<?=get_the_post_thumbnail_url()?>" loading="lazy" alt="<?=get_the_title()?>"/>

                            <?php endif; ?>

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

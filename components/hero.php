<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <!--<div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></button>
    </div>-->

    <div class="carousel-inner">
        <?php
            $c = 0;
            $args = array( 'post_type' => 'carousel', 'posts_per_page' => 5 );
            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
            $c++;
            $class = ($c == 1) ? 'active' : '';
        ?>
            <div class="hero carousel-item <?php echo $class; ?>">
                <?php
                $image = get_field('background_image');
                $image_mobile = get_field('background_image_mobile');
                $url = $image['url'];
                $url_mobile = $image_mobile['url'];
                $alt = $image['alt']; ?>

                    <img
                        src="<?=esc_url($url)?>"
                        class="animate__animated animate__pulse hide-on-mobile"
                        loading="lazy"
                        alt="<?=esc_attr($alt)?>"
                    />

                    <img
                        src="<?=esc_url($url_mobile)?>"
                        class="animate__animated animate__pulse hide-on-desktop"
                        loading="lazy"
                        alt="<?=esc_attr($alt)?>"
                    />

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1 class="wow slideInLeft" data-wow-duration="1s" data-wow-offset="10">
                                <?=get_the_title()?>
                            </h1>

                            <?=the_content()?>

                            <?php
                            $link = get_field('button');

                            if( $link ):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                <a
                                    href="<?=esc_url( $link_url )?>"
                                    class="button button-medium button-primary wow fadeInUp"
                                    data-wow-duration="1s"
                                    target="<?=esc_attr( $link_target )?>">
                                    <?=esc_html( $link_title )?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Předchozí</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Následující</span>
    </button>-->
</div>

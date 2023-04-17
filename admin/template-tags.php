<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Šablona_na_míru
 */

if (!function_exists('dv_post_meta_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function dv_post_meta_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		echo $time_string; // WPCS: XSS OK.
	}
endif;

if (!function_exists('dv_post_meta_categories')) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function dv_post_meta_categories()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'dv'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="post__meta-category-links">%1$s</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'dv'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="post__meta-tags-links">%1$s</span>', $tags_list); // WPCS: XSS OK.
			}
		}
	}
endif;

if (!function_exists('dv_post_meta_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function dv_post_meta_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'dv'),
			'<span class="post__author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="post__byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('dv_post_meta_separator')) :
	/**
	 * Prints post meta separator.
	 */
	function dv_post_meta_separator()
	{
		echo '<span class="post__meta-separator">|</span>';
	}
endif;

if (!function_exists('dv_post_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function dv_post_footer()
	{
		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<footer class="post__footer">';
			echo '<span class="post__comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dv'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
			echo '</footer>';
		}

		// edit_post_link(
		// 	sprintf(
		// 		wp_kses(
		// 			/* translators: %s: Name of current post. Only visible to screen readers */
		// 			__( 'Edit <span class="screen-reader-text">%s</span>', 'dv' ),
		// 			array(
		// 				'span' => array(
		// 					'class' => array(),
		// 				),
		// 			)
		// 		),
		// 		get_the_title()
		// 	),
		// 	'<span class="post__edit-link">',
		// 	'</span>'
		// );
	}
endif;

if (!function_exists('dv_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function dv_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post__thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post__thumbnail -->

		<?php else : ?>

			<a class="post__thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail('post__thumbnail', array(
					'alt' => the_title_attribute(array(
						'echo' => false,
					)),
				));
				?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('dv_get_offer_state')) :
	/*
	*
	* Prints offer state.
	*
	*/
	function dv_get_offer_state()
	{
		date_default_timezone_set('Europe/Prague');
		$current_date = new DateTime();
		// $current_date_readable = $current_date->format('Ymd');

		$start_date_string = get_field('datum_zacatku_akce') + 1; // + 1 offset fix
		$start_date = DateTime::createFromFormat('Ymd', $start_date_string);

		$end_date_string = get_field('datum_ukonceni_akce') + 1; // + 1 offset fix
		$end_date = DateTime::createFromFormat('Ymd', $end_date_string);

		$manually_set = get_field('manualne_prenastavit_stav_akce');

		if ($manually_set && in_category('akce')) :
			if ($manually_set == 'Akce právě probíhá') :
				return 'Akce právě probíhá';
			elseif ($manually_set == 'Akce brzy začne') :
				return 'Akce brzy začne<';
			elseif ($manually_set == 'Akce ukončena') :
				return 'Akce ukončena';
			endif;

		elseif (($start_date_string || $end_date_string) && in_category('akce')) :
			if ($start_date <= $current_date && $current_date <= $end_date) :
				return 'Akce právě probíhá<';
			elseif ($start_date > $current_date) :
				return 'Akce brzy začne';
			elseif ($current_date > $end_date) :
				return 'Akce ukončena';
			endif;
		endif;
	}
endif;

if (!function_exists('dv_offer_state')) :
	/*
	*
	* Prints offer state.
	*
	*/
	function dv_offer_state()
	{
		date_default_timezone_set('Europe/Prague');
		$current_date = new DateTime();
		// $current_date_readable = $current_date->format('Ymd');

		$start_date_string = get_field('datum_zacatku_akce') + 1; // + 1 offset fix
		$start_date = DateTime::createFromFormat('Ymd', $start_date_string);

		$end_date_string = get_field('datum_ukonceni_akce') + 1; // + 1 offset fix
		$end_date = DateTime::createFromFormat('Ymd', $end_date_string);

		$manually_set = get_field('manualne_prenastavit_stav_akce');

		if ($manually_set && in_category('akce')) :
			echo '<div class="offer-state__container">';
			if ($manually_set == 'Akce právě probíhá') :
				echo '<div class="offer-state offer-state--active">Akce právě probíhá</div>';
			elseif ($manually_set == 'Akce brzy začne') :
				echo '<div class="offer-state offer-state--soon">Akce brzy začne</div>';
			elseif ($manually_set == 'Akce ukončena') :
				echo '<div class="offer-state offer-state--ended">Akce ukončena</div>';
			endif;
			echo '</div><!-- offer-state__container -->';

		elseif (($start_date_string || $end_date_string) && in_category('akce')) :
			echo '<div class="offer-state__container">';
			if ($start_date <= $current_date && $current_date <= $end_date) :
				echo '<div class="offer-state offer-state--active">Akce právě probíhá</div>';
			elseif ($start_date > $current_date) :
				echo '<div class="offer-state offer-state--soon">Akce brzy začne</div>';
			elseif ($current_date > $end_date) :
				echo '<div class="offer-state offer-state--ended">Akce ukončena</div>';
			endif;
			echo '</div><!-- offer-state__container -->';
		endif;
	}
endif;

if (!function_exists('dv_offer_brand')) :
	/*
	*
	* Prints offer brand.
	*
	*/
	function dv_offer_brand()
	{
		$brand = get_field('akce_se_tyka_znacky');

		if ($brand) :
			if ($brand == 'vsech') :
				echo '<img class="offer-brand" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/uh-car-logo.svg" alt="Logo UH CAR" loading="lazy">';
			elseif ($brand == 'suzuki') :
				echo '<img class="offer-brand" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/suzuki-logo.svg" alt="Logo Suzuki" loading="lazy">';
			elseif ($brand == 'citroen') :
				echo '<img class="offer-brand" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/citroen-logo.svg" alt="Logo Citroën" loading="lazy">';
			elseif ($brand == 'opel') :
				echo '<img class="offer-brand" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/opel-logo.svg" alt="Logo Opel" loading="lazy">';
			elseif ($brand == 'isuzu') :
				echo '<img class="offer-brand" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/isuzu-logo.svg" alt="Logo Isuzu" loading="lazy">';
			endif;
		endif;
	}
endif;

if (!function_exists('dv_print_car_sell_features')) :
	/*
	*
	* Prints car sell features.
	*
	*/
	function dv_print_car_sell_features()
	{
		$prvni_majitel = get_field('prvni_majitel');
		$service_book = get_field('service_book');
		$vat_expel_flag = get_field('vat_expel_flag');
		$all_features = array();

		if ($prvni_majitel) {
			array_push($all_features, '<li class="inline-block mr-050 py-025 px-050 text-sm font-semibold text-success-dark bg-success-lightest rounded-full shadow">První majitel</li>');
		}

		if ($service_book) {
			array_push($all_features, '<li class="inline-block mr-050 py-025 px-050 text-sm font-semibold text-info-dark bg-info-lightest rounded-full shadow">Servisní knížka</li>');
		}

		if ($vat_expel_flag) {
			array_push($all_features, '<li class="inline-block mr-050 py-025 px-050 text-sm font-semibold text-danger-dark bg-danger-lightest rounded-full shadow">Možnost odpočtu DPH</li>');
		}

		foreach ($all_features as $feature) {
			echo $feature;
		}

		unset($all_features);
	}
endif;

if (!function_exists('dv_print_seats')) :
	/*
	*
	* Prints number of seats with correct text.
	*
	*/
	function dv_print_seats()
	{
		$seats = get_field('seats');

		if ('1' === $seats) {
			$seats_text = '1 místo';
		} elseif (1 < $seats && 5 > $seats) {
			$seats_text = $seats . ' místa';
		} else {
			$seats_text = $seats . ' míst';
		}

		echo $seats_text;
	}
endif;

if (!function_exists('dv_print_car_sell_price')) :
	/*
	*
	* Prints car sell price and text.
	*
	*/
	function dv_print_car_sell_price()
	{
		$is_on_sale = floor(get_field('burza_price'));
		$base_price = get_field('burza_price');
		$final_price = get_field('sales_price');
		$price_text = get_field('vat_expel_text');
		$financing_text = get_field('finpoz');
		$saved = $base_price - $final_price;

		if ('Cena' === $price_text) {
			$customized_price_text = 'Cena vozu';
		} elseif ('Cena s DPH' === $price_text) {
			$customized_price_text = 'Cena vozu s DPH';
		} elseif ('Cena bez DPH' === $price_text) {
			$customized_price_text = 'Cena vozu bez DPH';
		} else {
			$customized_price_text = $price_text;
		}

		if ('Cena' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena';
		} elseif ('Cena s DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena s&nbsp;DPH';
		} elseif ('Cena bez DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena bez&nbsp;DPH';
		}

		if ($is_on_sale) : ?>

			<?php if (get_field('new_flag')) : ?>

				<div class="flex flex-wrap items-center mb-025">
					<div class="w-1/2 pr-025 text-base text-right grey-dark">Ceníková cena: </div>
					<div class="w-1/2 pl-025 text-xl font-bold text-left text-grey-dark"><?php echo number_format(floor($base_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
				</div>

			<?php else : ?>

				<div class="flex flex-wrap items-center mb-025">
					<div class="w-1/2 pr-025 text-base text-right grey-dark">Původní cena: </div>
					<div class="w-1/2 pl-025 text-xl font-bold text-left text-grey-dark"><?php echo number_format(floor($base_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
				</div>

			<?php endif; ?>



			<div class="flex flex-wrap items-center mb-025">
				<div class="w-1/2 pr-025 text-base text-right grey-dark"><?php echo $customized_price_text; ?>: </div>
				<div class="w-1/2 pl-025 text-xl font-bold text-left text-primary"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
			</div>

			<?php if ($financing_text) : ?>

				<div class="flex flex-wrap items-center justify-center mb-025 text-center text-success">
					<img class="block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-check-circle--success.svg" alt="" loading="lazy">
					Ušetříte <?php echo number_format(floor($saved), 0, ',', '&nbsp;') . '&nbsp;Kč'; ?>
				</div>

				<a class="flex flex-wrap items-center justify-center mb-075 font-normal" style="color: #1765aa;" href="https://uhcar.cz/financovani/" title="Získat výhodné financování">
					<img class="block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-financing.svg" alt="" loading="lazy">
					<?php echo $financing_text; ?>
				</a>

			<?php else : ?>

				<div class="flex flex-wrap items-center justify-center mb-025 text-center text-success">
					<img class="block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-check-circle--success.svg" alt="" loading="lazy">
					Ušetříte <?php echo number_format(floor($saved), 0, ',', '&nbsp;') . '&nbsp;Kč'; ?>
				</div>

			<?php endif; ?>

		<?php else : ?>

			<?php if ($financing_text) : ?>

				<div class="flex flex-wrap justify-center items-baseline">
					<span class="mr-025 text-grey-dark"><?php echo $customized_price_text; ?></span>
					<span class="text-xl font-bold text-primary"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč'; ?></span>
				</div>

				<a class="flex flex-wrap items-center justify-center mb-075 font-normal" style="color: #1765aa;" href="https://uhcar.cz/financovani/" title="Získat výhodné financování">
					<img class="block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-financing.svg" alt="" loading="lazy">
					<?php echo $financing_text; ?>
				</a>

			<?php else : ?>

				<div class="flex flex-wrap justify-center items-baseline">
					<span class="mr-025 text-grey-dark"><?php echo $customized_price_text; ?></span>
					<span class="text-xl font-bold text-primary"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč'; ?></span>
				</div>

			<?php endif; ?>

		<?php endif;
	}
endif;

if (!function_exists('dv_print_seller')) :
	/*
	*
	* Prints car seller.
	*
	*/
	function dv_print_seller()
	{
		$is_new = get_field('new_flag');
		$is_show = get_field('show_flag');
		$producer = get_field('producer_text');
		$remarks = array();

		if (have_rows('remarks')) :
			while (have_rows('remarks')) : the_row();
				array_push($remarks, get_sub_field('remark'));
			endwhile;
		endif;

		$last_remark_row = end($remarks);

		// Pokud je kontakt na Jana Ciběnu na konci detailního popisu, zobrazí jej jako prodejce
		if (substr($last_remark_row, -11) == '778 443 380' || substr($last_remark_row, -12) == '778 443 380') : ?>
			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-cibena.png">
			<div class="h5 mt-0 mb-0 text-center">Jan Ciběna</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce vozů</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420778443380">778&nbsp;443&nbsp;380</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@opeluh.cz">prodej@opeluh.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php

		// Pokud je kontakt na Soňu na konci detailního popisu, zobrazí ji jako prodejce
		elseif (substr($last_remark_row, -11) == '775 200 868' || substr($last_remark_row, -12) == '775 200 868') : ?>
			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-gregorovicova.png">
			<div class="h5 mt-0 mb-0 text-center">Soňa Gregorovičová</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce vozů</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420775200868">775 200 868</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@citroenuh.cz">prodej@citroenuh.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php

		// Pokud je kontakt na Ondřeje na konci detailního popisu, zobrazí jej jako prodejce
		elseif (substr($last_remark_row, -11) == '770 194 700' || substr($last_remark_row, -12) == '770 194 700') : ?>
			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-logo--grey-lightest@100w.svg">
			<div class="h5 mt-0 mb-0 text-center">Mgr. Ondřej Doležal</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce vozů Suzuki</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420770194700">770&nbsp;194&nbsp;700</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej.suzukiho@uhcar.cz">prodej.suzukiho@uhcar.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php

		// Pokud je kontakt na Jirku Lišku na konci detailního popisu, zobrazí jej jako prodejce
		elseif (substr($last_remark_row, -11) == '724 809 081' || substr($last_remark_row, -12) == '724 809 081') : ?>
			<img class="block print:hidden mx-auto mb-1" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/images/portrety-zamestnancu/foto-liska.png">
			<div class="h5 mt-0 mb-0 text-center">Jiří Liška</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Suzuki <br><a class="font-normal underline text-grey-dark hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Kde nás najdete v Uherském Hradišti?">v&nbsp;Uherském Hradišti</a></div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420724809081">724&nbsp;809&nbsp;081</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@suzukiuh.cz">prodej@suzukiuh.cz</a></div>

		<?php

		// Pokud je kontakt na Patrika na konci detailního popisu, zobrazí jej jako prodejce
		elseif (substr($last_remark_row, -11) == '771 231 847' || substr($last_remark_row, -12) == '771 231 847') : ?>
			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-kolaja.png">
			<div class="h5 mt-0 mb-0 text-center">Patrik Kolaja</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce užitkových vozů</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420771231847">771&nbsp;231&nbsp;847</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:uzitkovevozy@uhcar.cz">uzitkovevozy@uhcar.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php

		// Oprava kontaktu
		elseif (get_field('id') == 592320) : ?>
			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-gregorovicova.png">
			<div class="h5 mt-0 mb-0 text-center">Soňa Gregorovičová</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Citroën</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420775200868">775 200 868</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@citroenuh.cz">prodej@citroenuh.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php

		// Ojeté vozy
		elseif (!$is_new && !$is_show) : ?>

			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-lukestik.png">
			<div class="h5 mt-0 mb-0 text-center">Martin Lukeštík</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce ojetých vozů</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420773748503">773&nbsp;748&nbsp;503</a> <br>nebo zanechte zprávu na <span class="font-semibold">bazar@uhcar.cz</span></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php elseif ('Suzuki' === $producer) :

			$seller_uh_1_html = '
				<img class="block print:hidden mx-auto mb-1" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-liska.png">
				<div class="h5 mt-0 mb-0 text-center">Jiří Liška</div>
				<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Suzuki <br><a class="font-normal underline text-grey-dark hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Kde nás najdete v Uherském Hradišti?">v&nbsp;Uherském Hradišti</a></div>
				<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420724809081">724&nbsp;809&nbsp;081</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@suzukiuh.cz">prodej@suzukiuh.cz</a></div>
			';

			$seller_uh_2_html = '
			<img class="block print:hidden mx-auto mb-1" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-hruskova.png">
			<div class="h5 mt-0 mb-0 text-center">Veronika Hrušková</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Suzuki <br><a class="font-normal underline text-grey-dark hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Kde nás najdete v Uherském Hradišti?">v&nbsp;Uherském Hradišti</a></div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420774201308">774&nbsp;201&nbsp;308</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:info@suzukiuh.cz">info@suzukiuh.cz</a></div>
		';

			$seller_ho_1_html = '
				<img class="block print:hidden mx-auto mb-1" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-logo--grey-lightest@100w.svg">
				<div class="h5 mt-0 mb-0 text-center">Mgr. Ondřej Doležal</div>
				<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Suzuki <br><a class="font-normal underline text-grey-dark hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Kde nás najdete v Uherském Hradišti?">v&nbsp;Hodoníně</a></div>
				<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420770194700">770&nbsp;194&nbsp;700</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej.suzukiho@uhcar.cz">prodej.suzukiho@uhcar.cz</a></div>
			';

			$upper_seller = rand(1, 2);
			$uh_seller = rand(1, 2);
		?>

			<div class="mb-2">
				<?php
				if ($upper_seller == 1) :
					if ($uh_seller == 1) :
						echo $seller_uh_1_html;
					elseif ($uh_seller == 2) :
						echo $seller_uh_1_html;
					endif;
				elseif ($upper_seller == 2) :
					echo $seller_ho_1_html;
				endif;
				?>
			</div>

			<div>
				<?php
				if ($upper_seller == 1) :
					echo $seller_ho_1_html;
				elseif ($upper_seller == 2) :
					if ($uh_seller == 1) :
						echo $seller_uh_1_html;
					elseif ($uh_seller == 2) :
						echo $seller_uh_1_html;
					endif;
				endif;
				?>
			</div>

		<?php elseif ('Citroën' === $producer) : ?>

			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-gregorovicova.png">
			<div class="h5 mt-0 mb-0 text-center">Soňa Gregorovičová</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Citroën</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420775200868">775 200 868</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@citroenuh.cz">prodej@citroenuh.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php elseif ('Opel' === $producer) : ?>

			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-cibena.png">
			<div class="h5 mt-0 mb-0 text-center">Jan Ciběna</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce nových vozů Opel</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420778443380">778&nbsp;443&nbsp;380</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:prodej@opeluh.cz">prodej@opeluh.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php elseif ('Piaggio' === $producer || 'Selvo' === $producer) : ?>

			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-kolaja.png">
			<div class="h5 mt-0 mb-0 text-center">Patrik Kolaja</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce vozů Isuzu, Piaggio, Selvo</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420771231847">771&nbsp;231&nbsp;847</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:uzitkovevozy@uhcar.cz">uzitkovevozy@uhcar.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php
		// Platí pro Isuzu a vše ostatní
		else : ?>

			<img class="block print:hidden mx-auto mb-1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/portrety-zamestnancu/foto-kolaja.png">
			<div class="h5 mt-0 mb-0 text-center">Patrik Kolaja</div>
			<div class="mb-050 italic text-center text-grey-dark">Prodejce vozů Isuzu, Piaggio, Selvo</div>
			<div class="text-center leading-relaxed">Volejte prodejci na <a class="text-grey-darkest font-semibold" href="tel:+420771231847">771&nbsp;231&nbsp;847</a> <br>nebo zanechte zprávu na <a class="font-semibold text-grey-darkest" href="mailto:uzitkovevozy@uhcar.cz">uzitkovevozy@uhcar.cz</a></div>
			<a class="block mt-050 text-center font-normal underline text-grey hover:text-grey-darkest" href="https://uhcar.cz/kontakt/" title="Zobrazit kontakty">Kde nás najdete?</a>

		<?php endif;
	}
endif;

if (!function_exists('dv_print_rebuild_seller')) :
	/*
	*
	* Prints rebuild car seller HTML.
	*
	*/
	function dv_print_rebuild_seller($seller)
	{
		if ($seller == 'Jan Ciběna') :
			echo '
				<img class="md:absolute mx-auto mb-1 block l-0" style="top: -0.75rem" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-cibena.png" alt="Prodejce Jan Ciběna" loading="lazy">
				<div class="md:ml-4 p-1 md:pl-5 rounded-lg bg-white shadow-md">
					<h3 class="h5 mb-025">Jan Ciběna</h3>
					<p class="mb-050 text-base italic text-grey">Prodejce užitkových vozů Opel</p>
					<p class="text-base">Volejte prodejci na&nbsp;telefon <a class="text-grey-darkest hover:text-primary" href="tel:+420778443380">778&nbsp;443&nbsp;380</a> <br>nebo zanechte zprávu na&nbsp;<a class="text-grey-darkest hover:text-primary" href="mailto:prodej@opeluh.cz">prodej@opeluh.cz</a></p>
				</div>
			';
		elseif ($seller == 'Soňa Gregorovičová') :
			echo '
				<img class="md:absolute mx-auto mb-1 block l-0" style="top: -0.75rem" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-gregorovicova.png" alt="Prodejce Soňa Gregorovičová" loading="lazy">
				<div class="md:ml-4 p-1 md:pl-5 rounded-lg bg-white shadow-md">
					<h3 class="h5 mb-025">Soňa Gregorovičová</h3>
					<p class="mb-050 text-base italic text-grey">Prodejce užitkových vozů Citroën</p>
					<p class="text-base">Volejte prodejci na&nbsp;telefon <a class="text-grey-darkest hover:text-primary" href="tel:+420775200868">775&nbsp;200&nbsp;868</a> <br>nebo zanechte zprávu na&nbsp;<a class="text-grey-darkest hover:text-primary" href="mailto:prodej@citroenuh.cz">prodej@citroenuh.cz</a></p>
				</div>
			';
		elseif ($seller == 'Patrik Kolaja') :
			echo '
				<img class="md:absolute mx-auto mb-1 block l-0" style="top: -0.75rem" src="https://uhcar.cz/wp-content/themes/sablona-na-miru/assets/img/portrety-zamestnancu/foto-kolaja.png" alt="Prodejce Patrik Kolaja" loading="lazy">
				<div class="md:ml-4 p-1 md:pl-5 rounded-lg bg-white shadow-md">
					<h3 class="h5 mb-025">Patrik Kolaja</h3>
					<p class="mb-050 text-base italic text-grey">Prodejce užitkových vozů Isuzu, Piaggio, Selvo</p>
					<p class="text-base">Volejte prodejci na&nbsp;telefon <a class="text-grey-darkest hover:text-primary" href="tel:+420771231847">771&nbsp;231&nbsp;847</a> <br>nebo zanechte zprávu na&nbsp;<a class="text-grey-darkest hover:text-primary" href="mailto:uzitkovevozy@uhcar.cz">uzitkovevozy@uhcar.cz</a></p>
				</div>
			';
		endif;
	}
endif;

if (!function_exists('dv_print_car_used_form')) :
	/*
	*
	* Prints form for used cars.
	*
	*/
	function dv_print_car_used_form()
	{
		$remarks = array();

		if (have_rows('remarks')) :
			while (have_rows('remarks')) : the_row();
				array_push($remarks, get_sub_field('remark'));
			endwhile;
		endif;

		$last_remark_row = end($remarks);

		// Pokud je kontakt na Ondřeje Doležala na konci detailního popisu, zobrazí formulář na něj
		if (substr($last_remark_row, -11) == '770 194 700' || substr($last_remark_row, -12) == '770 194 700') :
			echo do_shortcode('[contact-form-7 id="14982267" title="Rezervace vozu k prodeji (Suzuki Hodonín)"]');
		else :
			echo do_shortcode('[contact-form-7 id="2498" title="Nezávazná rezervace vozu (autobazar)"]');
		endif;
	}
endif;

if (!function_exists('dv_print_car_new_form')) :
	/*
	*
	* Prints form for new cars.
	*
	*/
	function dv_print_car_new_form()
	{
		$producer = get_field('producer_text');
		$remarks = array();

		if (have_rows('remarks')) :
			while (have_rows('remarks')) : the_row();
				array_push($remarks, get_sub_field('remark'));
			endwhile;
		endif;

		$last_remark_row = end($remarks);

		if ('Suzuki' === $producer) :

			echo do_shortcode('[contact-form-7 id="6088" title="Rezervace vozu k prodeji (Suzuki)"]');

		elseif ('Citroën' === $producer) :

			echo do_shortcode('[contact-form-7 id="6089" title="Rezervace vozu k prodeji (Citroen)"]');

		elseif ('Opel' === $producer) :

			echo do_shortcode('[contact-form-7 id="6090" title="Rezervace vozu k prodeji (Opel)"]');

		else :

			echo do_shortcode('[contact-form-7 id="6091" title="Rezervace vozu k prodeji (Isuzu)"]');

		endif;
	}
endif;

if (!function_exists('dv_recommended_car')) :
	/*
	*
	* Displays recommended car.
	*
	*/
	function dv_recommended_car($first_cell_position = 0)
	{
		$is_on_sale = floor(get_field('burza_price'));
		$base_price = get_field('burza_price');
		$final_price = get_field('sales_price');
		$price_text = get_field('vat_expel_text');
		$financing_text = get_field('finpoz');
		$saved = $base_price - $final_price;

		if ('Cena' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena';
		} elseif ('Cena s DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena s&nbsp;DPH';
		} elseif ('Cena bez DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena bez&nbsp;DPH';
		} else {
			$customized_price_text = $price_text;
		}

		if ($first_cell_position > 0) {
			$cell_postion_class = 'cell-pos-' . $first_cell_position;
		}

		if ($is_on_sale) : ?>

			<article class="recommended-car__container <?php if ($cell_postion_class) {
																										echo $cell_postion_class;
																									}; ?>">
				<a class="recommended-car recommended-car--on-sale" href="<?php the_permalink(); ?>">
					<div class="recommended-car__image-container">
						<?php the_post_thumbnail('small', ['class' => 'recommended-car__image']); ?>
					</div>
					<div class="recommended-car__content">
						<h3 class="recommended-car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
						<div class="recommended-car__sub-title"><?php the_field('model_supplement'); ?></div>
						<div class="recommended-car__description">
							r. <?php the_field('constr_year'); ?>
							<span class="grey-light">|</span>
							<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
							<span class="grey-light">|</span>
							<?php the_field('fuel'); ?>
						</div>
						<div class="recommended-car__price-wrapper">
							<div class="recommended-car__price-text"><?php echo $customized_price_text; ?>: </div>
							<div class="recommended-car__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						</div>
						<div class="recommended-car__save">Ušetříte <?php echo number_format(floor($saved), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						<?php if ($financing_text) : ?>
							<div class="recommended-car__financing"><?php echo $financing_text; ?></div>
						<?php endif; ?>
					</div><!-- .recommended-car__content -->
				</a>
			</article>

		<?php else : ?>

			<article class="recommended-car__container">
				<a class="recommended-car" href="<?php the_permalink(); ?>">
					<div class="recommended-car__image-container">
						<?php the_post_thumbnail('small', ['class' => 'recommended-car__image']); ?>
					</div>
					<div class="recommended-car__content">
						<h3 class="recommended-car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
						<div class="recommended-car__sub-title"><?php the_field('model_supplement'); ?></div>
						<div class="recommended-car__description">
							r. <?php the_field('constr_year'); ?>
							<span class="grey-light">|</span>
							<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
							<span class="grey-light">|</span>
							<?php the_field('fuel'); ?>
						</div>
						<div class="recommended-car__price-wrapper">
							<div class="recommended-car__price-text"><?php echo $customized_price_text; ?>: </div>
							<div class="recommended-car__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						</div>
						<?php if ($financing_text) : ?>
							<div class="recommended-car__financing mt-025 ml-auto"><?php echo $financing_text; ?></div>
						<?php endif; ?>
					</div>
				</a>
			</article>

		<?php endif;
	}
endif;

if (!function_exists('dv_recommended_car_slide')) :
	/*
	*
	* Displays recommended car slide.
	*
	*/
	function dv_recommended_car_slide()
	{
		$is_on_sale = floor(get_field('burza_price'));
		$base_price = get_field('burza_price');
		$final_price = get_field('sales_price');
		$price_text = get_field('vat_expel_text');
		$financing_text = get_field('finpoz');
		$saved = $base_price - $final_price;

		if ('Cena' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena';
		} elseif ('Cena s DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena s&nbsp;DPH';
		} elseif ('Cena bez DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena bez&nbsp;DPH';
		} else {
			$customized_price_text = $price_text;
		}

		if ($is_on_sale) : ?>

			<article class="recommended-car-slide__container owl-item">
				<a class="recommended-car-slide recommended-car-slide--on-sale" href="<?php the_permalink(); ?>">
					<div class="recommended-car-slide__image-container">
						<?php the_post_thumbnail('small', ['class' => 'recommended-car-slide__image']); ?>
					</div>
					<div class="recommended-car-slide__content">
						<h3 class="recommended-car-slide__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
						<div class="recommended-car-slide__sub-title"><?php the_field('model_supplement'); ?></div>
						<div class="recommended-car-slide__description">
							r. <?php the_field('constr_year'); ?>
							<span class="grey-light">|</span>
							<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
							<span class="grey-light">|</span>
							<?php the_field('fuel'); ?>
						</div>
						<div class="recommended-car-slide__price-wrapper">
							<div class="recommended-car-slide__price-text"><?php echo $customized_price_text; ?>: </div>
							<div class="recommended-car-slide__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						</div>
						<div class="recommended-car-slide__save">Ušetříte <?php echo number_format(floor($saved), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						<?php if ($financing_text) : ?>
							<div class="recommended-car-slide__financing"><?php echo $financing_text; ?></div>
						<?php endif; ?>
					</div><!-- .recommended-car-slide__content -->
				</a>
			</article>

		<?php else : ?>

			<article class="recommended-car-slide__container owl-item">
				<a class="recommended-car-slide" href="<?php the_permalink(); ?>">
					<div class="recommended-car-slide__image-container">
						<?php the_post_thumbnail('small', ['class' => 'recommended-car-slide__image']); ?>
					</div>
					<div class="recommended-car-slide__content">
						<h3 class="recommended-car-slide__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
						<div class="recommended-car-slide__sub-title"><?php the_field('model_supplement'); ?></div>
						<div class="recommended-car-slide__description">
							r. <?php the_field('constr_year'); ?>
							<span class="grey-light">|</span>
							<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
							<span class="grey-light">|</span>
							<?php the_field('fuel'); ?>
						</div>
						<div class="recommended-car-slide__price-wrapper">
							<div class="recommended-car-slide__price-text"><?php echo $customized_price_text; ?>: </div>
							<div class="recommended-car-slide__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
						</div>
						<?php if ($financing_text) : ?>
							<div class="recommended-car-slide__financing mt-025 ml-auto"><?php echo $financing_text; ?></div>
						<?php endif; ?>
					</div>
				</a>
			</article>

		<?php endif;
	}
endif;

if (!function_exists('dv_rent_car_slide')) :
	/*
	*
	* Displays rent car slide.
	*
	*/
	function dv_rent_car_slide()
	{
		$full_day_price = get_field('cena_za_den');
		$half_day_price = get_field('cena_za_pulden');

		if (intval(get_field('seats')) <= 4) {
			$customized_seats_text = get_field('seats') . ' místa';
		} else {
			$customized_seats_text = get_field('seats') . ' míst';
		}
		?>

		<article class="rent-car-slide__container owl-item">
			<a class="rent-car-slide rent-car-slide--on-sale" href="<?php the_permalink(); ?>">
				<div class="rent-car-slide__image-container">
					<?php the_post_thumbnail('small', ['class' => 'rent-car-slide__image']); ?>
				</div>
				<div class="rent-car-slide__content">
					<h3 class="rent-car-slide__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
					<div class="rent-car-slide__sub-title"><?php the_field('model_supplement'); ?></div>
					<div class="rent-car-slide__description">
						<?php the_field('gear'); ?> | <?php the_field('kw'); ?>&nbsp;kW | <?php echo $customized_seats_text; ?>
					</div>
					<div class="rent-car-slide__price-wrapper">
						<div class="rent-car-slide__price-text">Cena za den: </div>
						<div class="rent-car-slide__price"><?php echo $full_day_price; ?>&nbsp;Kč</div>
					</div>
					<div class="rent-car-slide__price-wrapper">
						<div class="rent-car-slide__price-text">Cena za půlden: </div>
						<div class="rent-car-slide__price text-grey"><?php echo $half_day_price; ?>&nbsp;Kč</div>
					</div>
				</div><!-- .rent-car-slide__content -->
			</a>
		</article>

		<?php
	}
endif;

if (!function_exists('dv_car')) :
	/*
	*
	* Displays car in search filter results.
	*
	*/
	function dv_car()
	{
		$is_on_sale = floor(get_field('burza_price'));
		$base_price = get_field('burza_price');
		$final_price = get_field('sales_price');
		$price_text = get_field('vat_expel_text');
		$financing_text = get_field('finpoz');
		$saved = $base_price - $final_price;
		$car_id = get_field('id');
		$car_has_panorama = false;

		if (have_rows('360_fotka', 'options')) :
			while (have_rows('360_fotka', 'options')) : the_row();
				$panorama_id = get_sub_field('id_vozu', 'options');

				if ($car_id == $panorama_id) {
					$car_has_panorama = true;
				}
			endwhile;
		endif;

		if ('Cena' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena';
		} elseif ('Cena s DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena s&nbsp;DPH';
		} elseif ('Cena bez DPH' === $price_text && $is_on_sale) {
			$customized_price_text = 'Akční cena bez&nbsp;DPH';
		} else {
			$customized_price_text = $price_text;
		}

		if ($is_on_sale) : ?>

			<article class="car__container">
				<a class="car" href="<?php the_permalink(); ?>">
					<div class="car__thumbnail">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail("small"); ?>
						<?php else : ?>
							<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/car-silhouette.png" alt="Silueta auta">
						<?php endif; ?>

						<?php if ($car_has_panorama) : ?>
							<div class="car__360-button car__360-button--badge">
								<img class="car__360-button-icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-camera-rotate.svg" alt="Ikona 360 prohlídka" loading="lazy">
								<span class="car__360-button-text">360&deg;</span>
							</div>
						<?php endif; ?>
					</div> <!-- .car-thumbnail -->

					<div class="car__content">
						<div class="car__content-info-section">
							<h2 class="car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h2>
							<div class="car__sub-title"><?php the_field('model_supplement'); ?></div>

							<div class="car__icon-container">
								<?php if (!get_field('new_flag')) : ?>

									<?php if (get_field('constr_year')) : ?>
										<div class="car__icon">
											<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-calendar-check.svg" alt="Rok výroby">
											<div class="car__icon-text">
												<?php the_field('constr_year'); ?>
											</div>
										</div><!-- .car__icon -->
									<?php endif; ?>

									<?php if (get_field('constr_year')) : ?>
										<div class="car__icon">
											<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-barometer.svg" alt="Najeto">
											<div class="car__icon-text">
												<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
											</div>
										</div><!-- .car__icon -->
									<?php endif; ?>
								<?php endif; ?>
								<!-- endif !newflag -->

								<?php if (get_field('gear')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-gear-box.svg" alt="Převodovka">
										<div class="car__icon-text">
											<?php the_field('gear'); ?>
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>

								<?php if (get_field('kw')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-motor.svg" alt="Výkon">
										<div class="car__icon-text">
											<?php the_field('kw'); ?>&nbsp;kW
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>

								<?php if (get_field('fuel')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-fuel.svg" alt="Palivo">
										<div class="car__icon-text">
											<?php the_field('fuel'); ?>
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>
							</div><!-- .car__icon-container -->
						</div> <!-- .car__content-info-section -->

						<div class="car__content-price-section">
							<?php if (get_field('new_flag')) : ?>

								<div class="car__price-wrapper">
									<div class="car__price-text">Ceníková cena: </div>
									<div class="car__price car__price--base"><?php echo number_format(floor($base_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
								</div>

							<?php else : ?>

								<div class="car__price-wrapper">
									<div class="car__price-text">Původní cena: </div>
									<div class="car__price car__price--base"><?php echo number_format(floor($base_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
								</div>

							<?php endif; ?>

							<div class="car__price-wrapper">
								<div class="car__price-text"><?php echo $customized_price_text; ?>: </div>
								<div class="car__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
							</div>

							<div class="car__save">
								<img class="inline-block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-check-circle--success.svg" alt="" loading="lazy">
								Ušetříte <?php echo number_format(floor($saved), 0, ',', '&nbsp;') . '&nbsp;Kč' ?>
							</div>
						</div><!-- .car__content-price-section -->

						<?php if ($financing_text) : ?>
							<div class="car__financing">
								<img class="inline-block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-financing.svg" alt="" loading="lazy">
								<?php echo $financing_text; ?>
							</div>
						<?php endif; ?>
					</div><!-- .car__content -->
				</a> <!-- .car -->
			</article>

		<?php else : ?>

			<article class="car__container">
				<a class="car" href="<?php the_permalink(); ?>">
					<div class="car__thumbnail">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail("small"); ?>
						<?php else : ?>
							<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/car-silhouette.png" alt="Silueta auta">
						<?php endif; ?>

						<?php if ($car_has_panorama) : ?>
							<div class="car__360-button car__360-button--badge">
								<img class="car__360-button-icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-camera-rotate.svg" alt="Ikona 360 prohlídka" loading="lazy">
								<span class="car__360-button-text">360&deg;</span>
							</div>
						<?php endif; ?>
					</div> <!-- .car-thumbnail -->

					<div class="car__content">
						<div class="car__content-info-section">
							<h2 class="car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h2>
							<div class="car__sub-title"><?php the_field('model_supplement'); ?></div>

							<div class="car__icon-container">
								<?php if (!get_field('new_flag')) : ?>

									<?php if (get_field('constr_year')) : ?>
										<div class="car__icon">
											<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-calendar-check.svg" alt="Rok výroby">
											<div class="car__icon-text">
												<?php the_field('constr_year'); ?>
											</div>
										</div><!-- .car__icon -->
									<?php endif; ?>

									<?php if (get_field('km')) : ?>
										<div class="car__icon">
											<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-barometer.svg" alt="Najeto">
											<div class="car__icon-text">
												<?php echo number_format(floor(get_field('km')), 0, ',', '&nbsp;'); ?>&nbsp;km
											</div>
										</div><!-- .car__icon -->
									<?php endif; ?>
								<?php endif; ?>
								<!-- endif !newflag -->

								<?php if (get_field('gear')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-gear-box.svg" alt="Převodovka">
										<div class="car__icon-text">
											<?php the_field('gear'); ?>
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>

								<?php if (get_field('kw')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-motor.svg" alt="Výkon">
										<div class="car__icon-text">
											<?php the_field('kw'); ?>&nbsp;kW
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>

								<?php if (get_field('fuel')) : ?>
									<div class="car__icon">
										<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-fuel.svg" alt="Palivo">
										<div class="car__icon-text">
											<?php the_field('fuel'); ?>
										</div>
									</div><!-- .car__icon -->
								<?php endif; ?>
							</div><!-- .car__icon-container -->
						</div><!-- .car__content-info-section -->

						<div class="car__content-price-section">
							<div class="car__price-wrapper">
								<span class="car__price-text"><?php echo $customized_price_text; ?>: </span>
								<span class="car__price"><?php echo number_format(floor($final_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></span>
							</div>
						</div><!-- .car__content-price-section -->

						<?php if ($financing_text) : ?>
							<div class="car__financing">
								<img class="inline-block mr-025" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-financing.svg" alt="" loading="lazy">
								<?php echo $financing_text; ?>
							</div>
						<?php endif; ?>
					</div><!-- .car__content -->
				</a> <!-- .car -->
			</article>

		<?php endif; /* end else if is on sale */
	}
endif;


if (!function_exists('dv_car_rent')) :
	/*
	*
	* Displays car for rent in search filter results.
	*
	*/
	function dv_car_rent()
	{
		$full_day_price = get_field('cena_za_den');
		$half_day_price = get_field('cena_za_pulden');

		if (intval(get_field('seats')) <= 4) {
			$customized_seats_text = get_field('seats') . ' místa';
		} else {
			$customized_seats_text = get_field('seats') . ' míst';
		}

		?>

		<article class="car__container">
			<a class="car" href="<?php the_permalink(); ?>">
				<div class="car__thumbnail">
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail("small"); ?>
					<?php else : ?>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/car-silhouette.png" alt="Silueta auta">
					<?php endif; ?>
				</div> <!-- .car-thumbnail -->

				<div class="car__content">
					<div class="car__content-info-section">
						<h2 class="car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h2>
						<div class="car__sub-title"><?php the_field('model_supplement'); ?></div>

						<div class="car__icon-container">
							<?php if (get_field('gear')) : ?>
								<div class="car__icon">
									<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-gear-box.svg" alt="Převodovka">
									<div class="car__icon-text">
										<?php the_field('gear'); ?>
									</div>
								</div><!-- .car__icon -->
							<?php endif; ?>

							<?php if (get_field('kw')) : ?>
								<div class="car__icon">
									<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-motor.svg" alt="Výkon">
									<div class="car__icon-text">
										<?php the_field('kw'); ?>&nbsp;kW
									</div>
								</div><!-- .car__icon -->
							<?php endif; ?>

							<?php if (get_field('fuel')) : ?>
								<div class="car__icon">
									<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-fuel.svg" alt="Palivo">
									<div class="car__icon-text">
										<?php the_field('fuel'); ?>
									</div>
								</div><!-- .car__icon -->
							<?php endif; ?>

							<?php if (get_field('seats')) : ?>
								<div class="car__icon">
									<img class="car__icon-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-seat.svg" alt="Počet míst">
									<div class="car__icon-text">
										<?php echo $customized_seats_text; ?>
									</div>
								</div><!-- .car__icon -->
							<?php endif; ?>
						</div><!-- .car__icon-container -->
					</div><!-- .car__content-info-section -->

					<div class="car__content-price-section">
						<div class="car__rent-price-wrapper">
							<span class="car__rent-price-text">Cena za&nbsp;den:</span>
							<span class="car__rent-price"><?php echo number_format(floor($full_day_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></span>
						</div>

						<!-- <div class="car__rent-price-wrapper">
							<span class="car__rent-price-text">Cena za&nbsp;půlden:</span>
							<span class="car__rent-price car__rent-price--alt"><?php echo number_format(floor($half_day_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></span>
						</div> -->
					</div><!-- .car__content-price-section -->
				</div><!-- .car__content -->
			</a> <!-- .car -->
		</article>

	<?php
	}
endif;

if (!function_exists('dv_other_cars_for_rent')) :
	/*
	*
	* Displays other cars for rent.
	*
	*/
	function dv_other_cars_for_rent()
	{
		$full_day_price = get_field('cena_za_den');
		$half_day_price = get_field('cena_za_pulden');

		if (intval(get_field('seats')) <= 4) {
			$customized_seats_text = get_field('seats') . ' místa';
		} else {
			$customized_seats_text = get_field('seats') . ' míst';
		} ?>

		<article class="recommended-car__container">
			<a class="recommended-car" href="<?php the_permalink(); ?>">
				<div class="recommended-car__image-container">
					<?php the_post_thumbnail('small', ['class' => 'recommended-car__image']); ?>
				</div>
				<div class="recommended-car__content">
					<h3 class="recommended-car__title"><?php the_field('producer_text'); ?> <?php the_field('model_text'); ?></h3>
					<div class="recommended-car__sub-title"><?php the_field('model_supplement'); ?></div>
					<div class="recommended-car__description">
						<?php the_field('gear'); ?>
						<span class="grey-light">|</span>
						<?php the_field('kw'); ?>&nbsp;kW
						<span class="grey-light">|</span>
						<?php the_field('fuel'); ?>
						<span class="grey-light">|</span>
						<?php echo $customized_seats_text; ?>
					</div>
					<div class="recommended-car__price-wrapper">
						<div class="recommended-car__price-text">Cena za&nbsp;den</div>
						<div class="recommended-car__price"><?php echo number_format(floor($full_day_price), 0, ',', '&nbsp;') . '&nbsp;Kč' ?></div>
					</div>
					<!-- <div class="recommended-car__price-wrapper">
						<div class="recommended-car__price-text">Cena za&nbsp;půlden</div>
						<div class="recommended-car__price"><span class="text-grey-dark"><?php echo number_format(floor($half_day_price), 0, ',', '&nbsp;') . '&nbsp;Kč'; ?></span></div>
					</div> -->
				</div><!-- .recommended-car__content -->
			</a>
		</article>
<?php
	}
endif;

if (!function_exists('dv_opel_partner_bonus')) :
	/*
	*
	* Prints Opel Partner bonus
	*
	*/
	function dv_opel_partner_bonus()
	{
		echo '<a class="floating-label" href="https://uhcar.cz/akce/opel-partner/">Možnost slevy až 34,5&nbsp;% v&nbsp;rámci akce Opel Partner</a>';
	}
endif;

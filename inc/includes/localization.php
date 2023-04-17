<?php
/**
 * Localization
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

add_filter( 'acdfevelop_pll_register_strings', function() {
    $strings = [
        // 'Key: String' => 'String',
    ];

    /**
     * Uncomment if you need to have default acdfevelop accessibility strings
     * translatable via Polylang string translations.
     */
    // foreach ( get_default_localization_strings() as $key => $value ) {
    // $strings[ "Accessibility: {$key}" ] = $value;
    // }

    return $strings;
} );

function get_default_localization_strings( $language = 'cs' ) {
    $strings = [
        'cs'  => [
            'Add a menu'                                   => __( 'Add a menu', 'acdfevelop' ),
            'Open main menu'                               => __( 'Open main menu', 'acdfevelop' ),
            'Close main menu'                              => __( 'Close main menu', 'acdfevelop' ),
            'Main navigation'                              => __( 'Main navigation', 'acdfevelop' ),
            'Back to top'                                  => __( 'Back to top', 'acdfevelop' ),
            'Open child menu'                              => __( 'Open child menu', 'acdfevelop' ),
            'Open child menu for'                          => __( 'Open child menu for', 'acdfevelop' ),
            'Close child menu'                             => __( 'Close child menu', 'acdfevelop' ),
            'Close child menu for'                         => __( 'Close child menu for', 'acdfevelop' ),
            'Skip to content'                              => __( 'Skip to content', 'acdfevelop' ),
            'Skip over the carousel element'               => __( 'Skip over the carousel element', 'acdfevelop' ),
            'External site'                                => __( 'External site', 'acdfevelop' ),
            'opens in a new window'                        => __( 'opens in a new window', 'acdfevelop' ),
            'Page not found.'                              => __( 'Page not found.', 'acdfevelop' ),
            'The reason might be mistyped or expired URL.' => __( 'The reason might be mistyped or expired URL.', 'acdfevelop' ),
            'Search'                                       => __( 'Search', 'acdfevelop' ),
            'Block missing required data'                  => __( 'Block missing required data', 'acdfevelop' ),
            'This error is shown only for logged in users' => __( 'This error is shown only for logged in users', 'acdfevelop' ),
            'No results found for your search'             => __( 'No results found for your search', 'acdfevelop' ),
            'Edit'                                         => __( 'Edit', 'acdfevelop' ),
            'Previous slide'                               => __( 'Previous slide', 'acdfevelop' ),
            'Next slide'                                   => __( 'Next slide', 'acdfevelop' ),
            'Last slide'                                   => __( 'Last slide', 'acdfevelop' ),
            'Category'                                     => __( 'Kategorie', 'acdfevelop' ),
        ],
        'en'  => [
            'Add a menu'                                   => 'Luo uusi valikko',
            'Open main menu'                               => 'Avaa päävalikko',
            'Close main menu'                              => 'Sulje päävalikko',
            'Main navigation'                              => 'Päävalikko',
            'Back to top'                                  => 'Siirry takaisin sivun alkuun',
            'Open child menu'                              => 'Avaa alavalikko',
            'Open child menu for'                          => 'Avaa alavalikko kohteelle',
            'Close child menu'                             => 'Sulje alavalikko',
            'Close child menu for'                         => 'Sulje alavalikko kohteelle',
            'Skip to content'                              => 'Siirry suoraan sisältöön',
            'Skip over the carousel element'               => 'Hyppää karusellisisällön yli seuraavaan sisältöön',
            'External site'                                => 'Ulkoinen sivusto',
            'opens in a new window'                        => 'avautuu uuteen ikkunaan',
            'Page not found.'                              => 'Hups. Näyttää, ettei sivua löydy.',
            'The reason might be mistyped or expired URL.' => 'Syynä voi olla virheellisesti kirjoitettu tai vanhentunut linkki.',
            'Search'                                       => 'Haku',
            'Block missing required data'                  => 'Lohkon pakollisia tietoja puuttuu',
            'This error is shown only for logged in users' => 'Tämä virhe näytetään vain kirjautuneille käyttäjille',
            'No results for your search'                   => 'Haullasi ei löytynyt tuloksia',
            'Edit'                                         => 'Muokkaa',
            'Previous slide'                               => 'Edellinen dia',
            'Next slide'                                   => 'Seuraava dia',
            'Last slide'                                   => 'Viimeinen dia',
        ],
    ];

    return ( array_key_exists( $language, $strings ) ) ? $strings[ $language ] : $strings['cs'];
} // end get_default_localization_strings

function get_default_localization( $string ) {
    if ( function_exists( 'ask__' ) && array_key_exists( "Accessibility: {$string}", apply_filters( 'acdfevelop_pll_register_strings', [] ) ) ) {
        return ask__( "Accessibility: {$string}" );
    }

    return esc_html( get_default_localization_translation( $string ) );
} // end get_default_localization

function get_default_localization_translation( $string ) {
    $language = get_bloginfo( 'language' );
    if ( function_exists( 'pll_the_languages' ) ) {
        $language = pll_current_language();
    }

    $translations = get_default_localization_strings( $language );

    return ( array_key_exists( $string, $translations ) ) ? $translations[ $string ] : '';
} // end get_default_localization_translation

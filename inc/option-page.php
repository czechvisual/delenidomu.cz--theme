<?php

namespace acdfevelop;

function cookie_page_plugin_add_options_page() {
    add_menu_page(
        'Nastavení Cookie stránky',
        'Cookie',
        'manage_options',
        'cookie-page-plugin-settings',
        __NAMESPACE__ . '\cookie_page_plugin_settings_page' );
}

add_action( 'admin_menu', __NAMESPACE__ . '\cookie_page_plugin_add_options_page' );

function cookie_page_plugin_settings_page() {
    $fields_page = array(
        'name' => get_option( 'cookie_page_plugin_title', 'Podmínky práce s cookies' )
    );

    $fields_info = array(
        'name' => 'czechvisual | Patrik Vaďura',
        'email'  => 'hello@czechvisual.cz',
        'phone'  => '+420 725 007 655',
        'website'  => 'czechvisual.cz',
        'ico'  => '11845457',
        'address'  => 'nám. Svobody 362, 686 04 Kunovice',
    );

    $title = get_option( 'cookie_page_plugin_title', 'Podmínky práce s cookies' );
    $name = get_option( 'cookie_page_plugin_name', 'delenidomu.cz' );
    $email = get_option( 'cookie_page_plugin_email', 'poptavka@delenidomu.cz' );
    $phone = get_option( 'cookie_page_plugin_phone', '+420 732 378 438' );
    $website = get_option( 'cookie_page_plugin_website', 'www.delenidomu.cz' );
    $ico = get_option( 'cookie_page_plugin_ico', '05175101' );
    $address = get_option( 'cookie_page_plugin_address', 'Zlín, Sedmdesátá 7055, PSČ 760 01' ); ?>

    <div class="wrap">
        <h1>Nastavení Cookie stránky</h1>

        <form method="post" action="options.php">
            <h3>Stránka</h3>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Nadpis stránky</th>

                    <td>
                        <input
                            type="text"
                            name="cookie_page_plugin_title"
                            style="width: 100%;"
                            value="<?php echo esc_attr( $title ); ?>" />
                    </td>
                </tr>
            </table>

            <h3>Administrativní údaje</h3>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Jméno / Název firmy:</th>

                    <td>
                        <input
                            type="text"
                            name="cookie_page_plugin_name"
                            style="width: 100%;"
                            value="<?= esc_attr( $name ) ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Email:</th>

                    <td>
                        <input
                            type="text"
                            name="cookie_page_plugin_name"
                            style="width: 100%;"
                            value="<?= esc_attr( $email ) ?>" />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}


function cookie_page_plugin_register_settings() {
    register_setting( 'cookie-page-plugin-settings-group-title', 'cookie_page_plugin_title' );
    register_setting( 'cookie-page-plugin-settings-group-name', 'cookie_page_plugin_name' );
    register_setting( 'cookie-page-plugin-settings-group-email', 'cookie_page_plugin_email' );
}

add_action( 'admin_init', __NAMESPACE__ . '\cookie_page_plugin_register_settings' );

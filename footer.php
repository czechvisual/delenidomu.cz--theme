</main>

<span onclick="goTop()" id="go-top" class="go-top"></span>

<footer id="footer" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 site-footer-copyright">
                <a href="<?=home_url()?>">&copy;&nbsp;<?=date("Y") . ' ' . ( THEME_SETTINGS['copyright-name'] )?></a> |
                <a
                        href="<?=( THEME_SETTINGS['creator-url'] )?>"
                        target="_blank">
                    Created by
                    <img
                            src="<?=get_stylesheet_directory_uri() . ( THEME_SETTINGS['logo-creator'] );?>"
                            alt="<?=( THEME_SETTINGS['creator'] )?>">
                </a>
            </div>

            <div class="col-md-6 site-footer-menu">
                <a href="/" target="_blank">Ochrana osobních údajů</a> | <a href="/" target="_blank">Cookies</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.9/dist/cookieconsent.js"></script>
<script defer src="<?=get_template_directory_uri() . '/assets/js/modules/cookieconsent-init.js'?>"></script>

</body>
</html>

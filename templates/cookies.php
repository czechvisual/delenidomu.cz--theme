<?php

/**
 * Template Name: Cookies
 */

$contactInfo = array(
    'name' => 'delenidomu.cz',
    'email'  => 'poptavka@delenidomu.cz',
    'phone'  => '+420 732 378 438',
    'website'  => 'www.delenidomu.cz',
    'ico'  => '05175101',
    'address'  => 'Zlín, Sedmdesátá 7055, PSČ 760 01',
);
$startDate = '1.1.2023';

get_header(); ?>

    <div class="container-fluid px-0 single-page">
        <div class="row">
            <div class="single-page-feature">
                <div class="container">
                    <h1>
                        Podmínky práce s <span>cookies</span>
                    </h1>
                </div>
            </div>

            <div class="container">
                <div class="row gy-5">
                    <div class="single-page-content col">
                        <p>
                            Společnost <?=$contactInfo['name']?>, IČ: <?=$contactInfo['ico']?>, se sídlem <?=$contactInfo['address']?> (dále jen „<?=$contactInfo['name']?>“) používá cookies v souvislosti s provozem jejích webových stránek <?=$contactInfo['website']?> (dále jen „web“).
                            Účelem tohoto dokumentu Podmínky práce s cookies (dále jen „podmínky“) je seznámit Vás se způsobem nakládání s cookies, s tím souvisejícím zpracováním osobních údajů a dále poskytnout Vám přehled všech Vašich práv ve smyslu zákona č. 127/2005 Sb., o elektronických komunikacích (dále jen „ZEK“) a ve smyslu nařízení č. 2016/679, obecné nařízení o ochraně osobních údajů (dále jen „GDPR“). Jako návštěvník webu jste povinen si tyto podmínky přečíst a v případě, že nerozumíte některé informaci či pokud budete cokoli potřebovat, můžete se na <?=$contactInfo['name']?> obrátit na email: <?=$contactInfo['email']?>
                        </p>

                        <h3>Co jsou cookies?</h3>

                        <p>
                            Soubory cookie používáme k analýze údajů o našich návštěvnících, ke zlepšení našich webových stránek, zobrazení personalizovaného obsahu a k tomu, abychom vám poskytli skvělý zážitek z webu.
                        </p>

                        <h3>Funkční cookies</h3>

                        <p>
                            Tyto soubory cookie jsou nezbytné pro fungování webových stránek, není tedy možné je zakázat. Obvykle se nastavují v reakci na akci, kterou na webu sami provedete, jako je nastavení zabezpečení, přihlášení a vyplňování formulářů. Svůj prohlížeč můžete nastavit tak, aby blokoval soubory cookie nebo o nich zasílal upozornění. Mějte na paměti, že některé stránky nebudou bez těchto souborů fungovat. Tyto soubory cookie neukládají žádné informace, které lze přiřadit konkrétní osobě. Tyto soubory cookie můžeme nastavit my nebo poskytovatelé třetích stran, jejichž služby na webu využíváme. Tyto soubory cookie neukládají žádné informace, které lze přiřadit konkrétní osobě.
                        </p>

                        <h3>Analytické cookies</h3>

                        <p>
                            Tyto soubory cookie se používají ke zlepšení fungování webových stránek. Umožňují nám rozpoznat a sledovat počet návštěvníků a sledovat, jak návštěvníci web používají. Pomáhají nám zlepšovat způsob, jakým webové stránky fungují, například tím, že uživatelům umožňují snadno najít to, co hledají. Tyto soubory cookie neshromažďují informace, které by vás mohly identifikovat. Pomocí těchto nástrojů analyzujeme a pravidelně zlepšujeme funkčnost našich webových stránek. Získané statistiky můžeme využít ke zlepšení uživatelského komfortu a k tomu, aby byla návštěva webu pro vás jako uživatele zajímavější.
                        </p>

                        <h3>Marketingové cookies</h3>

                        <p>
                            Používají se ke sledování preferencí webu uživatele za účelem cílení reklamy, tj. zobrazování marketingových a reklamních sdělení (i na stránkách třetích stran), které mohou návštěvníka webu zajímat, v souladu s těmito preferencemi. Marketingové cookies využívají nástroje externích společností. Tyto marketingové soubory cookie budou použity pouze s vaším souhlasem.
                        </p>

                        <h3>Poučení o Vašich právech a možnosti je uplatnit</h3>

                        <p>
                            Proti provádění přímého marketingu můžete kdykoliv podat námitky. Nastavení je možno změnit po kliknutí na tlačítko „Spravovat souhlas“ v levém dolním rohu obrazovky. Většina internetových prohlížečů také umožňuje prostřednictvím svého nastavení kontrolovat většinu druhů cookies. Můžete si tedy prohlížeč nastavit tak, aby Vás informoval o přijetí cookies a můžete se rozhodnout, zda použití cookies potvrdíte nebo nikoliv. Můžete také cookies zcela vypnout nebo zakázat. Více informací naleznete v nápovědě ke svému prohlížeči. Cookies, které jsou již uložené, můžete průběžně mazat ze svého počítače. Nastavením v rámci cookies lišty je udělen souhlas a může jím být také odvolán. Souhlas, který jste <?=$contactInfo['name']?>, jakožto správci, tímto dobrovolně udělil, je možné kdykoliv bezplatně odvolat.
                        </p>

                        <h3>K těmto podmínkám</h3>

                        <p>
                            Tento dokument nabývá účinnosti dne <?=$startDate?>. Společnost <?=$contactInfo['name']?> je oprávněna v případě potřeby tyto podmínky aktualizovat. Při prohlížení našich internetových stránek se vždy informujte o aktuálním znění těchto podmínek. Nové znění je účinné zveřejněním. To je vždy zobrazeno na našich internetových stránkách a je tak umožněna jeho archivace a reprodukce.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();

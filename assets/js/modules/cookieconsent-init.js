var cookieconsent = initCookieConsent();

cookieconsent.run({
  autorun: true,
  revision: 1,
  auto_language: 'document',
  autoclear_cookies: true,
  page_scripts: true,

  gui_options: {
    consent_modal: {
      layout: 'bar',
      position: 'bottom center',
      transition: 'slide',
      swap_buttons: false
    },
    settings_modal: {
      layout: 'box',
      transition: 'slide'
    }

  },

  onFirstAction: function (user_preferences, cookie) {
    // callback triggered only once
  },

  onAccept: function (cookie) {
    // ...
  },

  onChange: function (cookie, changed_preferences) {
    // ...
  },

  languages: {
    cs: {
      consent_modal: {
        title: 'Na vašem soukromí nám záleží',
        description: 'Používáme soubory cookies, potvrďte prosím že souhlasíte s využívaním cookies. <br><a data-cc="c-settings" class="cc-link">Nastavení</a> | <a class="cc-link" href="/cookies" target="_blank">Více o cookies</a>',
        primary_btn: {
          text: 'Rozumím',
          role: 'accept_all' // 'accept_selected' or 'accept_all'
        },
        secondary_btn: {
          text: 'Odmítnout',
          role: 'accept_necessary' // 'settings' or 'accept_necessary'
        }
      },
      settings_modal: {
        title: 'Podrobné nastavení',
        save_settings_btn: 'Uložit nastavení',
        accept_all_btn: 'Přijmout všechny',
        reject_all_btn: 'Odmítnout všechny', // optional, [v.2.5.0 +]
        cookie_table_headers: [{
          col1: 'Cookie'
        },
        {
          col2: 'Doména'
        },
        {
          col3: 'Platnost'
        },
        {
          col4: 'Popis'
        }
        ],
        blocks: [{
          title: 'Co jsou cookies?',
          description: 'Soubory cookie používáme k analýze údajů o našich návštěvnících, ke zlepšení našich webových stránek, zobrazení personalizovaného obsahu a k tomu, abychom vám poskytli skvělý zážitek z webu.<br><a href="/cookies" target="_blank">Více o cookies</a>'
        }, {
          title: 'Funkční cookies',
          description: 'Tyto soubory cookie jsou nezbytné pro fungování webových stránek, není tedy možné je zakázat. Obvykle se nastavují v reakci na akci, kterou na webu sami provedete, jako je nastavení zabezpečení, přihlášení a vyplňování formulářů. Svůj prohlížeč můžete nastavit tak, aby blokoval soubory cookie nebo o nich zasílal upozornění. Mějte na paměti, že některé stránky nebudou bez těchto souborů fungovat. Tyto soubory cookie neukládají žádné informace, které lze přiřadit konkrétní osobě. Tyto soubory cookie můžeme nastavit my nebo poskytovatelé třetích stran, jejichž služby na webu využíváme.',
          toggle: {
            value: 'necessary',
            enabled: true,
            readonly: true
          },
          cookie_table: [{
            col1: 'cc_cookies',
            col2: '.uhcar.cz',
            col3: '1 rok',
            col4: 'Ukládá souhlas uživatele s používáním cookies.',
            is_regex: true
          },
          {
            col1: 'CONSENT',
            col2: '.google.com',
            col3: '7 dní',
            col4: 'Nezbytné pro fungování webu.'
          },
          {
            col1: 'ssupp.vid',
            col2: '.uhcar.cz',
            col3: '6 měsíců',
            col4: 'Soubor cookie nastavený společností Smartsupp k zaznamenání ID návštěvníka.',
          },
          {
            col1: 'ssupp.visits',
            col2: '.uhcar.cz',
            col3: '6 měsíců',
            col4: 'Soubor cookie nastavený společností Smartsupp k zaznamenávání počtu předchozích návštěv, nezbytných pro sledování automatických zpráv.'
          },
          {
            col1: '_GRECAPTCHA',
            col2: 'www.google.com',
            col3: '5 měsíců 27 dní',
            col4: 'Tento soubor cookie je nastaven službou Google recaptcha k identifikaci robotů za účelem ochrany webové stránky před škodlivými útoky spamu.'
          },
          ]
        }, {
          title: 'Analytické cookies',
          description: 'Tyto soubory cookie se používají ke zlepšení fungování webových stránek. Umožňují nám rozpoznat a sledovat počet návštěvníků a sledovat, jak návštěvníci web používají. Pomáhají nám zlepšovat způsob, jakým webové stránky fungují, například tím, že uživatelům umožňují snadno najít to, co hledají. Tyto soubory cookie neshromažďují informace, které by vás mohly identifikovat. Pomocí těchto nástrojů analyzujeme a pravidelně zlepšujeme funkčnost našich webových stránek. Získané statistiky můžeme využít ke zlepšení uživatelského komfortu a k tomu, aby byla návštěva webu pro vás jako uživatele zajímavější.',
          toggle: {
            value: 'analytics',
            enabled: false,
            readonly: false
          },
          cookie_table: [{
            col1: '_gcl_au',
            col2: '.uhcar.cz',
            col3: '3 měsíce',
            col4: 'Poskytuje Google Tag Manager k experimentování s účinností inzerce webových stránek využívajících jejich služby.',
            is_regex: true
          },
          {
            col1: '_ga',
            col2: '.uhcar.cz',
            col3: '2 roky',
            col4: 'Soubor cookie _ga, nainstalovaný službou Google Analytics, vypočítává údaje o návštěvnících, relacích a kampaních a také sleduje využití webu pro analytický přehled webu. Soubor cookie ukládá informace anonymně a přiřazuje náhodně vygenerované číslo k rozpoznání unikátních návštěvníků.'
          },
          {
            col1: '_gid',
            col2: '.uhcar.cz',
            col3: '1 den',
            col4: 'Soubor cookie _gid nainstalovaný službou Google Analytics ukládá informace o tom, jak návštěvníci používají webovou stránku, a zároveň vytváří analytickou zprávu o výkonu webu. Některá data, která jsou shromažďována, zahrnují počet návštěvníků, jejich zdroj a stránky, které anonymně navštěvují.'
          },
          {
            col1: '_gat_UA-54287801-1',
            col2: '.uhcar.cz',
            col3: '1 minuta',
            col4: 'Varianta souboru cookie _gat nastaveného službami Google Analytics a Správcem značek Google, který umožňuje vlastníkům webových stránek sledovat chování návštěvníků a měřit výkon webu. Prvek vzoru v názvu obsahuje jedinečné identifikační číslo účtu nebo webu, ke kterému se vztahuje.'
          },
          {
            col1: '_ga_J5R49N47GK',
            col2: '.uhcar.cz',
            col3: '2 roky',
            col4: 'Tento soubor cookie je nainstalován službou Google Analytics.'
          },
          {
            col1: 'sid',
            col2: '.seznam.cz',
            col3: '1 měsíc',
            col4: 'Sid cookie obsahuje digitálně podepsané a šifrované záznamy ID účtu Google uživatele a posledního času přihlášení.'
          },
          {
            col1: 'leady_session_id',
            col2: '.uhcar.cz',
            col3: 'relace',
            col4: 'Sleduje session ID pro Leady'
          },
          {
            col1: 'FPLC',
            col2: '.uhcar.cz',
            col3: '20 hodin',
            col4: 'Používají se pro serverové trackovací účely Google Analytics.'
          },
          {
            col1: 'FPID',
            col2: '.uhcar.cz',
            col3: '2 roky',
            col4: 'Používají se pro serverové trackovací účely Google Analytics.'
          },
          {
            col1: 'FPAU',
            col2: '.uhcar.cz',
            col3: '3 měsíce',
            col4: 'Používají se pro serverové trackovací účely Google Analytics.'
          },
          {
            col1: '1P_JAR',
            col2: '.google.com',
            col3: '30 dní',
            col4: 'Vytváří statistiku z webu.'
          }
          ]
        }, {
          title: 'Marketingové cookies',
          description: 'Používají se ke sledování preferencí webu uživatele za účelem cílení reklamy, tj. zobrazování marketingových a reklamních sdělení (i na stránkách třetích stran), které mohou návštěvníka webu zajímat, v souladu s těmito preferencemi. Marketingové cookies využívají nástroje externích společností. Tyto marketingové soubory cookie budou použity pouze s vaším souhlasem.',
          toggle: {
            value: 'advertisement',
            enabled: false,
            readonly: false
          },
          cookie_table: [{
            col1: 'c',
            col2: 't.leady.com',
            col3: '15 let 2 měsíce 13 dní 14 hodin',
            col4: 'Tento soubor cookie je nastaven společností Rubicon Project za účelem řízení synchronizace identifikace uživatele a výměny uživatelských dat mezi různými reklamními službami.'
          },
          {
            col1: 'test_cookie',
            col2: '.doubleclick.net',
            col3: '15 minut',
            col4: 'Test_cookie nastavuje doubleclick.net a používá se k určení, zda prohlížeč uživatele podporuje soubory cookie.'
          },
          {
            col1: '_fbp',
            col2: '.uhcar.cz',
            col3: '3 měsíce',
            col4: 'Tento soubor cookie je nastaven společností Facebook, aby po návštěvě webové stránky zobrazoval reklamy na Facebooku nebo na digitální platformě poháněné reklamou na Facebooku.'
          },
          {
            col1: '_gfp_64b',
            col2: '.seznam.cz',
            col3: '13 měsíců',
            col4: 'Soubory cookie k marketingovým účelům Seznam.'
          },
          {
            col1: 'DV',
            col2: '.google.com',
            col3: '7 minut',
            col4: 'Ukládá informace o chování na stránce a sleduje reklamy před navštívením stránky k účelům následného využítí pro reklamu.'
          },
          {
            col1: 'NID',
            col2: '.google.com',
            col3: '6 měsíců',
            col4: 'Ukládá preference a preferovaná nastavení uživatele, lze využít k zobrazování reklam.'
          },
          {
            col1: 'WeatherLocality',
            col2: '.seznam.cz',
            col3: '30 dní',
            col4: 'Ukládá polohu pro Seznam.'
          },
          {
            col1: 'OTZ',
            col2: '.google.com',
            col3: '16 dní',
            col4: 'Používá se pro úpravu výběru reklam na základě google informací.'
          }
          ]
        }, {
          title: 'Více informací',
          description: 'Pokud máte nějaké další otázky ohledně cookies, nebo chcete znát více informací <a class="cc-link" href="/kontakt" target="_blank">kontaktujte nás</a>.',
        }]
      }
    }
  }
});

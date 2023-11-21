/**
 * Načítame knižnicu HTTP axios, ktorá nám umožňuje jednoducho zadávať požiadavky
 * do nášho Laravel back-endu. Táto knižnica automaticky spracuje odoslanie
 * Token CSRF ako hlavička na základe hodnoty súboru cookie tokenu „XSRF“.
 */

import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo odhaľuje expresívne API na prihlásenie na odber kanálov a počúvanie
 * na podujatia, ktoré vysiela Laravel. Echo a vysielanie udalostí
 * umožňuje vášmu tímu jednoducho vytvárať robustné webové aplikácie v reálnom čase.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

/**Vysvětlení Zakomentovaných Částí:
 Laravel Echo a Pusher:
    Laravel Echo je knihovna, která poskytuje expresivní API pro pracování s WebSockets,
    obzvláště s Pusherem. Pusher je služba, která umožňuje vytvářet real-time aplikace s WebSockets,
    jako jsou chatovací aplikace, real-time notifikace, atd.

    Zakomentovaný kód v bootstrap.js je předpřipravená šablona pro použití Laravel Echo s Pusherem.
    Pokud plánujete používat real-time funkcionalitu ve vaší aplikaci, budete tento kód potřebovat.

    Pokud plánujete implementovat real-time funkce (například real-time chat, oznámení atd.),
    pak byste měli tyto části odkomentovat a nakonfigurovat podle vašich specifických potřeb.
    Budete potřebovat Pusher účet a nainstalovat a nakonfigurovat Laravel Echo a Pusher v Laravel aplikaci.

 Jak Odkomentovat a Konfigurovat:
    Pokud se rozhodnete používat Laravel Echo a Pusher, postupujte následovně:
    Odkomentujte kód v bootstrap.js týkající se Laravel Echo a Pusher.
    Nastavte vaše Pusher klíče a další konfigurace v .env souboru vaší Laravel aplikace.
    Nainstalujte potřebné balíčky pomocí Composeru a npm, pokud jste tak již neučinili (např. laravel-echo, pusher-js).
    Nastavte broadcasting v konfiguračních souborech Laravelu (např. config/broadcasting.php).

 Závěr:
    Zda odkomentovat a použít tento kód závisí na specifických požadavcích vaší aplikace.
    Pro běžné aplikace, které nevyžadují real-time interakci, není nutné toto nastavení provádět. */

# PlanningSchedules - Plánování rozvrhů

## Popis:

Úkolem zadání je vytvořit jednoduchý informační systém pro plánování výukových aktivit předmětů do školních rozvrhů.

Každý předmět má:
- Unikátní označení (např. zkratka předmětu)
- Další vhodné atributy (např. název, anotace, počet kreditů apod.)
- Svého garanta definující vyučující předmětu
- Výukové aktivity

Výuková aktivita obsahuje:
- Označení (např. přednáška, cvičení, apod.)
- Délku trvání
- Opakování (možnosti: každý, sudý, lichý týden a jednorázová aktivita)

Rozvrh se skládá z:
- Výukových aktivit předmětů plánovaných do rozvrhových oken (jednotku rozvrhového okna uvažujte např. 1 hodinu)
- Přiřazením místnosti a vyučujícího

### Role:

#### Administrátor
- Spravuje uživatele
- Spravuje seznam místností
- Spravuje seznam předmětů a nastavuje garanty předmětů
- Má práva všech následujících rolí

#### Garant předmětu
- Spravuje výukové aktivity předmětu
- Nastavuje vyučující do kurzu
- Definuje volitelné požadavky výukových aktivit na rozvrh (požadavek na místnost, vyučujícího, vyhovující/nevyhovující dny a časy; případně rozvrhové jednotky)
- Má práva vyučujícího kurzu, který garantuje

#### Vyučující
- Definuje osobní požadavky na rozvrh (vyhovující/nevyhovující dny a časy; případně rozvrhové jednotky)

#### Rozvrhář
- Umísťuje výukové aktivity do rozvrhu a přiřazuje jim místnosti (kolize místností a požadavky na rozvrh)

#### Student
- Přidávají/odebírají si předměty do osobního rozvrhu
- Vidí rozvrh svých výukových aktivit

#### Neregistrovaný uživatel
- Prochází anotace předmětů
---
# Návrh Modelu Relačnej Databázy

## Tabuľky

### Tabuľka Užívateľov
Obsahuje základné informácie o užívateľoch, vrátane ich role (administrátor, garant, vyučujúci, rozvrhár, študent).

### Tabuľka Predmetov
Obsahuje informácie o jednotlivých predmetoch vrátane ich označenia, názvu, anotácie a počtu kreditov.

### Tabuľka Výučbových Aktivít
Spája predmety s výučbovými aktivitami a zahrňuje informácie ako označenie aktivity, dĺžka trvania a opakovanie.

### Tabuľka Miestností
Obsahuje informácie o miestnostiach.

### Tabuľka Rozvrhov
Spája výučbové aktivity s miestnosťami a časom.

### Ďalšie tabuľky
Pre požiadavky na rozvrh, osobné rozvrhy študentov atď.

## Implementačné Prostredie

### Front-end

- Webové rozhranie s **HTML5**, **CSS**, **JavaScriptom**, **Laravel**.
- Využitie **Bootstrapu** pre responzívny dizajn a **jQuery** pre dynamické interakcie.
- Případně lze využít i AJAX či pokročilejší klientské frameworky (Angular, React, Vue, apod.) - Volitelne

### Back-end

- **PHP** pre serverovú logiku.
- Využitie **MySQL** pre databázové operácie.

## Funkcionalita

1. **Administrátor** bude mať možnosť spravovať všetky aspekty systému.
2. **Garant predmetu** môže spravovať výučbové aktivity predmetu, nastavovať vyučujúcich a definovať požiadavky na rozvrh.
3. **Vyučujúci** môže definovať svoje osobné požiadavky na rozvrh.
4. **Rozvrhár** môže umiestňovať výučbové aktivity do rozvrhu.
5. **Študenti** môžu pridávať/odoberať predmety z ich osobného rozvrhu.
6. Ochrana proti zadávaniu nesmyselných alebo nekonzistentných údajov.
7. Prihlasovanie a odhlasovanie užívateľov.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

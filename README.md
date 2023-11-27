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
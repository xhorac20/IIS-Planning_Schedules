@extends('layouts.app')

@section('title', 'DashBoard')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <!-- Názov aplikácie -->
            <h1>Názov Aplikácie: Planning Schedules</h1>

            <!-- Zoznam tvorcov a ich úloh -->
            <section class="creators">
                <h2>Tvorcovia</h2>
                <ul>
                    <li>Andrej Horáček (xhorac20) - Implementacia Prihlasovania, Registracie, Roly Hosta, Uzivatela, Studenta a Garanta</li>
                    <li>Jakub Brčiak (xbrcia00) - Implementacia Role Admina</li>
                    <li>Matěj Novák (xnovak2) - Implementacia Roly Vyucujuceho a Rozvrhara</li>
                </ul>
            </section>

            <!-- Popis rolí -->
            <section class="roles-description">
                <h2>Popis Rolí</h2>
                <dl>
                    <dt>Admin</dt>
                    <dd>– Správa celkovej aplikácie a používateľov.</dd>
                    <dd>– Má práva všetkych nasledujúcich rolý.</dd>
                    <dt>Garant</dt>
                    <dd>– Riadi vyučovacie aktivity predmetu</dd>
                    <dd>– Nastaví učiteľa na predmet</dd>
                    <dd>– Definuje voliteľné požiadavky aktivít predmetu</dd>
                    <dd>– Sam má práva ako učiteľ pre svoj predmet</dd>
                    <dt>Učiteľ</dt>
                    <dd>– definuje požiadavky osobného rozvrhu</dd>
                    <dt>Študent</dt>
                    <dd>– Pridá/odstráni položky do osobného rozvrhu.</dd>
                    <dd>– Zobraziť rozvrh.</dd>
                </dl>
            </section>
        </div>
    </div>
@endsection

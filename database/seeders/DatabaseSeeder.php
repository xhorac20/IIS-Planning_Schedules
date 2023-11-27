<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Vloženie užívateľov
        DB::table('users')->insert([
            ['name' => 'Dio Brando', 'email' => 'dio@brando.com', 'password' => bcrypt('heslo123'), 'role' => 'admin'],
            ['name' => 'Goku Kakarot', 'email' => 'goku@kakarot.com', 'password' => bcrypt('heslo123'), 'role' => 'guarantor'],
            ['name' => 'Monkey D. Luffy', 'email' => 'monkey@luffy.com', 'password' => bcrypt('heslo123'), 'role' => 'teacher'],
            ['name' => 'Zoro Roronoa', 'email' => 'zoro@roronoa.com', 'password' => bcrypt('heslo123'), 'role' => 'scheduler'],
            ['name' => 'Sanji Vinsmoke', 'email' => 'sanji@vinsmoke.com', 'password' => bcrypt('heslo123'), 'role' => 'student'],
            ['name' => 'Freddy Fazbear', 'email' => 'freddy@fazbear.com', 'password' => bcrypt('heslo123'), 'role' => 'user'],
            // Ďalšie záznamy...
        ]);

        // Vloženie predmetov
        DB::table('subjects')->insert([
            ['code' => 'IMA2', 'name' => 'Matematická analýza 2', 'annotation' => 'text', 'credits' => 4, 'guarantor_id' => 2],
            ['code' => 'IIS', 'name' => 'Informační systémy', 'annotation' => 'text', 'credits' => 4, 'guarantor_id' => 2],
            ['code' => 'IMS', 'name' => 'Modelování a simulace', 'annotation' => 'text', 'credits' => 5, 'guarantor_id' => 2],
            ['code' => 'ISA', 'name' => 'Síťové aplikace a správa sítí', 'annotation' => 'text', 'credits' => 5, 'guarantor_id' => 2],
            ['code' => 'IAL', 'name' => 'Algoritmy', 'annotation' => '', 'credits' => 5, 'guarantor_id' => 2],
            ['code' => 'IFJ', 'name' => 'Formální jazyky a překladače', 'annotation' => 'text', 'credits' => 5, 'guarantor_id' => 2],
            // Ďalšie záznamy...
        ]);

        // Vloženie vzdelávacích aktivít
        DB::table('educational_activities')->insert([
            ['subject_id' => 1, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 1, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 2, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 2, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 3, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 3, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 4, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 4, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 5, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 5, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 6, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 6, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            ['subject_id' => 1, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 1, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 2, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 2, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 3, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 3, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 4, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 4, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 5, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 5, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 6, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Párny', 'event_date' => null],
            ['subject_id' => 6, 'type' => 'Cvičenie', 'duration' => 110, 'repetition' => 'Nepárny', 'event_date' => null],
            ['subject_id' => 6, 'type' => 'Skúška', 'duration' => 50, 'repetition' => 'Jednorázovo', 'event_date' => \Carbon\Carbon::create(2023, 11, 28),],
            ['subject_id' => 6, 'type' => 'Skúška', 'duration' => 50, 'repetition' => 'Jednorázovo', 'event_date' => \Carbon\Carbon::create(2023, 10, 27),],
            ['subject_id' => 1, 'type' => 'Prednáška', 'duration' => 110, 'repetition' => 'Každý', 'event_date' => null],
            // Ďalšie záznamy...
        ]);

        // Vloženie miestností
        DB::table('rooms')->insert([
            ['name' => 'D105', 'location' => '1. podlaží', 'capacity' => 316],
            ['name' => 'D0206', 'location' => '-2. podlaží', 'capacity' => 154],
            ['name' => 'D0207', 'location' => '-2. podlaží', 'capacity' => 90],
            ['name' => 'E104', 'location' => '1. podlaží', 'capacity' => 70],
            ['name' => 'E105', 'location' => '1. podlaží', 'capacity' => 70],
            ['name' => 'E112', 'location' => '1. podlaží', 'capacity' => 154],
            ['name' => 'A112', 'location' => '1. podlaží', 'capacity' => 64],
            ['name' => 'A113', 'location' => '1. podlaží', 'capacity' => 64],
            ['name' => 'A218', 'location' => '2. podlaží', 'capacity' => 26],
            ['name' => 'C209', 'location' => '2. podlaží', 'capacity' => 35],
            ['name' => 'C228', 'location' => '2. podlaží', 'capacity' => 25],
            ['name' => 'C236', 'location' => '2. podlaží', 'capacity' => 21],
            ['name' => 'C304', 'location' => '3. podlaží', 'capacity' => 20],
            ['name' => 'G108', 'location' => '1. podlaží', 'capacity' => 55],
            ['name' => 'G202', 'location' => '2. podlaží', 'capacity' => 80],
            ['name' => 'L116', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'L220', 'location' => '2. podlaží', 'capacity' => 16],
            ['name' => 'L304', 'location' => '3. podlaží', 'capacity' => 15],
            ['name' => 'L306.1', 'location' => '3. podlaží', 'capacity' => 15],
            ['name' => 'L314', 'location' => '3. podlaží', 'capacity' => 30],
            ['name' => 'M103', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'M104', 'location' => '1. podlaží', 'capacity' => 21],
            ['name' => 'M105', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'N103', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'N104', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'N105', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'N203', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'N204', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'N205', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'O105', 'location' => '1. podlaží', 'capacity' => 20],
            ['name' => 'O203', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'O204', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'O205', 'location' => '2. podlaží', 'capacity' => 20],
            ['name' => 'P108', 'location' => '1. podlaží', 'capacity' => 80],
            ['name' => 'Q304', 'location' => '3. podlaží', 'capacity' => 10],
            ['name' => 'Q322', 'location' => '3. podlaží', 'capacity' => 10],
            ['name' => 'S206', 'location' => '2. podlaží', 'capacity' => 16],
            ['name' => 'S207', 'location' => '2. podlaží', 'capacity' => 12]
            // Ďalšie záznamy...
        ]);

        // Vloženie rozvrhov day = 'Po', 'Ut', 'St', 'Št', 'Pi'
        DB::table('schedules')->insert([
            ['educational_activity_id' => 1, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Po', 'start_time' => '08:00:00', 'end_time' => '09:50:00'],
            ['educational_activity_id' => 27, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Po', 'start_time' => '08:00:00', 'end_time' => '09:50:00'],
            ['educational_activity_id' => 2, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'Po', 'start_time' => '09:00:00', 'end_time' => '10:50:00'],
            ['educational_activity_id' => 3, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'St', 'start_time' => '08:00:00', 'end_time' => '09:50:00'],
            ['educational_activity_id' => 4, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'Št', 'start_time' => '08:00:00', 'end_time' => '09:50:00'],
            ['educational_activity_id' => 5, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Pi', 'start_time' => '08:00:00', 'end_time' => '09:50:00'],
            ['educational_activity_id' => 6, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'Po', 'start_time' => '10:00:00', 'end_time' => '11:50:00'],
            ['educational_activity_id' => 7, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Ut', 'start_time' => '10:00:00', 'end_time' => '11:50:00'],
            ['educational_activity_id' => 8, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'St', 'start_time' => '10:00:00', 'end_time' => '11:50:00'],
            ['educational_activity_id' => 9, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Št', 'start_time' => '10:00:00', 'end_time' => '11:50:00'],
            ['educational_activity_id' => 10, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'Pi', 'start_time' => '10:00:00', 'end_time' => '11:50:00'],
            ['educational_activity_id' => 11, 'room_id' => 1, 'instructor_id' => 2, 'day' => 'Po', 'start_time' => '12:00:00', 'end_time' => '13:50:00'],
            ['educational_activity_id' => 12, 'room_id' => 1, 'instructor_id' => 3, 'day' => 'Ut', 'start_time' => '12:00:00', 'end_time' => '13:50:00'],
            ['educational_activity_id' => 13, 'room_id' => 2, 'instructor_id' => 2, 'day' => 'St', 'start_time' => '12:00:00', 'end_time' => '13:50:00'],
            ['educational_activity_id' => 14, 'room_id' => 3, 'instructor_id' => 3, 'day' => 'Št', 'start_time' => '12:00:00', 'end_time' => '13:50:00'],
            ['educational_activity_id' => 15, 'room_id' => 4, 'instructor_id' => 2, 'day' => 'Pi', 'start_time' => '12:00:00', 'end_time' => '13:50:00'],
            ['educational_activity_id' => 16, 'room_id' => 5, 'instructor_id' => 3, 'day' => 'Po', 'start_time' => '14:00:00', 'end_time' => '15:50:00'],
            ['educational_activity_id' => 17, 'room_id' => 6, 'instructor_id' => 2, 'day' => 'Ut', 'start_time' => '14:00:00', 'end_time' => '15:50:00'],
            ['educational_activity_id' => 18, 'room_id' => 7, 'instructor_id' => 3, 'day' => 'St', 'start_time' => '14:00:00', 'end_time' => '15:50:00'],
            ['educational_activity_id' => 19, 'room_id' => 8, 'instructor_id' => 2, 'day' => 'Št', 'start_time' => '14:00:00', 'end_time' => '15:50:00'],
            ['educational_activity_id' => 20, 'room_id' => 9, 'instructor_id' => 3, 'day' => 'Pi', 'start_time' => '14:00:00', 'end_time' => '15:50:00'],
            ['educational_activity_id' => 21, 'room_id' => 10, 'instructor_id' => 2, 'day' => 'Po', 'start_time' => '16:00:00', 'end_time' => '17:50:00'],
            ['educational_activity_id' => 22, 'room_id' => 11, 'instructor_id' => 3, 'day' => 'Ut', 'start_time' => '16:00:00', 'end_time' => '17:50:00'],
            ['educational_activity_id' => 23, 'room_id' => 12, 'instructor_id' => 2, 'day' => 'St', 'start_time' => '16:00:00', 'end_time' => '17:50:00'],
            ['educational_activity_id' => 24, 'room_id' => 13, 'instructor_id' => 3, 'day' => 'Št', 'start_time' => '16:00:00', 'end_time' => '17:50:00'],
            ['educational_activity_id' => 25, 'room_id' => 13, 'instructor_id' => 3, 'day' => 'Ut', 'start_time' => '16:00:00', 'end_time' => '16:50:00'],
            ['educational_activity_id' => 26, 'room_id' => 12, 'instructor_id' => 3, 'day' => 'Pi', 'start_time' => '16:00:00', 'end_time' => '16:50:00'],
            // Ďalšie záznamy...
        ]);

        // Vloženie študentských rozvrhov
        DB::table('student_schedules')->insert([
            // Ďalšie záznamy...
        ]);

        // Ďalšie vkladanie dát podľa potreby...
    }
}

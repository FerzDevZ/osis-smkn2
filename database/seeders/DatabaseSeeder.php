<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sekbid;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Ukk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Minimal user for login
        User::query()->delete();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Sekbid sample
        Sekbid::query()->delete();
        $sekbids = [
            [
                'name' => 'Sekbid 1',
                'slug' => 'sekbid-1',
                'description' => 'Program kerja dan deskripsi Sekbid 1',
                'display_order' => 1,
                'programs' => [
                    'Mengkoordinasikan kegiatan OSIS bidang 1',
                    'Menyusun jadwal kegiatan berkala',
                ],
            ],
            [
                'name' => 'Sekbid 2',
                'slug' => 'sekbid-2',
                'description' => 'Program kerja dan deskripsi Sekbid 2',
                'display_order' => 2,
                'programs' => [
                    'Membuat proposal kegiatan',
                    'Monitoring pelaksanaan program',
                ],
            ],
            [
                'name' => 'Sekbid 9 - TIK',
                'slug' => 'sekbid-9-tik',
                'description' => 'Koordinasi Sie Desain, Multimedia, dan Website.',
                'display_order' => 9,
                'programs' => [
                    'Mengelola website resmi OSIS',
                    'Dokumentasi foto/video setiap event',
                    'Pembuatan poster hari besar',
                ],
            ],
        ];
        foreach ($sekbids as $s) { Sekbid::create($s); }

        // Events sample
        Event::query()->delete();
        Event::create([
            'title' => 'CLASMEETING 2023',
            'slug' => 'clasmeeting-2023',
            'description' => "Bidang lomba: Voli, Dodgeball, Saba Idol, Simbokku Poster.",
            'start_at' => now()->subMonths(10),
            'end_at' => now()->subMonths(10)->addDays(1),
            'location' => 'SMKN 2 Pangkalpinang',
            'is_published' => true,
        ]);
        Event::create([
            'title' => 'SINTESA 2024',
            'slug' => 'sintesa-2024',
            'description' => 'Beyond your ability to shining like a star.',
            'start_at' => now()->subMonths(7),
            'end_at' => now()->subMonths(7)->addDay(),
            'location' => 'Lapangan SMKN 2 Pangkalpinang',
            'is_published' => true,
        ]);

        // Gallery sample
        Gallery::query()->delete();
        Gallery::create([
            'title' => 'Dokumentasi Lustrum',
            'description' => 'Cuplikan kegiatan Lustrum.',
            'album_date' => now()->subMonths(12)->toDateString(),
        ]);
        Gallery::create([
            'title' => 'Classmeeting',
            'description' => 'Potret Classmeeting di SMKN 2 Pangkalpinang.',
            'album_date' => now()->subMonths(10)->toDateString(),
        ]);

        // Organizations sample
        Organization::query()->delete();
        Organization::create([
            'name' => 'MPK',
            'slug' => 'mpk',
            'description' => 'Majelis Perwakilan Kelas SMKN 2 Pangkalpinang.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 1,
            'programs' => [ 'Musyawarah kelas', 'Pengawasan kinerja OSIS' ],
        ]);
        Organization::create([
            'name' => 'Paskibra',
            'slug' => 'paskibra',
            'description' => 'Pasukan Pengibar Bendera.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 2,
            'programs' => [ 'Latihan rutin', 'Upacara peringatan' ],
        ]);
        Organization::create([
            'name' => 'Pramuka',
            'slug' => 'pramuka',
            'description' => 'Gerakan Pramuka SMKN 2 Pangkalpinang.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 3,
            'programs' => [ 'Latihan kepramukaan', 'Perkemahan' ],
        ]);

        // UKK sample
        Ukk::query()->delete();
        Ukk::create([
            'name' => 'Jurnalistik',
            'slug' => 'jurnalistik',
            'description' => 'Unit kegiatan jurnalistik dan buletin sekolah.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 1,
            'programs' => [ 'Peliputan event', 'Publikasi buletin' ],
        ]);
        Ukk::create([
            'name' => 'Paduan Suara',
            'slug' => 'paduan-suara',
            'description' => 'Paduan suara siswa SMKN 2 Pangkalpinang.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 2,
            'programs' => [ 'Latihan rutin', 'Tampil di acara sekolah' ],
        ]);
        Ukk::create([
            'name' => 'IT Club',
            'slug' => 'it-club',
            'description' => 'Komunitas teknologi informasi: coding, desain, multimedia.',
            'instagram_url' => null,
            'contact' => 'CP: 08xxxxxxxxxx',
            'display_order' => 3,
            'programs' => [ 'Kelas pemrograman', 'Workshop desain' ],
        ]);
    }
}

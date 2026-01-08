<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Download;
use App\Models\Event;
use App\Models\Post;

class UltimateUpgradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Members
        Member::create([
            'name' => 'Ferdinand',
            'position' => 'Ketua Umum',
            'period' => '2023/2024',
            'department' => 'BPH',
            'instagram_url' => 'https://instagram.com/',
            'display_order' => 1
        ]);
        Member::create([
            'name' => 'Sarah Jasmine',
            'position' => 'Sekretaris Umum',
            'period' => '2023/2024',
            'department' => 'BPH',
            'display_order' => 2
        ]);
        Member::create([
            'name' => 'Budi Santoso',
            'position' => 'Ketua Sekbid 1',
            'period' => '2023/2024',
            'department' => 'Sekbid 1',
            'display_order' => 10
        ]);

        // 2. Downloads
        Download::create([
            'title' => 'Formulir Pendaftaran Ekstrakurikuler',
            'description' => 'Gunakan formulir ini untuk mendaftar ekskul pilihanmu.',
            'file_path' => 'downloads/dummy_form.pdf',
            'file_type' => 'pdf',
            'category' => 'Formulir'
        ]);
        Download::create([
            'title' => 'AD/ART OSIS SMKN 2',
            'description' => 'Anggaran Dasar dan Anggaran Rumah Tangga OSIS SMKN 2 Pangkalpinang.',
            'file_path' => 'downloads/ad_art.pdf',
            'file_type' => 'pdf',
            'category' => 'Dokumen Resmi'
        ]);

        // 3. Update existing events or add new ones with progress
        Event::where('is_featured', false)->update(['is_featured' => true, 'progress' => 85]);
        
        Event::create([
            'title' => 'SINTESA 2024',
            'slug' => 'sintesa-2024-new',
            'description' => 'Pesta Seni dan Kreativitas Siswa SMKN 2.',
            'start_at' => now()->addMonths(2),
            'location' => 'GOR SMKN 2',
            'is_published' => true,
            'is_featured' => true,
            'progress' => 45,
            'category' => 'Art'
        ]);

        // 4. Create Blog Posts
        $user = \App\Models\User::first();
        if ($user) {
            Post::create([
                'title' => 'Tips Belajar Efektif Saat Classmeet',
                'slug' => 'tips-belajar-classmeet',
                'excerpt' => 'Gimana caranya tetep fokus belajar sambil ikut lomba?',
                'body' => 'Isi konten blog yang seru dan edukatif...',
                'status' => 'published',
                'type' => 'blog',
                'published_at' => now(),
                'author_id' => $user->id
            ]);
            
            Post::create([
                'title' => 'Kenapa Ikut OSIS Itu Penting?',
                'slug' => 'pentingnya-osis',
                'excerpt' => 'Bukan cuma soal dapet sertifikat, tapi soal skill!',
                'body' => 'Konten inspiratif tentang OSIS...',
                'status' => 'published',
                'type' => 'blog',
                'published_at' => now()->subDays(2),
                'author_id' => $user->id
            ]);
        }
    }
}

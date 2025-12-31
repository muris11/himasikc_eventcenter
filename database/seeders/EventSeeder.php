<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        if (EventCategory::count() == 0) {
            return;
        }

        $events = [
            [
                'title' => 'Workshop Laravel 12 untuk Pemula',
                'description' => 'Pelajari dasar-dasar Laravel 12 dari nol hingga mahir. Workshop ini akan membahas instalasi, routing, controller, model, dan view. Cocok untuk pemula yang ingin memulai karir sebagai web developer.',
                'location' => 'Lab Komputer Gedung A, Politeknik Negeri Indramayu',
                'participant_type' => 'mahasiswa',
                'category' => 'workshop',
            ],
            [
                'title' => 'Seminar AI dan Machine Learning 2025',
                'description' => 'Seminar tentang perkembangan terkini Artificial Intelligence dan Machine Learning. Pembicara dari praktisi industri akan berbagi pengalaman dan insight tentang implementasi AI di dunia nyata.',
                'location' => 'Aula Utama Polindra',
                'participant_type' => 'umum',
                'category' => 'seminar',
            ],
            [
                'title' => 'Hackathon Smart City Indonesia',
                'description' => 'Kompetisi hackathon 48 jam untuk menciptakan solusi teknologi Smart City. Hadiah total jutaan rupiah menanti pemenang. Tim terdiri dari 3-5 orang.',
                'location' => 'Gedung Innovation Hub Jakarta',
                'participant_type' => 'umum',
                'category' => 'hackathon',
            ],
            [
                'title' => 'Webinar Cybersecurity Awareness',
                'description' => 'Webinar online tentang keamanan siber dan cara melindungi data pribadi di era digital. Materi mencakup phishing, malware, dan best practices keamanan.',
                'location' => 'Online via Zoom',
                'participant_type' => 'all',
                'category' => 'webinar',
            ],
            [
                'title' => 'Kompetisi UI/UX Design Challenge',
                'description' => 'Kompetisi desain UI/UX dengan tema aplikasi kesehatan. Peserta akan membuat prototype aplikasi dalam waktu 2 minggu.',
                'location' => 'Online',
                'participant_type' => 'mahasiswa',
                'category' => 'kompetisi',
            ],
            [
                'title' => 'Tech Talk: Future of Web Development',
                'description' => 'Diskusi panel tentang masa depan pengembangan web. Topik meliputi WebAssembly, Edge Computing, dan AI-powered development.',
                'location' => 'Ruang Seminar Lt. 3 Gedung B',
                'participant_type' => 'all',
                'category' => 'konferensi',
            ],
            [
                'title' => 'Gathering Alumni SIKC 2024',
                'description' => 'Acara gathering tahunan alumni Sistem Informasi Kota Cerdas. Kesempatan networking dan berbagi pengalaman karir.',
                'location' => 'Resto Pantai Indramayu',
                'participant_type' => 'all',
                'category' => 'gathering',
            ],
            [
                'title' => 'Pelatihan Git & GitHub untuk Tim',
                'description' => 'Pelatihan version control menggunakan Git dan kolaborasi melalui GitHub. Materi mencakup branching, merging, pull request, dan CI/CD.',
                'location' => 'Lab Komputer Gedung C',
                'participant_type' => 'mahasiswa',
                'category' => 'pelatihan',
            ],
            [
                'title' => 'Festival Teknologi POLINDRA 2025',
                'description' => 'Festival teknologi tahunan terbesar di Indramayu. Menampilkan pameran inovasi, lomba, workshop, dan hiburan. Free entry!',
                'location' => 'Kampus Politeknik Negeri Indramayu',
                'participant_type' => 'umum',
                'category' => 'festival',
            ],
            [
                'title' => 'Networking Night: IT Professionals',
                'description' => 'Malam networking untuk profesional IT. Kesempatan bertemu dengan praktisi dari berbagai perusahaan teknologi.',
                'location' => 'Hotel Aston Cirebon',
                'participant_type' => 'umum',
                'category' => 'networking',
            ],
            [
                'title' => 'Workshop Mobile App Development',
                'description' => 'Belajar membuat aplikasi mobile dengan Flutter. Dari instalasi hingga publish ke Play Store.',
                'location' => 'Lab Mobile Computing Gedung D',
                'participant_type' => 'mahasiswa',
                'category' => 'workshop',
            ],
            [
                'title' => 'Seminar Startup dan Entrepreneurship',
                'description' => 'Seminar tentang membangun startup teknologi. Pembicara dari founder startup sukses Indonesia.',
                'location' => 'Auditorium Polindra',
                'participant_type' => 'all',
                'category' => 'seminar',
            ],
            [
                'title' => 'Competitive Programming Contest',
                'description' => 'Kompetisi programming dengan soal algoritma dan struktur data. Individual contest dengan durasi 5 jam.',
                'location' => 'Lab Komputer Gedung A',
                'participant_type' => 'mahasiswa',
                'category' => 'kompetisi',
            ],
            [
                'title' => 'Webinar Cloud Computing AWS',
                'description' => 'Pengenalan cloud computing dengan Amazon Web Services. Materi mencakup EC2, S3, Lambda, dan RDS.',
                'location' => 'Online via Google Meet',
                'participant_type' => 'all',
                'category' => 'webinar',
            ],
            [
                'title' => 'IoT Innovation Hackathon',
                'description' => 'Hackathon khusus Internet of Things. Buat prototype smart device dalam 24 jam!',
                'location' => 'Makerspace Polindra',
                'participant_type' => 'mahasiswa',
                'category' => 'hackathon',
            ],
            [
                'title' => 'Conference on Data Science',
                'description' => 'Konferensi nasional tentang Data Science. Presentasi paper dan poster session.',
                'location' => 'Convention Center Bandung',
                'participant_type' => 'umum',
                'category' => 'konferensi',
            ],
            [
                'title' => 'Gathering HIMA SIKC 2025',
                'description' => 'Gathering internal anggota HIMA SIKC. Acara outbond, games, dan makan bersama.',
                'location' => 'Taman Wisata Alam Indramayu',
                'participant_type' => 'mahasiswa',
                'category' => 'gathering',
            ],
            [
                'title' => 'Pelatihan Database PostgreSQL',
                'description' => 'Pelatihan database PostgreSQL untuk developer. Dari basic query hingga optimization.',
                'location' => 'Lab Database Gedung B',
                'participant_type' => 'mahasiswa',
                'category' => 'pelatihan',
            ],
            [
                'title' => 'Festival Inovasi Digital',
                'description' => 'Festival showcasing inovasi digital mahasiswa. Pameran project akhir dan startup pitching.',
                'location' => 'Gedung Rektorat Polindra',
                'participant_type' => 'all',
                'category' => 'festival',
            ],
            [
                'title' => 'Career Fair Tech Companies',
                'description' => 'Job fair khusus perusahaan teknologi. Networking langsung dengan HR dari berbagai tech company.',
                'location' => 'Aula Serbaguna Polindra',
                'participant_type' => 'mahasiswa',
                'category' => 'networking',
            ],
        ];

        $categories = EventCategory::all()->keyBy('slug');

        foreach ($events as $index => $event) {
            $slug = Str::slug($event['title']);

            // Ensure unique slug
            $existingSlug = Event::where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug.'-'.($index + 1);
            }

            Event::create([
                'title' => $event['title'],
                'slug' => $slug,
                'description' => $event['description'],
                'location' => $event['location'],
                'date' => now()->addDays(rand(7, 180)),
                'participant_type' => $event['participant_type'],
                'event_category_id' => $categories[$event['category']]->id ?? EventCategory::first()->id,
                'is_active' => true,
            ]);
        }
    }
}

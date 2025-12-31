<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default user if none exists
        $user = User::first();
        if (! $user) {
            $user = User::create([
                'name' => 'Admin HIMA SIKC',
                'email' => 'admin@hima.com',
                'password' => 'password',
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]);
        }

        if (PostCategory::count() == 0) {
            return;
        }

        $posts = [
            [
                'title' => 'Panduan Lengkap Belajar Laravel 12 untuk Pemula',
                'content' => 'Laravel 12 adalah framework PHP paling populer saat ini. Artikel ini akan membahas langkah-langkah memulai belajar Laravel dari nol. Mulai dari instalasi Composer, membuat project baru, hingga memahami struktur folder Laravel. Framework ini menggunakan arsitektur MVC (Model-View-Controller) yang memudahkan pengembangan aplikasi web modern. Dengan Laravel, Anda bisa membuat API, aplikasi fullstack, bahkan real-time applications.',
                'category' => 'tutorial',
            ],
            [
                'title' => '10 Tips Meningkatkan Produktivitas sebagai Developer',
                'content' => 'Menjadi developer yang produktif membutuhkan kombinasi skill teknis dan soft skill. Berikut 10 tips yang bisa Anda terapkan: 1) Gunakan keyboard shortcuts, 2) Manfaatkan AI assistant, 3) Buat routine coding, 4) Istirahat teratur dengan teknik Pomodoro, 5) Dokumentasikan code Anda, 6) Code review dengan rekan, 7) Otomatisasi task berulang, 8) Pelajari debugging yang efektif, 9) Jaga kesehatan fisik dan mental, 10) Terus belajar teknologi baru.',
                'category' => 'tips-trik',
            ],
            [
                'title' => 'Tren Teknologi AI yang Akan Mendominasi 2025',
                'content' => 'Artificial Intelligence terus berkembang pesat. Di tahun 2025, beberapa tren AI yang perlu diperhatikan antara lain: Generative AI yang semakin canggih, AI untuk coding (Copilot, Cursor), Multimodal AI, Edge AI, dan AI dalam healthcare. Perusahaan-perusahaan besar berlomba mengembangkan model AI yang lebih efisien dan powerful. Sebagai developer, penting untuk memahami dasar-dasar AI dan bagaimana mengintegrasikannya ke dalam aplikasi.',
                'category' => 'teknologi',
            ],
            [
                'title' => 'Cara Membangun Karir sebagai Fullstack Developer',
                'content' => 'Fullstack developer adalah salah satu posisi paling dicari di industri teknologi. Untuk membangun karir di bidang ini, Anda perlu menguasai frontend (React, Vue, Angular), backend (Node.js, PHP, Python), database, dan DevOps dasar. Mulailah dengan project pribadi, kontribusi ke open source, dan bangun portfolio online. Networking juga penting - ikuti komunitas developer, meetup, dan konferensi.',
                'category' => 'karir',
            ],
            [
                'title' => 'Review Framework JavaScript Terpopuler 2025',
                'content' => 'Memilih framework JavaScript yang tepat bisa membingungkan. Berikut perbandingan singkat: React tetap dominan dengan ekosistem terbesar, Vue.js menawarkan learning curve yang lebih mudah, Svelte memberikan performa terbaik dengan bundle size kecil, dan Angular cocok untuk enterprise application. Pemilihan framework sebaiknya disesuaikan dengan kebutuhan project dan pengalaman tim.',
                'category' => 'review',
            ],
            [
                'title' => 'HIMA SIKC Sukses Gelar Workshop Laravel',
                'content' => 'HIMA SIKC baru saja mengadakan workshop Laravel yang diikuti lebih dari 100 peserta. Workshop berlangsung selama 2 hari dengan materi mulai dari instalasi hingga deployment. Peserta antusias mengikuti setiap sesi dan berhasil membuat project CRUD sederhana. Acara ini merupakan bagian dari program pengembangan skill anggota HIMA SIKC.',
                'category' => 'event',
            ],
            [
                'title' => 'Mengapa Git Version Control Wajib Dikuasai Developer',
                'content' => 'Git adalah skill fundamental yang wajib dikuasai setiap developer. Dengan Git, Anda bisa melacak perubahan code, berkolaborasi dengan tim, dan mengelola berbagai versi aplikasi. Konsep penting yang perlu dipahami: repository, commit, branch, merge, pull request, dan conflict resolution. Platform seperti GitHub, GitLab, dan Bitbucket memudahkan kolaborasi dan CI/CD.',
                'category' => 'tutorial',
            ],
            [
                'title' => 'Kisah Inspiratif: Dari Mahasiswa Biasa Jadi Tech Lead',
                'content' => 'Budi, alumni SIKC angkatan 2018, kini menjadi Tech Lead di startup unicorn Indonesia. Perjalanannya penuh tantangan - dari belajar coding otodidak, magang di berbagai perusahaan, hingga akhirnya dipercaya memimpin tim engineering. Kuncinya menurut Budi: konsistensi belajar, tidak takut gagal, dan selalu humble untuk terus berkembang.',
                'category' => 'inspirasi',
            ],
            [
                'title' => 'Opini: Apakah Gelar Sarjana Masih Relevan di Era AI?',
                'content' => 'Perdebatan tentang relevansi gelar sarjana di industri teknologi semakin hangat. Di satu sisi, banyak perusahaan mulai menghilangkan syarat gelar. Di sisi lain, pendidikan formal memberikan fondasi teori yang kuat. Menurut pendapat penulis, gelar tetap penting tapi bukan satu-satunya faktor. Portfolio, skill praktis, dan kemampuan problem-solving sama pentingnya.',
                'category' => 'opini',
            ],
            [
                'title' => 'Update: Kurikulum SIKC 2025 dengan Mata Kuliah AI',
                'content' => 'Program Studi Sistem Informasi Kota Cerdas mengumumkan update kurikulum terbaru. Mulai semester depan, akan ada mata kuliah baru tentang AI dan Machine Learning. Selain itu, praktikum cloud computing menggunakan AWS juga akan ditambahkan. Perubahan ini sebagai respons terhadap kebutuhan industri dan perkembangan teknologi.',
                'category' => 'berita',
            ],
            [
                'title' => 'Komunitas Developer Indramayu Semakin Berkembang',
                'content' => 'Komunitas developer di Indramayu terus tumbuh. Beberapa komunitas aktif seperti SIKC Tech Community, Indramayu JS, dan Laravel Indramayu rutin mengadakan meetup bulanan. Kegiatan meliputi sharing session, code review bersama, dan hackathon mini. Bagi mahasiswa, bergabung dengan komunitas adalah cara terbaik untuk networking dan belajar dari praktisi.',
                'category' => 'komunitas',
            ],
            [
                'title' => 'Tutorial: Membuat REST API dengan Laravel Sanctum',
                'content' => 'Laravel Sanctum menyediakan autentikasi API yang ringan dan mudah diimplementasikan. Tutorial ini akan membahas: instalasi Sanctum, konfigurasi middleware, membuat endpoint register dan login, mengamankan route dengan token, dan best practices API design. Dengan Sanctum, Anda bisa membuat backend untuk aplikasi mobile atau SPA.',
                'category' => 'tutorial',
            ],
            [
                'title' => '5 Kesalahan Umum Junior Developer dan Cara Menghindarinya',
                'content' => 'Sebagai junior developer, wajar jika membuat kesalahan. Namun, beberapa kesalahan bisa dihindari: 1) Tidak membaca dokumentasi dengan teliti, 2) Copy-paste code tanpa memahami, 3) Tidak menulis unit test, 4) Mengabaikan code review feedback, 5) Takut bertanya. Kunci suksesnya adalah humble, curious, dan terus belajar dari pengalaman.',
                'category' => 'tips-trik',
            ],
            [
                'title' => 'Mengenal WebAssembly: Teknologi Masa Depan Web',
                'content' => 'WebAssembly (Wasm) memungkinkan menjalankan code native di browser dengan performa mendekati aplikasi desktop. Teknologi ini sudah digunakan oleh aplikasi seperti Figma, Google Earth, dan AutoCAD Web. Dengan Wasm, developer bisa membuat aplikasi web yang lebih powerful menggunakan bahasa seperti Rust, C++, atau Go.',
                'category' => 'teknologi',
            ],
            [
                'title' => 'Persiapan Interview Teknis untuk Fresh Graduate',
                'content' => 'Interview teknis bisa menegangkan, tapi dengan persiapan yang baik, Anda bisa sukses. Tips persiapan: 1) Pelajari fundamental (algoritma, data structure), 2) Latihan coding di LeetCode/HackerRank, 3) Review project portfolio Anda, 4) Pelajari teknologi yang digunakan perusahaan, 5) Prepare behavioral questions. Jangan lupa istirahat cukup sebelum interview!',
                'category' => 'karir',
            ],
            [
                'title' => 'Review: VS Code vs Cursor - Mana yang Lebih Baik?',
                'content' => 'VS Code adalah editor paling populer, sementara Cursor adalah pendatang baru dengan fitur AI terintegrasi. Dari segi fitur dasar, keduanya mirip karena Cursor berbasis VS Code. Keunggulan Cursor ada pada AI assistant yang lebih powerful. Namun, VS Code dengan ekstensi Copilot juga tidak kalah. Pilihan tergantung preferensi dan budget Anda.',
                'category' => 'review',
            ],
            [
                'title' => 'Sukses! Mahasiswa SIKC Juara Hackathon Nasional',
                'content' => 'Tim mahasiswa SIKC berhasil meraih juara 1 pada Hackathon Nasional 2025 yang diselenggarakan di Jakarta. Tim yang terdiri dari 4 mahasiswa ini membuat aplikasi Smart Farming berbasis IoT. Mereka bersaing dengan 150 tim dari seluruh Indonesia. Prestasi ini membuktikan kualitas mahasiswa SIKC Polindra di level nasional.',
                'category' => 'berita',
            ],
            [
                'title' => 'Cerita Founder Startup dari Kampung Halaman',
                'content' => 'Rina, founder startup AgriTech yang kini sudah mendapat funding Series A, berbagi ceritanya. Berawal dari keprihatinan terhadap petani di kampung halamannya, ia membangun platform yang menghubungkan petani langsung dengan konsumen. Tantangan terbesar adalah meyakinkan investor dan membangun tim di luar kota besar. Pesannya: masalah lokal bisa jadi peluang bisnis global.',
                'category' => 'inspirasi',
            ],
            [
                'title' => 'Opini: Pentingnya Open Source untuk Developer Indonesia',
                'content' => 'Kontribusi ke open source masih minim di Indonesia. Padahal, manfaatnya sangat besar: meningkatkan skill, membangun reputasi, dan networking global. Kendala umum adalah kurangnya kepercayaan diri dan kesibukan pekerjaan. Penulis berharap semakin banyak developer Indonesia yang aktif berkontribusi ke proyek open source.',
                'category' => 'opini',
            ],
            [
                'title' => 'Kolaborasi HIMA SIKC dengan Industri Teknologi',
                'content' => 'HIMA SIKC menjalin kerjasama dengan beberapa perusahaan teknologi untuk program magang dan guest lecture. Perusahaan yang sudah bergabung antara lain: Tokopedia, Gojek, dan Bukalapak. Program ini bertujuan menjembatani gap antara dunia akademik dan industri. Mahasiswa akan mendapat kesempatan belajar langsung dari praktisi.',
                'category' => 'komunitas',
            ],
        ];

        $categories = PostCategory::all()->keyBy('slug');

        foreach ($posts as $index => $post) {
            $slug = Str::slug($post['title']);

            // Ensure unique slug
            $existingSlug = Post::where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug.'-'.($index + 1);
            }

            Post::create([
                'title' => $post['title'],
                'slug' => $slug,
                'content' => $post['content'],
                'is_published' => true,
                'post_category_id' => $categories[$post['category']]->id ?? PostCategory::first()->id,
                'user_id' => $user->id,
            ]);
        }
    }
}

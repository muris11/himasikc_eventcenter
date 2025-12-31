<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class About extends Component
{
    public function render()
    {
        $title = 'Tentang Kami | HIMA-SIKC Event Center';
        $description = 'Pelajari lebih lanjut tentang HIMA-SIKC Event Center, platform informasi event dan kompetisi mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.';
        $keywords = 'tentang HIMA SIKC, HIMA-SIKC Event Center, organisasi mahasiswa, sistem informasi kota cerdas, politeknik indramayu, polindra';

        return view('livewire.about', [
            'totalEvents' => Event::count(),
            'totalPosts' => Post::count(),
            'milestones' => \App\Models\Milestone::orderBy('year', 'desc')->get(),
        ])->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => route('about'),
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Help extends Component
{
    public function render()
    {
        return view('livewire.help')->layoutData([
            'title' => 'Bantuan & FAQ | HIMA-SIKC Event Center',
            'description' => 'Pusat bantuan dan jawaban atas pertanyaan umum tentang layanan HIMA-SIKC Event Center. Temukan solusi untuk masalah Anda.',
            'keywords' => 'bantuan, faq, support, HIMA-SIKC Event Center, pertanyaan umum',
            'canonical' => route('help'),
        ]);
    }
}

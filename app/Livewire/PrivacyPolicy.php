<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.privacy-policy')->layoutData([
            'title' => 'Kebijakan Privasi | HIMA-SIKC Event Center',
            'description' => 'Pelajari bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda di platform HIMA SIKC Event Center.',
            'keywords' => 'kebijakan privasi, data pribadi, perlindungan data, HIMA-SIKC Event Center, privasi',
            'canonical' => route('privacy-policy'),
        ]);
    }
}

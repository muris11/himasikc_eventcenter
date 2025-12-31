<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class TermsOfService extends Component
{
    public function render()
    {
        return view('livewire.terms-of-service')->layoutData([
            'title' => 'Syarat & Ketentuan | HIMA-SIKC Event Center',
            'description' => 'Baca syarat dan ketentuan penggunaan platform HIMA SIKC Event Center. Ketentuan yang berlaku untuk semua pengguna website.',
            'keywords' => 'syarat ketentuan, terms of service, TOS, aturan penggunaan, HIMA-SIKC Event Center',
            'canonical' => route('terms-of-service'),
        ]);
    }
}

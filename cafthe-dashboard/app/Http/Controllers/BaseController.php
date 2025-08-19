<?php
declare(strict_types=1); // Optionnel, mais recommandé pour le typage strict

namespace App\Http\Controllers; // Doit être la première instruction (ou après declare)

use App\Models\Client;

class BaseController
{
    protected function getSharedData()
    {
        return [
            'clients' => Client::limit(20)->get(),
            // Autres données partagées...
        ];
    }
}

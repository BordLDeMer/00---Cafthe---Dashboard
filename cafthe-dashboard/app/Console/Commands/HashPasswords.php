<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Vendeur;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
    protected $signature = 'hash:passwords';
    protected $description = 'Hash all plain text passwords';

    public function handle()
    {
        $vendeurs = Vendeur::all();

        foreach ($vendeurs as $vendeur) {
            // Supposant que les mots de passe actuels sont en clair
            $plainPassword = $vendeur->mdp;
            $hashedPassword = Hash::make($plainPassword);

            $vendeur->update(['mdp' => $hashedPassword]);

            $this->info("Password hashé pour: " . $vendeur->mail);
        }

        $this->info('Tous les mots de passe ont été hashés !');
    }
}

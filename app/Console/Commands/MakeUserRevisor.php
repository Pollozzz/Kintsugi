<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:make-user-revisor {email}')]
#[Description('Rende un utente revisore')]
class MakeUserRevisor extends Command
{
    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (! $user) {
            $this->error('Utente non trovato');

            return;
        }
        $user->is_revisor = true;
        $user->save();
        $this->info("L'utente {$user->name} è ora un Revisore!");
    }
}

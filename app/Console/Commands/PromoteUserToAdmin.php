<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:promote-user-to-admin {email}')]
#[Description('Grant admin access to an existing user account')]
class PromoteUserToAdmin extends Command
{
    public function handle(): int
    {
        $user = User::query()->where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error('No user account was found with that email address.');

            return self::FAILURE;
        }

        $user->role = 'admin';
        $user->save();

        $this->info("Admin access granted to {$user->email}.");

        return self::SUCCESS;
    }
}

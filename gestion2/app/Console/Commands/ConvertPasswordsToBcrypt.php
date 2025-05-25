<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertPasswordsToBcrypt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-passwords-to-bcrypt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // app/Console/Commands/ConvertPasswordsToBcrypt.php
public function handle()
{
    $users = User::all();
    
    foreach ($users as $user) {
        // Solo convertir si no es bcrypt
        if (password_needs_rehash($user->password, PASSWORD_BCRYPT)) {
            $user->password = Hash::make($user->password);
            $user->save();
        }
    }
    
    $this->info('Contraseñas convertidas a Bcrypt exitosamente!');
}
}
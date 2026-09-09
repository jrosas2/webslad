<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

#[Signature('app:create-admin {--name=} {--email=}')]
#[Description('Crea o promueve de forma segura al administrador de SLAD')]
class CreateAdminCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = (string) ($this->option('name') ?: $this->ask('Nombre'));
        $email = strtolower((string) ($this->option('email') ?: $this->ask('Correo electrónico')));
        $password = (string) $this->secret('Contraseña');
        $passwordConfirmation = (string) $this->secret('Confirme la contraseña');

        $validator = Validator::make(compact('name', 'email', 'password', 'passwordConfirmation'), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', Password::defaults()],
            'passwordConfirmation' => ['same:password'],
        ], [
            'passwordConfirmation.same' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::query()->updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make($password), 'is_admin' => true, 'email_verified_at' => now()],
        );

        $this->info("Administrador {$user->email} creado correctamente.");

        return self::SUCCESS;
    }
}

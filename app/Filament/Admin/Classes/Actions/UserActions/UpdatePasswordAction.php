<?php

namespace App\Filament\Admin\Classes\Actions\UserActions;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;

class UpdatePasswordAction
{
    public static function make(User|Model $user): Action
    {
        return Action::make('updatePassword')
            ->color(Color::Sky)
            ->form([
                TextInput::make('password')->required()->password()->confirmed(),
                TextInput::make('password_confirmation')->required()->password(),
            ])
            ->action(function (array $data) use ($user) {
                $user->update([
                    'password' => $data['password'], // is hashed in casts
                ]);

                Notification::make()
                    ->title(__('Message Updated Successfully.'))
                    ->success()
                    ->send();
            });
    }
}

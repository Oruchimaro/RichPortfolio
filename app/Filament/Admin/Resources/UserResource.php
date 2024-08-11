<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Classes\Traits\NavigationTranslation;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class UserResource extends Resource
{
    use NavigationTranslation;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user';

    protected static ?string $navigationGroup = 'users.navigation.group';

    protected static ?string $navigationLabel = 'users.navigation.models.users';

    protected static ?string $modelLabel = 'users.navigation.models.user';

    protected static ?string $pluralModelLabel = 'users.navigation.models.users';

    protected static ?int $sort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('users.index.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('users.index.form.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(__('users.index.form.email_verified_at'))
                    ->displayFormat('Y-m-d')
                    ->jalali(ignore: App::getLocale() !== 'fa')
                    ->native(false)
                    ->default(now()),
                FileUpload::make('avatar_url')
                    ->image()
                    ->directory('users/avatars')
                    ->label(__('users.index.form.avatar')),
                Forms\Components\TextInput::make('password')
                    ->label(__('users.index.form.password'))
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->hiddenOn(['edit', 'view']),
            ]);
    }

    public static function getListTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->label(__('users.index.table.id'))
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\ImageColumn::make('avatar_url')
                ->label(__('users.index.table.avatar')),
            TextColumn::make('name')
                ->label(__('users.index.table.name'))
                ->sortable()
                ->searchable(),
            TextColumn::make('email')
                ->label(__('users.index.table.email'))
                ->searchable()
                ->copyable()
                ->copyMessage('Email address copied')
                ->copyMessageDuration(1500),
            TextColumn::make('email_verified_at')
                ->label(__('users.index.table.email_verified_at'))
                ->jalaliDateTime(ignore: App::getLocale() !== 'fa')
                ->toggleable(isToggledHiddenByDefault: true)
                ->color('success')
                ->sortable(),
            TextColumn::make('created_at')
                ->label(__('users.index.table.created_at'))
                ->jalaliDateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->label(__('users.index.table.updated_at'))
                ->jalaliDateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function getGridTableColumns(): array
    {
        // Make sure to stack your columns together
        return [
            Stack::make([
                ImageColumn::make('avatar_url')
                    ->label(__('users.index.table.avatar'))
                    ->size(100),

                // You may group columns together using the Split layout, so they are displayed side by side
                Split::make([
                    TextColumn::make('name')
                        ->label(__('users.index.table.name'))
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('email')
                        ->label(__('users.index.table.email'))
                        ->searchable()
                        ->copyable()
                        ->copyMessage('Email address copied')
                        ->copyMessageDuration(1500),
                ]),
                TextColumn::make('email_verified_at')
                    ->label(__('users.index.table.email_verified_at'))
                    ->jalaliDateTime(ignore: App::getLocale() !== 'fa')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('success')
                    ->sortable(),
            ])->space(2)
                ->extraAttributes([
                    'class' => 'pb-2',
                ]),
        ];
    }

    public static function table(Table $table): Table
    {
        $livewire = $table->getLivewire();

        return $table
            ->columns(
                $livewire->isGridLayout()
                ? static::getGridTableColumns()
                : static::getListTableColumns()
            )
            ->contentGrid(
                fn () => $livewire->isListLayout()
                   ? null
                   : [
                       'md' => 2,
                       'lg' => 3,
                       'xl' => 4,
                   ]
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

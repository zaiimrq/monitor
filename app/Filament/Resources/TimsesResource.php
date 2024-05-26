<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Filament\Resources\TimsesResource\Pages;
use App\Models\Timses;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimsesResource extends Resource
{
    protected static ?string $model = Timses::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Administrator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('user_id')
                            ->label('Timses')
                            ->options(
                                User::whereRole(Role::Timses)
                                    ->doesntHave('timses')
                                    ->pluck('name', 'id')
                            )
                            ->hiddenOn('edit')
                            ->searchable()
                            ->required(),
                        TextInput::make('budget')
                            ->prefix('Rp. ')
                            ->numeric(),
                        TextInput::make('target')
                            ->required()
                            ->numeric(),
                    ])
                    ->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Timses')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('target')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('budget')
                    ->money(currency: 'IDR', locale: 'id')
                    ->label('Anggaran')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimses::route('/'),
            'create' => Pages\CreateTimses::route('/create'),
            'edit' => Pages\EditTimses::route('/{record}/edit'),
        ];
    }
}

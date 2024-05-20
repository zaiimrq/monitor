<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Timses;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TimsesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TimsesResource\RelationManagers;
use App\Filament\Resources\TimsesResource\RelationManagers\UserRelationManager;
use Filament\Infolists\Infolist;

class TimsesResource extends Resource
{
    protected static ?string $model = Timses::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Timses')
                            ->options(
                                User::where('role', Role::Timses)->doesntHave('timses')->pluck('name', 'id')
                            )
                            ->hidden(fn (string $operation): bool => $operation == 'edit')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('budget')
                            ->numeric(),
                        Forms\Components\TextInput::make('target')
                            ->required()
                            ->numeric(),
                    ])->columns()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Timses')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('target')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->money(currency: 'IDR', locale: 'id')
                    ->label('Anggaran')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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

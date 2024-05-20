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
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TimsesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TimsesResource\RelationManagers;
use App\Filament\Resources\TimsesResource\RelationManagers\UserRelationManager;

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
                                User::where('role', Role::Timses)
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
                    ->columns()
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

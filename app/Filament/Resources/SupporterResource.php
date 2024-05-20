<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Enums\Gender;
use App\Enums\Religion;
use Filament\Forms\Form;
use App\Models\Supporter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SupporterResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SupporterResource\RelationManagers;

class SupporterResource extends Resource
{
    protected static ?string $model = Supporter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('timses_id')
                    ->options(
                        User::where('role', Role::Timses)
                            ->has('timses')
                            ->pluck('name', 'id')
                    )
                    ->required()
                    ->hidden(request()->user()->isTimses()),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->options(Gender::class)
                    ->required(),
                Forms\Components\Select::make('religion')
                    ->options(Religion::class)
                    ->required(),
                Forms\Components\TextInput::make('rt')
                    ->required(),
                Forms\Components\TextInput::make('village')
                    ->required(),
                Forms\Components\TextInput::make('district')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('timses.user.name')
                    ->hidden(request()->user()->isTimses())
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('religion')
                    ->searchable(),
            ])
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
            'index' => Pages\ListSupporters::route('/'),
            'create' => Pages\CreateSupporter::route('/create'),
            'view' => Pages\ViewSupporter::route('/{record}'),
            'edit' => Pages\EditSupporter::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return request()->user()->isAdmin()
                ? 
                parent::getEloquentQuery()
                :
                parent::getEloquentQuery()->where('timses_id', request()->user()->timses?->id);
    }

    
}

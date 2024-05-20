<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Models\User;
use App\Enums\Gender;
use App\Models\Timses;
use App\Enums\Religion;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Supporter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\SupporterResource\Pages;

class SupporterResource extends Resource
{
    protected static ?string $model = Supporter::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'pendukung';

    protected static ?string $pluralModelLabel = 'pendukung';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('timses_id')
                            ->label('Timses')
                            ->options(function (string $operation, Get $get) {
                                return $operation == 'edit' ?
                                    [
                                        $get('timses_id') => Timses::find($get('timses_id'))->user->name
                                    ] :
                                    User::where('role', Role::Timses)
                                        ->has('timses')
                                        ->pluck('name', 'id');
                            
                            })
                            ->native(false)
                            ->disabled(fn (string $operation) => $operation == 'edit')
                            ->searchable()
                            ->required()
                            ->hidden(request()->user()->isTimses()),
                    ])
                    ->columns()
                    ->hiddenOn('view'),

                Section::make()
                    ->schema([
                        TextInput::make('nik')
                            ->required()
                            ->numeric(),
                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options(Gender::class)
                            ->required(),
                        Select::make('religion')
                            ->label('Agama')
                            ->options(Religion::class)
                            ->required(),
                    ])->columns(),

                Section::make()
                    ->schema([
                        TextInput::make('rt')
                            ->label('RT')
                            ->required(),
                        TextInput::make('village')
                            ->label('Desa')
                            ->required(),
                        TextInput::make('district')
                            ->label('Distrik')
                            ->required(),
                    ])->columns(),
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto KTP')
                            ->image()
                            ->directory('supporter-images')
                            ->imageEditor()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('timses.user.name')
                    ->hidden(request()->user()->isTimses())
                    ->sortable(),
                TextColumn::make('nik')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                TextColumn::make('religion')
                    ->label('Agama')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Foto KTP'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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

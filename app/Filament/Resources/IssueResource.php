<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static ?string $modelLabel = 'kendala';

    protected static ?string $pluralModelLabel = 'kendala';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\RichEditor::make('content')
                        ->disableToolbarButtons(['attachFiles'])
                        ->required()
                        ->columnSpanFull(),
                ]),
                Section::make()->schema([
                    FileUpload::make('images')
                        ->image()
                        ->multiple()
                        ->directory('issue-images')
                        ->imageEditor(),
                ])->hiddenOn('view'),

                Section::make('Images')->schema([
                    ViewField::make('images')
                        ->view('filament.forms.components.report-images'),
                ])->visibleOn('view'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('timses.user.name')
                    ->hidden(request()->user()->isTimses())
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
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

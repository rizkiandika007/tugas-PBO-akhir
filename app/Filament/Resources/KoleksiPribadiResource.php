<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KoleksiPribadiResource\Pages;
use App\Models\KoleksiPribadi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class KoleksiPribadiResource extends Resource
{
    protected static ?string $model = KoleksiPribadi::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationLabel = 'Koleksi Pribadi';
    protected static ?string $pluralModelLabel = 'Koleksi Pribadi';
    protected static ?string $modelLabel = 'Koleksi Pribadi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('penulis')
                    ->label('Penulis')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun_terbit')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->minValue(1000)
                    ->maxValue(date('Y')),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Cover')
                    ->circular()
                    ->height(50),
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('penulis')
                    ->label('Penulis')
                    ->sortable(),
                TextColumn::make('tahun_terbit')
                    ->label('Tahun Terbit')
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Dihapus Pada')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                Filter::make('deleted')
                    ->label('Data Terhapus')
                    ->query(fn (Builder $query) => $query->onlyTrashed()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        $record->delete(); // Soft delete action
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function ($records) {
                            KoleksiPribadi::whereIn('id', $records)->delete(); // Soft delete bulk action
                        }),
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
            'index' => Pages\ListKoleksiPribadis::route('/'),
            'create' => Pages\CreateKoleksiPribadi::route('/create'),
            'edit' => Pages\EditKoleksiPribadi::route('/{record}/edit'),
        ];
    }
}

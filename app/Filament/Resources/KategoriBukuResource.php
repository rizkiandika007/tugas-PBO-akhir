<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriBukuResource\Pages;
use App\Models\KategoriBuku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

class KategoriBukuResource extends Resource
{
    protected static ?string $model = KategoriBuku::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Kategori Buku';
    protected static ?string $pluralModelLabel = 'Kategori Buku';
    protected static ?string $modelLabel = 'Kategori Buku';
    protected static ?string $navigationGroup = 'Perpustakaan'; // Bisa tambahkan grup menu

    /**
     * Form schema untuk membuat/edit data
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),

                // Forms\Components\Textarea::make('deskripsi')
                //     ->label('Deskripsi')
                //     ->maxLength(65535)
                //     ->rows(3)
                //     ->nullable(), // Deskripsi bisa kosong

                // Menambahkan field untuk slug atau gambar jika dibutuhkan
                // Forms\Components\TextInput::make('slug')
                //     ->label('Slug')
                //     ->nullable()
                //     ->maxLength(255),
            ]);
    }

    /**
         * Table schema untuk menampilkan data
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('nama_kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Kolom untuk soft delete (jika ada)
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter berdasarkan tanggal dibuat
                Filter::make('created_today')
                    ->label('Dibuat Hari Ini')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', today())),

                // Filter berdasarkan kategori aktif (misalnya tidak dihapus)
                Filter::make('active')
                    ->label('Aktif')
                    ->query(fn (Builder $query) => $query->whereNull('deleted_at')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('nama_nategori'), // Menampilkan aksi View jika diperlukan
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Menambahkan relasi jika ada
     */
    public static function getRelations(): array
    {
        return [
            // Tambahkan RelationManagers jika ada relasi, misalnya dengan Buku
        ];
    }

    /**
     * Menambahkan route halaman untuk membuat/edit
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriBukus::route('/'),
            'create' => Pages\CreateKategoriBuku::route('/create'),
            'edit' => Pages\EditKategoriBuku::route('/{record}/edit'),
        ];
    }
}

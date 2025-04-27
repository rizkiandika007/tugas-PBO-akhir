<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar'; // Ganti icon sesuai kebutuhan
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';
    protected static ?string $modelLabel = 'Peminjaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Peminjam')
                    ->relationship('user', 'name') // Mengambil nama peminjam dari relasi user
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('buku_id')
                    ->label('Buku')
                    ->relationship('buku', 'judul') // Mengambil judul buku dari relasi buku
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_peminjaman')
                    ->label('Tanggal Peminjaman')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->required(),
                Forms\Components\Select::make('status_peminjaman')
                    ->label('Status Peminjaman')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                    ])
                    ->default('dipinjam')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // Menampilkan nama peminjam dari relasi user
                    ->label('Peminjam')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buku.judul') // Menampilkan judul buku dari relasi buku
                    ->label('Buku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_peminjaman')
                    ->label('Tanggal Peminjaman')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status_peminjaman')
                    ->label('Status Peminjaman')
                    ->colors([
                        'secondary' => 'dipinjam',
                        'success' => 'dikembalikan',
                        'danger' => 'terlambat',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan filter sesuai kebutuhan
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
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}

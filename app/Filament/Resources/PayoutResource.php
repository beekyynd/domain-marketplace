<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayoutResource\Pages;
use App\Filament\Resources\PayoutResource\RelationManagers;
use App\Models\Payout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class PayoutResource extends Resource
{
    protected static ?string $model = Payout::class;

    protected static ?string $navigationIcon = 'heroicon-m-circle-stack';

    public static function table(Table $table): Table
    {
        return $table
        ->query(Payout::query()->with('owner'))
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->searchable()
                    ->label('Reference')
                    ->prefix('#')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->prefix('₦')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('owner.name')->label('User'), // User's name
            Tables\Columns\TextColumn::make('owner.bank_acc')
                ->label('Account #'),
            Tables\Columns\TextColumn::make('owner.bank_name')
                ->label('Bank'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' => 'paid', // Green for approved
                        'warning' => 'pending',  // Yellow for pending
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('primary')
                    ->action(function (Payout $record) {
                        $record->update(['status' => 'paid']);
                    })
                    ->visible(fn (Payout $record) => $record->status === 'pending') // Show only if status is pending
                    ->requiresConfirmation() // Optional: Add a confirmation dialog
                    ->modalHeading('Approve Payout'),
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
            'index' => Pages\ListPayouts::route('/'),
        ];
    }
}

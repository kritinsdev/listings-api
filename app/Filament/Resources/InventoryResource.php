<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Table;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $pluralModelLabel = 'Inventory';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('model')
                ->options(
                    \App\Models\ListingModel::all()
                        ->pluck('model_name', 'model_name')
                        ->toArray()
                ),
            TextInput::make('bought_for')->prefix('€')
                ->reactive()
                ->afterStateUpdated(function ($state, $get, $set) {
                    $targetPrice = $get('target_price');
                    if ($targetPrice !== null) {
                        $potentialProfit = $targetPrice - $state;
                        $set('potential_profit', $potentialProfit);
                    }
                }),
            DatePicker::make('date_bought'),
            TextInput::make('target_price')->prefix('€')
                ->reactive()
                ->afterStateUpdated(function ($state, $get, $set) {
                    $boughtFor = $get('bought_for');
                    if ($boughtFor !== null) {
                        $potentialProfit = $state - $boughtFor;
                        $set('potential_profit', $potentialProfit);
                    }
                }),
            TextInput::make('potential_profit')->prefix('€'),
            TextInput::make('sold_for')->prefix('€'),
            DatePicker::make('date_sold'),
            TextInput::make('profit'),
            TextInput::make('imei'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model'),

                TextColumn::make('bought_for')->money('eur'),

                TextColumn::make('bought_for')
                ->summarize(Sum::make()->label('Total Spent')->money('eur')),

                TextColumn::make('date_bought')
                    ->date(),

                TextColumn::make('target_price')
                ->money('eur'),

                TextColumn::make('potential_profit')
                ->money('eur'),

                // TextColumn::make('potential_profit')
                // ->summarize(Sum::make()
                //     ->label('Potential Profit')
                //     ->money('eur')
                //     ->query(function ($query) {
                //         return $query->whereNull('date_sold');
                //     })
                // ),

                TextColumn::make('sold_for')
                ->money('eur'),

                TextColumn::make('date_sold')
                    ->date(),

                TextColumn::make('profit')->money('eur'),

                // TextColumn::make('imei'),

                TextColumn::make('sold_for')
                ->summarize(Sum::make()->label('Total Sold')->money('eur')),

                TextColumn::make('profit')
                ->summarize(Sum::make()->label('Total Profit')->money('eur')),
            ])
            ->defaultSort('date_bought', 'desc')
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
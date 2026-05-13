<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentSettingResource\Pages;
use App\Models\PaymentSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// Correct Form Components Imports
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid; // <--- Sahi wala Grid yahan hai

class PaymentSettingResource extends Resource
{
    protected static ?string $model = PaymentSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card'; // Icon change kiya hai (Optional)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Payment Method Details')
                    ->description('Yahan se aap JazzCash ya EasyPaisa ki details update kar sakte hain.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('method_name')
                                    ->label('Payment Method Name')
                                    ->placeholder('e.g. JazzCash / EasyPaisa / Bank')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('account_number')
                                    ->label('Account Number')
                                    ->placeholder('0302XXXXXXX')
                                    ->required()
                                    ->tel(),

                                TextInput::make('account_holder')
                                    ->label('Account Holder Name')
                                    ->placeholder('e.g. AR SOFT')
                                    ->required()
                                    ->maxLength(255),

                                Toggle::make('is_active')
                                    ->label('Status (Active/Inactive)')
                                    ->default(true)
                                    ->helperText('If this off Not shown to user.')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('method_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_holder'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentSettings::route('/'),
            'create' => Pages\CreatePaymentSetting::route('/create'),
            'edit' => Pages\EditPaymentSetting::route('/{record}/edit'),
        ];
    }
}

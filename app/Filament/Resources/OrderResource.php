<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Set;
use App\Models\Product;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customer Information')
                    ->description('Details of the customer placing the order')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name') // User ka naam nazar aayega ID ki jagah
                            ->searchable()
                            ->preload(),

                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('customer_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),
                        // Form function ke andar:
Repeater::make('items')
    ->relationship()
    ->schema([
        Select::make('product_id')
            ->relationship('product', 'name')
            ->required()
            ->searchable()
            ->preload()
            ->live() // Ye zaroori hai taake change foran detect ho
            ->afterStateUpdated(function ($state, Set $set) {
                // Product ki qeemat database se nikalna
                $product = Product::find($state);
                $price = $product ? $product->price : 0;

                // Unit Price field mein value daalna
                $set('unit_price', $price);
            }),

        TextInput::make('quantity')
            ->numeric()
            ->default(1)
            ->required()
            ->live(), // Taake agar aap calculation karein toh ye madad de

        TextInput::make('unit_price')
            ->numeric()
            ->prefix('Rs.')
            ->required() // Disabled hone ke bawajood required hona chahiye backend ke liye
            ->disabled()
            ->dehydrated(),
    ])
    ->columns(3)
    ->columnSpanFull()
    ->addActionLabel('Add New Item'),
                Section::make('Order Details')
                    ->schema([
                        TextInput::make('order_number')
                            ->default('ORD-' . strtoupper(uniqid()))
                            ->required()
                            ->readOnly(), // Auto-generate order number

                        TextInput::make('total_price')
                            ->required()
                            ->numeric()
                            ->prefix('PKR'),

                     // Form function ke andar ye hona chahiye:
                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'baking' => 'Baking',
                                        'dispatched' => 'Dispatched',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required()
                                    ->default('pending'),
                    ])->columns(3),

                Section::make('Delivery Schedule')
                    ->schema([
                        DatePicker::make('delivery_date')
                            ->native(false) // Acha calendar view dikhayega
                            ->displayFormat('d/m/Y'),

                        TextInput::make('delivery_time_slot')
                            ->placeholder('e.g. 6pm - 9pm')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Location Details')
                    ->schema([
                        TextInput::make('city')
                            ->default('Lahore'),

                        TextInput::make('nearby_landmark')
                            ->placeholder('Famous shop or park')
                            ->default(null),

                        Textarea::make('delivery_address')
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->placeholder('Any special instructions for the bakery?')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),

                 TextColumn::make('id') // Hum 'id' use kar rahe hain taake Filament array bypass kare, lekin label 'Products' hi dikhega
                    ->label('Products & Qty')
                    ->badge()
                    ->color('success')
                    ->state(function ($record) {
                        // 'state' function use karne se Filament direct array ko accept kar leta hai badges banane ke liye
                        return $record->products->map(function ($product) {
                            $qty = $product->pivot->quantity ?? 1;
                            return "{$product->name} (x{$qty})";
                        })->toArray();
                    }),
                TextColumn::make('customer_name')
                    ->searchable(),

                TextColumn::make('total_price')
                    ->money('PKR')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge() // Isse status colorful badge ban jayega
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'baking' => 'warning',
                        'dispatched' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                            }),

                TextColumn::make('delivery_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('city')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    public static function form(Form $form): Form
    {
       return $form
    ->schema([
        // Section: Basic Info
            Group::make([
                Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

                 TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(Product::class, 'slug', ignoreRecord: true)
                ->disabled(),
        ])->columns(3)
        ->columnSpanFull(),

        // Section: Variations (Weight and Price)
        // Purana TagsInput aur Price field yahan merge ho gaye hain
        Repeater::make('variations')
            ->label('Product Variations (Weight & Price)')
            ->schema([

    TextInput::make('weight')
    ->label('Weight/Size')
    ->placeholder('Type e.g. 1.5 Pound, 1kg')
    ->datalist([
        '1 Pound',
        '2 Pound',
        '0.5 Kg',
        '1 Kg',
        'Small',
        'Large',
    ])
    ->required()
    ->columnSpan(1),

                    TextInput::make('price')
                    ->numeric()
                    ->prefix('Rs.')
                    ->required()
                    ->placeholder('Price for this variation')
                    ->columnSpan(1),
            ])
            ->columns(2) // Aik line mein Weight aur Price layega
            ->defaultItems(1)
            ->createItemButtonLabel('Add New Variation')
            ->columnSpanFull(),

                Textarea::make('description')
            ->rows(5)
            ->columnSpanFull(),

            FileUpload::make('image')
            ->image()
            ->directory('products')
            ->columnSpanFull(),

        // Section: Toggles
                Group::make([
                Toggle::make('is_active')
                ->required()
                ->default(true),

                Toggle::make('on_sale')
                ->required()
                ->default(false),

                Toggle::make('is_featured')
                ->required(),
        ])->columns(3),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->sortable()
                    ->label('Category'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('price')
                    ->money('PKR')
                    ->sortable(),

                ImageColumn::make('image'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                    IconColumn::make('on_sale')
                    ->boolean()
                    ->label('On Sale'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('is_active')
                ->label('Show Active Only')
                ->boolean()
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

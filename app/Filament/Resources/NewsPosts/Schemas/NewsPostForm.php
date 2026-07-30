<?php

namespace App\Filament\Resources\NewsPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                FileUpload::make('cover_image')
                    ->image(),
                TextInput::make('category')
                    ->required(),

                // Rich text editor replaces plain Textarea for body
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'orderedList',
                        'bulletList',
                        'h2',
                        'h3',
                        'blockquote',
                        'undo',
                        'redo',
                    ]),

                Textarea::make('excerpt')
                    ->required()
                    ->columnSpanFull(),

                // Tags / Keywords
                TagsInput::make('tags')
                    ->label('Tags / Keywords')
                    ->placeholder('Add a tag and press Enter')
                    ->hint('Used for filtering and SEO. Press Enter after each tag.')
                    ->columnSpanFull(),

                TextInput::make('read_time_minutes')
                    ->required()
                    ->numeric()
                    ->default(3),
                DateTimePicker::make('published_at'),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('meta_title')
                    ->label('SEO Title')
                    ->maxLength(255)
                    ->hint('Leave blank to use the article title.'),
                Textarea::make('meta_description')
                    ->label('SEO Description')
                    ->rows(3)
                    ->hint('Leave blank to use the article excerpt.'),
            ]);
    }
}

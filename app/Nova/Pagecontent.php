<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pagecontent extends Resource
{
    public static $model = \App\Models\Pagecontent::class;

    public static $title = 'content';

    public static $search = [
        'id', 'content',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Content')->sortable()->rules('required'),
            Image::make('Media')->disk('public')->path('pagecontent-media')->prunable(),
            BelongsTo::make('Pagesection')
        ];
    }
}

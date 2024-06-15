<?php

namespace App\Nova;

// use App\Nova\Actions\DeleteLatestVideos;
// use App\Nova\Actions\EditLatestVideos;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;


class LatestVideos extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\LatestVideos>
     */
    public static $model = \App\Models\LatestVideos::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Latest videos';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'likes',
        'link',
        'views',
        'description',
        'is_featured',
        'file_path'
    ];

    public static function search($query)
    {
        return static::where('likes', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Link', 'link')->sortable(),
            Text::make('Likes', 'likes')->sortable(),
            Text::make('Views', 'views')->sortable(),
            TextArea::make('Description', 'description')->sortable(),
            File::make('Video File', 'file_path')
                ->disk('public') 
                ->path('videos'),
            Boolean::make('Is Featured', 'is_featured'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
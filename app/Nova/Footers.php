<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Footers extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Footers>
     */
    public static $model = \App\Models\Footers::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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
            Select::make('Type')->options([
                'quickLinks' => 'QuickLinks',
                'socials' => 'Socials',
                'columns' => 'Columns',
                'currencies' => 'Currency',
            ])->sortable()->rules('required')->displayUsingLabels(),
            Text::make('name')->sortable()->rules('required', 'max:255'),
            Text::make('code')->sortable()->nullable()->rules('required', 'max:255'),
            Text::make('column1')->sortable()->rules('required', 'max:255'),
            Text::make('column2')->sortable()->rules('required', 'max:255'),
            Text::make('navItem1')->sortable()->rules('required', 'max:255'),
            Text::make('navItem2')->sortable()->rules('required', 'max:255'),
            Markdown::make('Description')->sortable()->rules('required', 'max:255'),
            File::make('image_path')->sortable()->nullable(),
            Number::make('Order')->sortable()->rules('required', 'integer'),
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

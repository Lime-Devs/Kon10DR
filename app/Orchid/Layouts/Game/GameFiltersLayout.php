<?php

namespace App\Orchid\Layouts\Game;

use App\Orchid\Filters\GameFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class GameFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
			GameFilter::class,
        ];
    }
}

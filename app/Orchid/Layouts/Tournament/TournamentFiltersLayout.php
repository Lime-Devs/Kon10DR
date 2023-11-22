<?php

namespace App\Orchid\Layouts\Tournament;

use App\Orchid\Filters\TournamentFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class TournamentFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
			TournamentFilter::class,
        ];
    }
}

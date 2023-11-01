<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Game;
use Orchid\Screen\Actions\Link;

class GameListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'games';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
		return [
			TD::make('name', 'Name')
			  ->render(function (Game $game) {
				  return Link::make($game->name)
							 ->route('platform.systems.games.edit', $game);
			  }),

			TD::make('image', 'Image'),

			TD::make('created_at', 'Created'),
			TD::make('updated_at', 'Last edit'),
		];
    }
}

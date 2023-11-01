<?php

namespace App\Orchid\Screens\Game;

use App\Models\Game;
use App\Orchid\Layouts\GameListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class GameListScreen extends Screen
{
	/**
	 * Query data.
	 *
	 * @return array
	 */
	public function query(): array
	{
		return [
			'games' => Game::filters()->defaultSort('id', 'desc')->paginate(),
		];
	}

	/**
	 * The name is displayed on the user's screen and in the headers
	 */
	public function name(): ?string
	{
		return 'Games';
	}

	/**
	 * The description is displayed on the user's screen under the heading
	 */
	public function description(): ?string
	{
		return "All Games";
	}

	/**
	 * Button commands.
	 *
	 * @return Link[]
	 */
	public function commandBar(): array
	{
		return [
			Link::make(__('Add'))
				->icon('bs.plus-circle')
				->href(route('platform.systems.games.create')),
		];
	}

	/**
	 * Views.
	 *
	 * @return Layout[]
	 */
	public function layout(): array
	{
		return [
			GameListLayout::class
		];
	}

	public function permission(): ?iterable
	{
		return [
			'platform.systems.games',
		];
	}
}

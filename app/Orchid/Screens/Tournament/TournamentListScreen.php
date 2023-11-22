<?php

namespace App\Orchid\Screens\Tournament;

use App\Models\Tournament;
use App\Orchid\Layouts\Tournament\TournamentFiltersLayout;
use App\Orchid\Layouts\Tournament\TournamentListLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TournamentListScreen extends Screen
{
	/**
	 * Query data.
	 *
	 * @return array
	 */
	public function query(): array
	{

		return [
			'games' => Tournament::filters(TournamentFiltersLayout::class)
						   ->defaultSort('id', 'desc')
						   ->paginate(),
		];
	}

	/**
	 * The name is displayed on the user's screen and in the headers
	 */
	public function name(): ?string
	{
		return 'Tournaments';
	}

	/**
	 * The description is displayed on the user's screen under the heading
	 */
	public function description(): ?string
	{
		return "All Tournaments";
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
				->href(route('platform.systems.tournament.create')),
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
			TournamentListLayout::class
		];
	}

	public function permission(): ?iterable
	{
		return [
			'platform.systems.tournaments',
		];
	}

	public function remove(Request $request): void
	{
		Tournament::findOrFail($request->get('id'))->delete();

		Toast::info(__('Tournament was removed'));
	}
}

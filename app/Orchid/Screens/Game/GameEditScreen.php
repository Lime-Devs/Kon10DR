<?php

namespace App\Orchid\Screens\Game;

use App\Models\Game;
use App\Orchid\Screens\Link;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class GameEditScreen extends Screen
{
	/**
	 * @var Game
	 */
	public $game;

	/**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
	public function query(Game $game): array
	{
		return [
			'game' => $game
		];
	}

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
	public function name(): ?string
	{
		return $this->game->exists ? 'Edit game' : 'Creating a new game';
	}

	public function description(): ?string
	{
		return "Games";
	}

	/**
	 * Button commands.
	 *
	 * @return Link[]
	 */
	public function commandBar(): array
	{

		return [
			Button::make(__('Save'))
				  ->icon('bs.check-circle')
				  ->method('save'),

			Button::make(__('Remove'))
				  ->icon('bs.trash3')
				  ->method('remove')
				  ->canSee($this->game->exists),
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
			Layout::rows([
							 Input::make('game.name')
								  ->title('Name')
								  ->placeholder('Game Name')
								  ->help('Game Name.'),

							 TextArea::make('game.description')
									 ->title('Description')
									 ->rows(3)
									 ->maxlength(200)
									 ->placeholder('Brief description for preview'),

							 CheckBox::make('active')
								 ->value($this->game->active == 1 ? 'on' : 'off')
									 ->placeholder('Active'),

							 CheckBox::make('featured')
								 	->value($this->game->featured == 1 ? 'on' : 'off')
									 ->placeholder('Featured'),

							 Picture::make('image')
									->title('Picture')
									->horizontal(),

							 Quill::make('game.body')
								  ->title('Main text'),

						 ])
		];
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function createOrUpdate(Request $request)
	{

		$active = $request->get('active') == 'on';
		$featured = $request->get('featured') == 'on';
		$this->game->fill($request->get('game'))
					->fill(['active' => $active, 'featured' => $featured])
				   ->save();

		Alert::info('You have successfully created a game.');

		return redirect()->route('platform.systems.games');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function remove()
	{
		$this->game->delete();

		Alert::info('You have successfully deleted the game.');

		return redirect()->route('platform.systems.games');
	}

	public function save(Game $game, Request $request)
	{

		$request->validate([
							   'game.name' => ['required'],
							   'game.description' => ['required'],
							   'game.body' => ['required'],
						   ]);
		$game->fill($request->get('game'));
		$active = $request->get('active') == 'on';
		$featured = $request->get('featured') == 'on';
		$game->fill(['active' => $active, 'featured' => $featured]);
		$game->save();
		dd($_POST, $request->all());

		Toast::info(__('Game was saved.'));

		return redirect()->route('platform.systems.games');
	}

}

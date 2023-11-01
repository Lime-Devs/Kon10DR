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
									 ->title('Checkbox')
									 ->placeholder('Active'),

							 CheckBox::make('featured')
									 ->title('Checkbox')
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
		$this->game->fill($request->get('game'))->save();

		Alert::info('You have successfully created a game.');

		return redirect()->route('platform.game.list');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function remove()
	{
		$this->game->delete();

		Alert::info('You have successfully deleted the game.');

		return redirect()->route('platform.game.list');
	}

	public function save(Game $game, Request $request)
	{
		$request->validate([
							   'game.name' => ['required'],
							   'game.description' => ['required'],
							   'game.body' => ['required'],
						   ]);
		$game->fill($request->get('game'));


		Toast::info(__('Game was saved.'));

		return redirect()->route('platform.systems.games');
	}

}

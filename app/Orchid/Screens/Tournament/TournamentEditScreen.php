<?php

namespace App\Orchid\Screens\Tournament;

use App\Models\Tournament;
use App\Orchid\Screens\Link;
use Illuminate\Http\Request;
use Orchid\Attachment\File;
use Orchid\Screen\Fields\Cropper;
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

class TournamentEditScreen extends Screen
{

	/**
	 * @var Tournament
	 */
	public $tournament;

	/**
	 * Fetch data to be displayed on the screen.
	 *
	 * @return array
	 */
	public function query(Tournament $tournament)
	: array {

		$tournament->load('attachment');

		return [
			'tournament' => $tournament
		];
	}

	/**
	 * The name of the screen displayed in the header.
	 *
	 * @return string|null
	 */
	public function name()
	: ?string
	{

		return $this->tournament->exists ? 'Edit tournament' : 'Creating a new tournament';
	}

	public function description()
	: ?string
	{

		return "Tournament";
	}

	/**
	 * Button commands.
	 *
	 * @return Link[]
	 */
	public function commandBar()
	: array
	{

		return [
			Button::make(__('Save'))
				  ->icon('bs.check-circle')
				  ->method('save'),

			Button::make(__('Remove'))
				  ->icon('bs.trash3')
				  ->method('remove')
				  ->canSee($this->tournament->exists),
		];
	}

	/**
	 * Views.
	 *
	 * @return Layout[]
	 */
	public function layout()
	: array
	{

		$active = $this->tournament->active == 1 ? 1 : 0;
		$featured = $this->tournament->featured ? 1 : 0;

		return [
			Layout::rows([
							 Input::make('tournament.name')
								  ->title('Name')
								  ->placeholder('Tournament Name')
								  ->help('Tournament Name.'),

							 TextArea::make('tournament.description')
									 ->title('Description')
									 ->rows(3)
									 ->maxlength(200)
									 ->placeholder('Brief description for preview'),

							 CheckBox::make('active')
									 ->sendTrueOrFalse()
									 ->value($active)
									 ->checked($active == 1)
									 ->placeholder('Active'),

							 CheckBox::make('featured')
									 ->sendTrueOrFalse()
									 ->value($featured)
									 ->checked($featured == 1)
									 ->placeholder('Featured'),

							 Cropper::make('image')
									->targetRelativeUrl(),

							 // Picture::make('image')
							 // 	->title('Picture')
							 // 	->path('games')
							 // 	->help('Upload a picture')
							 // 	->width(300)
							 // 	->horizontal(),

							 // Quill::make('tournament.detail')
								//   ->title('Main text'),

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
		$this->tournament->fill($request->get('tournament'))
				   ->fill(['active' => $active, 'featured' => $featured])
				   ->save();

		Alert::info('You have successfully created a tournament.');

		return redirect()->route('platform.systems.tournaments');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function remove()
	{

		$this->tournament->delete();

		Alert::info('You have successfully deleted the tournament.');

		return redirect()->route('platform.systems.tournaments');
	}

	public function save(Tournament $tournament, Request $request)
	{

		$request->validate([
							   'tournament.name' => ['required'],
							   'tournament.description' => ['required'],
						   ]);
		$active = $request->get('active') == 1 ? 1 : 0;
		$featured = $request->get('featured') == 1 ? 1 : 0;
		$image = $request->get('image');

		$tournament->fill($request->get('tournament'))
			 ->fill(['image' => $image, 'active' => $active, 'featured' => $featured])
			 ->save();

		$tournament->attachment()->syncWithoutDetaching(
			$request->input('tournament.attachment', [])
		);

		Toast::info(__('Tournament was saved.'));

		return redirect()->route('platform.systems.tournaments');
	}

}

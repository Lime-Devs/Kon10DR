<?php

declare(strict_types = 1);

namespace App\Orchid\Layouts\Tournament;

use App\Models\Tournament;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TournamentListLayout extends Table
{

	/**
	 * @var string
	 */
	public $target = 'tournaments';

	/**
	 * @return TD[]
	 */
	public function columns()
	: array
	{

		return [

			TD::make('name', __('Name'))
			  ->sort()
			  ->cantHide()
			  ->filter(Input::make())
			  ->render(fn(Tournament $tournament) => Link::make($tournament->name)
											 ->route('platform.systems.tournaments.edit', $tournament->id)),


			TD::make('description', __('Description'))
			  ->sort()
			  ->cantHide()
			  ->filter(Input::make())
			  ->render(fn(Tournament $tournament) => Link::make(substr($tournament->description, 0, 35))
											 ->route('platform.systems.tournaments.edit', $tournament->id)),

			TD::make('image', __('Image'))
			  ->sort()
			  ->cantHide()
			  ->render(fn(Tournament $tournament) => $tournament->image != null ? "<img src='" . $tournament->image . "' width='100px' />" : ''),

			TD::make('active', __('Active'))
			  ->sort()
			  ->cantHide()
			  ->render(fn(Tournament $tournament) => $tournament->active ? 'Yes' : 'No')
			  ->filter(Input::make()),

			TD::make('featured', __('Featured'))
			  ->sort()
			  ->cantHide()
			  ->render(fn(Tournament $tournament) => $tournament->featured ? 'Yes' : 'No')
			  ->filter(Input::make()),

			TD::make('created_at', __('Created'))
			  ->usingComponent(DateTimeSplit::class)
			  ->align(TD::ALIGN_RIGHT)
			  ->defaultHidden()
			  ->sort(),

			TD::make('updated_at', __('Last edit'))
			  ->usingComponent(DateTimeSplit::class)
			  ->align(TD::ALIGN_RIGHT)
			  ->sort(),

			TD::make(__('Actions'))
			  ->align(TD::ALIGN_CENTER)
			  ->width('100px')
			  ->render(fn(Tournament $tournament) => DropDown::make()
												 ->icon('bs.three-dots-vertical')
												 ->list([

															Link::make(__('Edit'))
																->route('platform.systems.tournaments.edit', $game->id)
																->icon('bs.pencil'),

															Button::make(__('Delete'))
																  ->icon('bs.trash3')
																  ->confirm(__('Once the tournament is deleted, all of its resources and data will be permanently deleted.'))
																  ->method('remove', [
																	  'id' => $game->id,
																  ]),
														])),
		];
	}
}

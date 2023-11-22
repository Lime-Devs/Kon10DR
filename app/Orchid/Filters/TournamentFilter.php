<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class TournamentFilter extends Filter
{
	/**
	 * The displayable name of the filter.
	 *
	 * @return string
	 */
	public function name(): string
	{
		return __('Tournament');
	}

	/**
	 * The array of matched parameters.
	 *
	 * @return array
	 */
	public function parameters(): array
	{
		return ['tournament'];
	}

	/**
	 * Apply to a given Eloquent query builder.
	 *
	 * @param Builder $builder
	 *
	 * @return Builder
	 */
	public function run(Builder $builder): Builder
	{
		return $builder->where('name', $this->request->get('name'));
	}

	/**
	 * Get the display fields.
	 */
	public function display(): array
	{
		return [
			Select::make('tournament')
				  ->fromModel(Game::class, 'name', 'name')
				  ->empty()
				  ->value($this->request->get('tournament'))
				  ->title(__('Tournaments')),
		];
	}

	/**
	 * Value to be displayed
	 */
	public function value(): string
	{
		return $this->name().': '.Tournament::where('name', $this->request->get('tournament'))->first()->name;
	}
}

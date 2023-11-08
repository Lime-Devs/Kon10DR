<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class GameFilter extends Filter
{
	/**
	 * The displayable name of the filter.
	 *
	 * @return string
	 */
	public function name(): string
	{
		return __('Games');
	}

	/**
	 * The array of matched parameters.
	 *
	 * @return array
	 */
	public function parameters(): array
	{
		return ['game'];
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
			Select::make('game')
				  ->fromModel(Game::class, 'name', 'name')
				  ->empty()
				  ->value($this->request->get('game'))
				  ->title(__('Games')),
		];
	}

	/**
	 * Value to be displayed
	 */
	public function value(): string
	{
		return $this->name().': '.Game::where('name', $this->request->get('game'))->first()->name;
	}
}

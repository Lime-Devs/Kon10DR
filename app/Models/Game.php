<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Access\RoleAccess;
use Orchid\Access\RoleInterface;  // @todo needed?
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model implements RoleInterface
{
	use AsSource, Chartable, Filterable, HasFactory, RoleAccess, Attachable;
	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'body',
		'image',
		'featured',
		'active'
	];

	/**
	 * @var array
	 */
	protected $allowedFilters = [
		'id'          => Where::class,
		'name'        => Like::class,
	];

	/**
	 * @var array
	 */
	protected $allowedSorts = [
		'id',
		'name',
		'description',
		'body',
		'created_at',
	];

	public function image($game = null)
	{
		if (empty($game)) {
			return null;
		}
		$image = $game->attachment()->first();
		if (empty($image)) {
			return null;
		}
		return $image->url();
	}
}

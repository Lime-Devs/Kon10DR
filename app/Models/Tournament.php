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

class Tournament extends Model implements RoleInterface
{
	use AsSource, Chartable, Filterable, HasFactory, RoleAccess, Attachable;
	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'detail',
		'image',
		'featured',
		'active'
	];


	/**
	 * @var array
	 */
	protected $allowedFilters = [
		'id'          => Where::class,
		'detail'        => Like::class,
		'name'        => Like::class,
	];

	/**
	 * @var array
	 */
	protected $allowedSorts = [
		'id',
		'name',
		'created_at',
	];

	public function image($tournament = null)
	{
		if (empty($tournament)) {
			return null;
		}
		$image = $tournament->attachment()->first();
		if (empty($image)) {
			return null;
		}
		return $image->url();
	}

}
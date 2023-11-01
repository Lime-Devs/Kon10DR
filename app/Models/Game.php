<?php

namespace App\Models;
use Orchid\Access\RoleAccess;
use Orchid\Access\RoleInterface;  // @todo needed?
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model implements RoleInterface
{
	use AsSource, Chartable, Filterable, HasFactory, RoleAccess;
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
}

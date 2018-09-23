<?php

namespace LaraFilm\Interfaces\Persistence;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class Model
 *
 * @method static $this find($id, $columns = ['*'])
 * @method static $this where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static $this whereColumn($first, $operator = null, $second = null, $boolean = 'and')
 * @method static $this whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static $this whereNotIn($column, $values, $boolean = 'and')
 * @method static $this orderBy($column, $direction = 'asc')
 * @method static $this orderByDesc($column)
 * @method static Collection get($columns = ['*'])
 * @method static $this first($columns = ['*'])
 * @method static LengthAwarePaginator paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
 * @package LaraFilm\Interfaces\Persistence
 */
abstract class Model extends EloquentModel
{
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * Model constructor.
     *
     * @param array $attributes
     * @throws \Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['uuid'] = Uuid::uuid4()->toString();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Hamza Alayed
 * Date: 11/29/17
 * Time: 9:38 AM
 */

namespace App\Repositories;

use App\Contracts\BaseInterface as EloquentInterface;
use App\Entities\BaseEntity;
use Illuminate\Container\Container as App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements EloquentInterface
{
    protected $with = [];
    /**
     * @var App
     */
    protected $app;

    /** @var string */
    protected $order = null;

    protected $direction = 'desc';
    /**
     * @var BaseEntity $model
     */
    protected $model;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract protected function getModelClass(): string;


    protected function makeModel()
    {
        $this->model = $this->app->make($this->getModelClass());
    }

    /**
     * @param int $limit
     *
     * @param array $filters
     *
     * @param bool $simple
     * @return LengthAwarePaginator|Paginator
     */
    public function pagination($limit = 10, $filters = [], $simple = true)
    {
        /** @var Builder $latest */
        $latest = $this->model->with($this->with);
        if ($this->order != '') {
            $latest->orderBy($this->order, $this->direction);
        }

        unset($filters['page']);
        $latest->where($filters);
        if ($simple) {
            return $latest->simplePaginate($limit);
        }
        return $latest->paginate($limit);
    }

    /**
     *
     * @param array $filters
     *
     * @return Builder[]|Collection
     */
    public function get($filters = [])
    {
        /** @var Builder $latest */
        $latest = $this->model->where($filters);
        if ($this->order != '') {
            $latest->orderBy($this->order, $this->direction);
        }

        $latest->where($filters);
        return $latest->get();
    }


    /**
     * @param $entityId
     * @param array $attributes
     *
     * @return bool
     */
    public function update($entityId, $attributes = [])
    {
        $item = $this->model->where('id', $entityId);
        if ($item) {
            return $item->update($attributes);
        }

        return false;
    }

    /**
     * @param $entityId
     *
     * @return bool
     * @throws \Exception
     */
    public function delete($entityId)
    {
        $item = $this->model->where('id', $entityId);

        if ($item && $item->delete()) {
            return true;
        }

        return false;
    }

    /**
     * @param array $attributes
     *
     * @return bool
     */
    public function insert($attributes = [])
    {
        return $this->model->insert($attributes);
    }

    /**
     * @param array $attributes
     *
     * @return BaseEntity|Model
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }


    /**
     * @param array $attributes
     *
     * @return BaseEntity|Model
     */
    public function updateOrCreate($attributes = [])
    {
        return $this->model->updateOrCreate($attributes);
    }

    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }


    /**
     * @param string $name
     * @param string $entityId
     *
     * @param array $filters
     * @return array
     */
    public function pluck($name = 'name', $entityId = 'id', $filters = [])
    {
        return $this->model->where($filters)->pluck($name, $entityId)->toArray();
    }


    /**
     * @param $entityId
     * @param array $columns
     *
     * @return BaseEntity
     */
    public function find($entityId, $columns = ['*'])
    {
        return $this->model->with($this->with)->select($columns)->whereId($entityId)->first();
    }

    /**
     * @param array $filter
     * @param array $columns
     *
     * @return BaseEntity
     */
    public function first($filter = [], $columns = ['*'])
    {
        return $this->model->with($this->with)->select($columns)->where($filter)->first();
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     *
     * @return BaseEntity
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->with($this->with)->select($columns)->where($field, $value)->first();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function firstOrCreate($data = [])
    {
        return $this->model->firstOrCreate($data);
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;

class BaseRepository implements CrudInterface
{
    protected $obj;

    function __construct(Object $obj)
    {
        $this->obj = $obj;
    }

    public function all(): object
    {
        return $this->obj->all();
    }

    public function find(int $id): object
    {
        return $this->obj->find($id);
    }

    public function findByColumn(string $column, $value): object
    {
        return $this->obj->where($column, $value)->get();
    }

    public function save(array $attributes): bool
    {
        $this->obj->fill($attributes);

        return $this->obj->save();
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->obj->find($id)->update($attributes);
    }
}

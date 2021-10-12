<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Config;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function all($columns = '*');

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /* 
    * $limit = Config::app('constants.limit_page')
    */
    public function paginate($direction = 'desc', $limit = NULL);

    public function orderBy($column, $direction = 'asc');

    public function search($columns, $strict, $limit = NULL, $model = NULL);

    public function findOrFail($id);

    public function findByColumn($column, $value);

    public function select($columns = '*');
}
<?php

namespace App\Repositories\Dashboard;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    abstract public function queryBuilder(): Builder;

    protected function prepareQueryParams(array $params = []): Builder
    {
        $query = $this->queryBuilder();

        if ($params) {
            foreach ($params as $key => $value) {
                if (is_array($value)) {
                    $query->where($key, $value['operator'], $value['value']);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query;
    }
}
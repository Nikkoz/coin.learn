<?php

namespace App\Contracts\Filters;

interface DataFilterable
{
    /**
     * Получить конфиг фильтров для поддержания консистентности данных.
     * Возможно использование для мутации данных, удаления и т.п.
     */
    public function getDataFilterConfig(): array;
}
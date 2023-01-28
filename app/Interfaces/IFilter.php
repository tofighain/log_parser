<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface IFilter {
    public static function truncateResults(Builder $builder, $value, $col, $rel);
}
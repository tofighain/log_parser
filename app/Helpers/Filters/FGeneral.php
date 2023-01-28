<?php

namespace App\Helpers\Filters;

use App\Interfaces\IFilter;
use Illuminate\Database\Eloquent\Builder;

use function PHPUnit\Framework\isNull;

class FGeneral implements IFilter {
    public static function truncateResults(Builder $builder, $value, $col="", $rel="")
    {
        if(empty($rel)) {
            return $builder->whereIn($col, explode(",",$value));
        }else {
            return $builder->whereHas($rel, function ($q) use ($value, $col) {
                $q->whereIn($col, explode(",",$value));
            });
        }
    }
}
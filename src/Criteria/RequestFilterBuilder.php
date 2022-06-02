<?php

namespace CaueSantos\LaravelRequestFilters\Criteria;

use App\Core\Eloquent;
use ErrorException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use ReflectionException;

class RequestFilterBuilder extends Builder
{

    protected static ?Request $request;

    /**
     * @param class-string<ModelCriteriaContract> $modelCriteria
     * @return Builder
     * @throws Exception
     */
    public function applyCriteria(string $modelCriteria): Builder
    {
        return ApplyCriteria::applyCriteria($modelCriteria, $this);
    }

    /**
     * @param string|null $modelCriteria
     * @param array $paginationOptions
     * @return array
     * @throws BindingResolutionException
     */
    public function smartPagination(string $modelCriteria = null, array $paginationOptions = []): array
    {
        $modelCriteria = $modelCriteria ?? DefaultCriteria::class;
        return ApplyCriteria::smartPagination($modelCriteria, $this, $paginationOptions);
    }

    /**
     * @return Builder
     */
    public function sort(): Builder
    {
        return ApplyCriteria::sort($this);
    }

}

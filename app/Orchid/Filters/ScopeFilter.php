<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class ScopeFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['scope','scope_param'];

    /**
     * @return string
     */
    public function name(): string
    {
        return 'Выборка';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $scope = $this->request->get('scope');
        $scope_param = $this->request->get('scope_param');

        if (!is_array($scope_param)) {
            $scope_param = explode(',',$scope_param);
        }

        if ($builder->getModel()->hasNamedScope($scope)) {
            if (is_array($scope_param)) {
                return $builder->$scope(...$scope_param);
            } else {
                return $builder->$scope($scope_param);
            }
        }
        return $builder;
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        $res = collect([Input::make('scope')->value($this->request->get('scope'))]);
        $scope_param = $this->request->get('scope_param');

        if (!is_array($scope_param)) {
            $scope_param = explode(',',$scope_param);
        }

        $res = $res->concat(array_map(function ($el) {
            return Input::make('scope_param')->value($el);
        },$scope_param));
        return $res->all();
    }
}

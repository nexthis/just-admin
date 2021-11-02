<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Builder $model
     * @param  $beforeConfig
     * @return \Illuminate\Support\Collection
     */
    protected function advancePaginate(Builder $model, $beforeConfig = null): \Illuminate\Support\Collection
    {
        $paginate_info = request()->all();
        $data = $model;
        if (array_key_exists('sortBy', $paginate_info) && array_key_exists('sortDesc', $paginate_info) && is_array($paginate_info['sortBy']) && is_array($paginate_info['sortDesc'])) {
            foreach (array_combine($paginate_info['sortBy'], $paginate_info['sortDesc']) as $item => $desc) {
                $value = explode(".", $item);
                if (count($value) === 1) {
                    $data->orderBy($item, $desc === 'true' ? 'desc' : 'asc');
                } else {
                    $data->whereHas($value[0], function ($query) use ($value, $desc) {
                        return $query->orderBy($value[1], $desc === 'true' ? 'desc' : 'asc');
                    });
                }

            }
        }

        if (isset($paginate_info['text'], $paginate_info['operator'], $paginate_info['model'])) {
            $value = explode(".", $paginate_info['model']);
            if (count($value) === 1) {
                $data->where($paginate_info['model'], $paginate_info['operator'], urldecode($paginate_info['text']));
            } else {
                $data->whereHas($value[0], function ($query) use ($paginate_info, $value) {
                    return $query->where($value[1], $paginate_info['operator'], $paginate_info['text']);
                });
            }

        }

        if (array_key_exists('itemsPerPage', $paginate_info)) {
            $data = $data->paginate($paginate_info['itemsPerPage']);
        } else {
            $data = $data->paginate(config('admin.paginate.items_default'));
        }

        if (is_callable($beforeConfig)) {
            $beforeConfig($data);
        }

        $config = collect(['config' => config('admin.paginate', [
            'items_per_page_options' => [20,40,60,80,100],
            'items_max' => 100,
            'items_default' => 20,
        ])]);

        $data = $config->merge($data);
        return $data;
    }
}
<?php


namespace Jalen\MpAdmin\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Jalen\MpAdmin\Traits\ApiResponse;

abstract class BaseController extends Controller
{
    use  ApiResponse;

    public $app_id = null;
    public $allow_search_columns = [];
    public $allow_show_columns = [];
    public $builder = null;
    public $mp_info = null;
    public $model = null;

    public function getAppId()
    {
        return $this->app_id;
    }

    public function getAllowSearchColumns()
    {
        return $this->allow_search_columns;
    }

    public function getAllowShowColumns()
    {
        return $this->allow_show_columns;
    }

    public function getBuilder()
    {
        return $this->builder;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setAppId(string $app_id = null)
    {
        $this->app_id = $app_id;
    }

    public function setAllowSearchColumns(array $allow_search_columns = [])
    {
        $this->allow_search_columns = $allow_search_columns;
    }

    public function setAllowShowColumns(array $allow_show_columns = [])
    {
        $this->allow_show_columns = $allow_show_columns;
    }

    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function __construct()
    {

    }

    public function buildQuery(Builder $builder, array $filters, array $allow_search_columns = [], array $allow_show_columns = [], bool $withPage = false)
    {
        if ($withPage) {
            // 限制查询条数
            if (array_key_exists('_limit', $filters)) {
                $builder = $builder->limit($filters['_limit']);
            } else {
                $builder = $builder->limit(10);
            }
            // 跳过条数
            if (array_key_exists('_skip', $filters)) {
                $builder = $builder->skip($filters['_skip']);
            }
            // 排序
            if (array_key_exists('_orderBy', $filters) && array_key_exists('_orderByDesc', $filters)) {
                foreach ($filters['_orderBy'] as $key => $column) {
                    if (array_key_exists($key, $filters['_orderByDesc'])) {
                        $type = $filters['_orderByDesc'][$key] == 'true' ? 'DESC' : 'ASC';
                        $builder = $builder->orderBy($column, $type);
                    }
                }
            }
        }
        // 查询条件
        if (array_key_exists('filters', $filters)) {
            $wheres = $filters['filters'];
            foreach ($wheres as $k => $v) {
                if (is_array($v)) {
                    if (array_key_exists('value', $v) && array_key_exists('column', $v) && array_key_exists('sign', $v)) {
                        // 搜索列白名单
                        if (count($allow_search_columns) == 0 || array_key_exists($v['column'], $allow_search_columns)) {
                            switch ($v['sign']) {
                                case 'whereBetween':
                                    $builder = $builder->whereBetween($v['column'], $v['value']);
                                    break;
                                case 'whereIn':
                                    $builder = $builder->whereIn($v['column'], $v['value']);
                                    break;
                                case 'where':
                                    if (array_key_exists('compare', $v)) {
                                        if ($v['compare'] == 'like') {
                                            $builder = $builder->where($v['column'], $v['compare'], '%' . $v['value'] . '%');
                                        } else {
                                            $builder = $builder->where($v['column'], $v['compare'], $v['value']);
                                        }
                                    } else {
                                        $builder = $builder->where($v['column'], $v['value']);
                                    }
                                    break;
                                case 'relation':
                                    if (array_key_exists('relation_name', $v)) {
                                        if (array_key_exists('compare', $v)) {
                                            $relation_array = explode('.', $v['relation_name']);
                                            if (count($relation_array) == 1) {
                                                $builder = $builder->whereHas($relation_array[0], function (Builder $query) use ($v) {
                                                    if ($v['compare'] == 'like') {
                                                        return $query->where($v['column'], $v['compare'], '%' . $v['value'] . '%');
                                                    } else {
                                                        return $query->where($v['column'], $v['compare'], $v['value']);
                                                    }
                                                });
                                            } else if (count($relation_array) == 2) {
                                                $builder = $builder->whereHas($relation_array[0], function (Builder $query) use ($v, $relation_array) {
                                                    return $query->whereHas($relation_array[1], function (Builder $query) use ($v) {
                                                        if ($v['compare'] == 'like') {
                                                            return $query->where($v['column'], $v['compare'], '%' . $v['value'] . '%');
                                                        } else {
                                                            return $query->where($v['column'], $v['compare'], $v['value']);
                                                        }
                                                    });
                                                });
                                            }

                                        } else {
                                            $builder = $builder->$v['relation_name']()->where($v['column'], $v['value']);
                                        }
                                    }
                                    break;
                                default:
                                    $builder = $builder->where($v['column'], $v['value']);
                                    break;
                            }
                        }

                    }
                }
            }
        }
        // 显示列白名单
        if (count($allow_show_columns) > 0) {
            $builder = $builder->select($allow_show_columns);
        }
        return $builder;
    }

    public function index()
    {
        $this->mp_info = request()->get('mp_info');
        if ($this->mp_info) {
            $this->setBuilder($this->getBuilder()->where('mp_info_id', $this->mp_info->id));
        }
        $filters = request()->query();

        $query = $this->buildQuery($this->getBuilder(), $filters, $this->getAllowSearchColumns(), $this->getAllowShowColumns());
        $total_count = $query->count();
        $query = $this->buildQuery($this->getBuilder(), $filters, $this->getAllowSearchColumns(), $this->getAllowShowColumns(), true);
        $charge_orders = $query->get();
        return $this->success(['items' => $charge_orders, 'total_count' => $total_count]);
    }

    public function store()
    {
        $this->mp_info = request()->get('mp_info');
        $params = request()->input();
        $params['mp_info_id'] = $this->mp_info->id;
        $model = $this->getModel();
        $model->fill($params);
        $res = $model->save();
        if ($res) {
            return $this->success($model);
        }else {
            return $this->failed('保存失败');
        }
    }

    public function show($id)
    {
        $this->mp_info = request()->get('mp_info');
        $mp_inf_id = $this->mp_info->id;
        $model = $this->getModel();
        $res = $model->where('id', $id)->where('mp_info_id', $mp_inf_id)->first();
        if ($res) {
            return $this->success($res);
        }else {
            return $this->notFond();
        }
    }

    public function update($id)
    {
        $this->mp_info = request()->get('mp_info');
        $model = $this->getModel();
        $model = $model->where('mp_info_id', $this->mp_info->id)->where('id', $id)->first();
        if (!$model) {
            return $this->notFond();
        }
        $model->fill(\request()->input());
        $res = $model->save();
        if (!$res) {
            return $this->failed('修改失败');
        }else {
            return $this->success('修改成功');
        }
    }

    public function destroy($id)
    {
        $this->mp_info = request()->get('mp_info');
        $model = $this->getModel();
        $model = $model->where('mp_info_id', $this->mp_info->id)->where('id', $id)->first();
        if (!$model) {
            return $this->notFond();
        }
        $res = $model->delete();
        if (!$res) {
            return $this->failed('删除失败');
        }else {
            return $this->success();
        }
    }
}

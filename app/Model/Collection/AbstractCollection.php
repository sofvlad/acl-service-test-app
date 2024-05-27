<?php
declare(strict_types=1);

namespace App\Model\Collection;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Table;

abstract class AbstractCollection extends Table
{
    /**
     * Create and build a new Query by search params
     *
     * @param array $params
     *
     * @return SelectQuery
     */
    public function findByParams(array $params): SelectQuery
    {
        $collection = $this->find();
        $associations = $this->associations()->keys();
        $mainSelect = [];
        $associationSelect = [];
        $mainWhere = [];
        $associationWhere = [];
        if (!empty($params['select'])) {
            foreach ($params['select'] as $column) {
                if (!str_contains($column, '.')) {
                    $mainSelect[] = $column;
                }
                [$association, $column] = explode('.', $column);
                if (!in_array($association, $associations)) {
                    continue;
                }
                if (empty($associationSelect[$association])) {
                    $associationSelect[$association] = [];
                }
                $associationSelect[$association] = $column;
            }
        }
        if (!empty($params['where'])) {
            foreach ($params['where'] as $where) {
                if (!str_contains($where['name'], '.')) {
                    $mainWhere[] = $this->prepareWhere(
                        $where['name'],
                        $where['value'],
                        $where['condition']
                    );
                    continue;
                }
                [$association, $column] = explode('.', $where['name']);
                if (!in_array($association, $associations)) {
                    continue;
                }
                if (empty($associationWhere[$association])) {
                    $associationWhere[$association] = [];
                }
                $associationWhere[$association][] = $this->prepareWhere(
                    $column,
                    $where['value'],
                    $where['condition']
                );
            }
        }
        if (!empty($params['order'])) {
            foreach ($params['order'] as $order) {
                $collection->orderBy([$order['name'] => $order['direction']]);
            }
        }
        if (!empty($mainSelect)) {
            $collection->select($mainSelect);
        }
        if (!empty($mainWhere)) {
            $collection->where($mainWhere);
        }
        foreach ($associations as $association) {
            if (empty($associationSelect[$association]) && empty($associationWhere[$association])) {
                $collection->contain($association);
                continue;
            }
            $collection->contain($association, function (SelectQuery $q) {

            });
        }

        return $collection;
    }

    private function prepareWhere(string $name, string $value, string $condition = '=')
    {
        $key = ($condition != '=')
            ? ($name . ' ' . $condition)
            : $name;

        return [$key => $value];
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\Permission;
use Cake\Datasource\Exception\RecordNotFoundException;

class PermissionCollection extends AbstractCollection
{
    public function initialize(array $config): void
    {
        $this->setTable(Permission::TABLE_NAME);
        $this->setPrimaryKey('id');
        $this->setEntityClass(Permission::class);

        $this->belongsToMany('roles', [
            'className' => RoleCollection::class,
            'joinTable' => 'role_permission',
        ]);
    }

    /**
     * Get entity id by slug
     * 
     * @param array|string @slug
     * 
     * @return array|int
     * @throws RecordNotFoundException
     */
    public function getIdBySlug(array|string $slug): mixed
    {
        $result = $this->find()
            ->select('id')
            ->where(['slug IN' => (is_array($slug) ? $slug : [$slug])])
            ->all()
            ->extract('id')
            ->toArray();
        if (empty($result)) {
            throw new RecordNotFoundException('Entity not founds');
        }

        return is_string($slug) ? $result[0] : $result;
    }
}

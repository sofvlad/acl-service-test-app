<?php
declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\Role;
use Cake\Datasource\Exception\RecordNotFoundException;

class RoleCollection extends AbstractCollection
{
    public function initialize(array $config): void
    {
        $this->setTable(Role::TABLE_NAME);
        $this->setPrimaryKey('id');
        $this->setEntityClass(Role::class);

        $this->belongsToMany('permissions', [
            'className' => PermissionCollection::class,
            'joinTable' => 'role_permission',
        ]);
        $this->belongsToMany('users', [
            'className' => UserCollection::class,
            'joinTable' => 'role_user',
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

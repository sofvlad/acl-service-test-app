<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Collection\PermissionCollection;
use App\Model\Collection\RoleCollection;
use App\Model\Collection\RolePermissionCollection;
use App\Model\Permission;
use Cake\Datasource\ResultSetInterface;

class PermissionRepository
{
    public function __construct(
        private PermissionCollection $permissionCollection,
        private RolePermissionCollection $rolePermissionCollection,
        private RoleCollection $roleCollection
    ) {
    }

    /**
     * Get permission entity by id
     *
     * @param int $id
     * @param bool|array associations
     *
     * @return ResultSetInterface
     */
    public function getById(int $id, bool|array $associations = true): ResultSetInterface
    {
        $collection = $this->permissionCollection->findById($id);
        if (!empty($associations)) {
            $collection->contain(
                $associations === true
                    ? $this->permissionCollection->associations()->keys()
                    : $associations
            );
        }

        return $collection->all();
    }

    /**
     * Get list of entities
     *
     * @param array $params
     *
     * @return ResultSetInterface
     */
    public function getList(array $params): ResultSetInterface
    {
        return $this->permissionCollection->findByParams($params)->all();
    }

    /**
     * Save permission entity
     *
     * @param Permission $role
     *
     * @return bool|EntityInterface
     */
    public function save(Permission $role): mixed
    {
        return $this->permissionCollection->save($role);
    }

    /**
     * Add role from permission by permission id
     *
     * @param int $permissionId
     * @param array $roles
     *
     * @return iterable<\Cake\Datasource\EntityInterface>|false
     */
    public function addRoleByPermission(int $permissionId, array $roles): mixed
    {
        $entities = [];
        if (is_string($roles[0])) {
            $roles = $this->roleCollection->getIdBySlug($roles);
        }
        foreach ($roles as $roleId) {
            $entities[] = $this->rolePermissionCollection->newEntity([
                'permission_id' => $permissionId, 
                'role_id'       => $roleId
            ]);
        }

        return $this->rolePermissionCollection->saveMany($entities);
    }

    /**
     * Remove role from permission by permission id
     *
     * @param int $permissionId
     * @param array $roles
     *
     * @return bool
     */
    public function removeRoleByPermission(int $permissionId, array $roles): bool
    {
        if (is_string($roles[0])) {
            $roles = $this->roleCollection->getIdBySlug($roles);
        }

        return (bool)$this->rolePermissionCollection->deleteAll([
            ['permission_id' => $permissionId], 
            ['role_id IN' => $roles]
        ]);
    }
}

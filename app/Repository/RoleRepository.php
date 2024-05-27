<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Collection\PermissionCollection;
use App\Model\Collection\RoleCollection;
use App\Model\Collection\RolePermissionCollection;
use App\Model\Collection\RoleUserCollection;
use App\Model\Collection\UserCollection;
use App\Model\Role;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;

class RoleRepository
{
    public function __construct(
        private RoleCollection $roleCollection,
        private RoleUserCollection $roleUserCollection,
        private RolePermissionCollection $rolePermissionCollection,
        private PermissionCollection $permissionCollection,
        private UserCollection $userCollection,
    ) {
    }

    /**
     * Get role entity by id
     *
     * @param int $id
     * @param bool|array associations
     *
     * @return ResultSetInterface
     */
    public function getById(int $id, bool|array $associations = true): ResultSetInterface
    {
        $collection = $this->roleCollection->findById($id);
        if (!empty($associations)) {
            $collection->contain(
                $associations === true
                    ? $this->roleCollection->associations()->keys()
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
        return $this->roleCollection->findByParams($params)->all();
    }

    /**
     * Save role entity
     *
     * @param Role $role
     *
     * @return bool|EntityInterface
     */
    public function save(Role $role): mixed
    {
        return $this->roleCollection->save($role);
    }

    /**
     * Add user from role by role id
     *
     * @param int $userId
     * @param array $roles
     *
     * @return iterable<\Cake\Datasource\EntityInterface>|false
     */
    public function addUserByRole(int $roleId, array $users): mixed
    {
        $entities = [];
        if (is_string($users[0])) {
            $users = $this->userCollection->getIdByEmail($users);
        }
        foreach ($users as $userId) {
            $entities[] = $this->roleUserCollection->newEntity(['role_id' => $roleId, 'user_id' => $userId]);
        }

        return $this->roleUserCollection->saveMany($entities);
    }

    /**
     * Remove user from role by role id
     *
     * @param int $roleId
     * @param array $users
     *
     * @return bool
     */
    public function removeUserByRole(int $roleId, array $users): mixed
    {
        if (is_string($users[0])) {
            $users = $this->userCollection->getIdByEmail($users);
        }

        return (bool)$this->roleUserCollection->deleteAll([['role_id' => $roleId], ['user_id IN' => $users]]);
    }

    /**
     * Add permission from role by role id
     *
     * @param int $roleId
     * @param array $permissions
     *
     * @return iterable<\Cake\Datasource\EntityInterface>|false
     */
    public function addPermissionByRole(int $roleId, array $permissions): mixed
    {
        $entities = [];
        if (is_string($permissions[0])) {
            $permissions = $this->permissionCollection->getIdBySlug($permissions);
        }
        foreach ($permissions as $permissionId) {
            $entities[] = $this->rolePermissionCollection->newEntity([
                'role_id'       => $roleId, 
                'permission_id' => $permissionId
            ]);
        }

        return $this->rolePermissionCollection->saveMany($entities);
    }

    /**
     * Remove permission from role by role id
     *
     * @param int $roleId
     * @param array $permissions
     *
     * @return bool
     */
    public function removePermissionByRole(int $roleId, array $permissions): bool
    {
        if (is_string($permissions[0])) {
            $permissions = $this->permissionCollection->getIdBySlug($permissions);
        }

        return (bool)$this->rolePermissionCollection->deleteAll([
            ['role_id' => $roleId],
            ['permission_id IN' => $permissions]]
        );
    }
}

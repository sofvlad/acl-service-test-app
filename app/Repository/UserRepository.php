<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Collection\RoleCollection;
use App\Model\Collection\RoleUserCollection;
use App\Model\Collection\UserCollection;
use App\Model\User;
use Cake\Datasource\ResultSetInterface;

class UserRepository
{
    public function __construct(
        private UserCollection $userCollection,
        private RoleUserCollection $roleUserCollection,
        private RoleCollection $roleCollection
    ) {
    }

    /**
     * Get user entity by id
     *
     * @param int $id
     * @param bool|array associations
     *
     * @return ResultSetInterface
     */
    public function getById(int $id, bool|array $associations = true): ResultSetInterface
    {
        $collection = $this->userCollection->findById($id);
        if (!empty($associations)) {
            $collection->contain(
                $associations === true
                    ? $this->userCollection->associations()->keys()
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
        return $this->userCollection->findByParams($params)->all();
    }

    /**
     * Save user entity
     *
     * @param User $role
     *
     * @return bool|EntityInterface
     */
    public function save(User $role): mixed
    {
        return $this->userCollection->save($role);
    }

    /**
     * Add role from user by user id
     *
     * @param int $userId
     * @param array $roles
     *
     * @return iterable<\Cake\Datasource\EntityInterface>|false
     */
    public function addRoleByUser(int $userId, array $roles): mixed
    {
        $entities = [];
        if (is_string($roles[0])) {
            $roles = $this->roleCollection->getIdBySlug($roles);
        }
        foreach ($roles as $roleId) {
            $entities[] = $this->roleUserCollection->newEntity(['user_id' => $userId, 'role_id' => $roleId]);
        }

        return $this->roleUserCollection->saveMany($entities);
    }

    /**
     * Remove role from user by user id
     *
     * @param int $userId
     * @param array $roles
     *
     * @return bool
     */
    public function removeRoleByUser(int $userId, array $roles): bool
    {
        if (is_string($roles[0])) {
            $roles = $this->roleCollection->getIdBySlug($roles);
        }

        return (bool)$this->roleUserCollection->deleteAll([['user_id' => $userId], ['role_id IN' => $roles]]);
    }
}

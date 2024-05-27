<?php
declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\RolePermission;

class RolePermissionCollection extends AbstractCollection
{
    public function initialize(array $config): void
    {
        $this->setTable(RolePermission::TABLE_NAME);
        $this->setPrimaryKey(['role_id', 'permission_id']);
        $this->setEntityClass(RolePermission::class);
    }
}

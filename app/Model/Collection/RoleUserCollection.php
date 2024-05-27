<?php
declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\RoleUser;

class RoleUserCollection extends AbstractCollection
{
    public function initialize(array $config): void
    {
        $this->setTable(RoleUser::TABLE_NAME);
        $this->setPrimaryKey(['role_id', 'user_id']);
        $this->setEntityClass(RoleUser::class);
    }
}

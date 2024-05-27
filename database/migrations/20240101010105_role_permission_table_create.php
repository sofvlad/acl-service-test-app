<?php

declare(strict_types=1);

use App\Model\Permission;
use App\Model\Role;
use App\Model\RolePermission;
use Phinx\Migration\AbstractMigration;

final class RolePermissionTableCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->table(RolePermission::TABLE_NAME, ['id' => false, 'primary_key' => ['role_id', 'permission_id']])
        ->addColumn('role_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('permission_id', 'integer', ['signed' => false, 'null' => false])
            ->addTimestamps()
            ->addForeignKey(
                'role_id',
                Role::TABLE_NAME,
                'id',
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE']
            )
            ->addForeignKey(
                'permission_id',
                Permission::TABLE_NAME,
                'id',
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE']
            )
            ->create();
    }

    public function down(): void
    {
        $this->table(RolePermission::TABLE_NAME)->drop();
    }
}

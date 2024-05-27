<?php

declare(strict_types=1);

use App\Model\Role;
use App\Model\RoleUser;
use App\Model\User;
use Phinx\Migration\AbstractMigration;

final class RoleUserTableCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->table(RoleUser::TABLE_NAME, ['id' => false, 'primary_key' => ['role_id', 'user_id']])
            ->addColumn('role_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            ->addTimestamps()
            ->addForeignKey(
                'role_id',
                Role::TABLE_NAME,
                ['id'],
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE']
            )
            ->addForeignKey(
                'user_id',
                User::TABLE_NAME,
                ['id'],
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE']
            )
            ->create();
    }

    public function down(): void
    {
        $this->table(RoleUser::TABLE_NAME)->drop();
    }
}

<?php

declare(strict_types=1);

use App\Model\Role;
use Phinx\Migration\AbstractMigration;

final class RolesTableCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->table(Role::TABLE_NAME)
            ->addColumn('slug', 'string', ['limit' => 20])
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('description', 'text', ['null' => true])
            ->addTimestamps()
            ->addIndex('slug', ['unique' => true])
            ->addIndex('name', ['unique' => true])
            ->create();
    }

    public function down(): void
    {
        $this->table(Role::TABLE_NAME)->drop();
    }
}

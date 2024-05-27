<?php

declare(strict_types=1);

use App\Model\Permission;
use Phinx\Migration\AbstractMigration;

final class PermissionsTableCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->table(Permission::TABLE_NAME)
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
        $this->table(Permission::TABLE_NAME)->drop();
    }
}

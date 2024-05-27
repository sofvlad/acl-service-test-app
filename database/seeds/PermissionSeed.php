<?php

declare(strict_types=1);

use App\Model\Permission;
use Phinx\Seed\AbstractSeed;

class PermissionSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table(Permission::TABLE_NAME);

        $table->insert([
            [
                'slug'        => 'send_messages',
                'name'        => 'Send Message',
                'description' => 'Possibility to send messages',
            ],
            [
                'slug'        => 'service_api',
                'name'        => 'Service API',
                'description' => 'Access to service API',
            ],
            [
                'slug'        => 'debug',
                'name'        => 'Debug',
                'description' => 'Possibility of debugging',
            ],
        ])->saveData();
    }
}

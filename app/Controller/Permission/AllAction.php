<?php
declare(strict_types=1);

namespace App\Controller\Permission;

use App\Model\Collection\PermissionCollection;
use Psr\Http\Message\ServerRequestInterface;

class AllAction
{
    public function __construct(
        private PermissionCollection $permissionCollection
    ) {
    }

    public function __invoke(ServerRequestInterface $request, array $args): array
    {
        return [
            'success' => true,
            'result' => $this->permissionCollection->find()->toArray()
        ];
    }
}

<?php
declare(strict_types=1);

namespace App\Controller\Permission;

use App\Repository\PermissionRepository;
use Psr\Http\Message\ServerRequestInterface;

class GetAction
{
    public function __construct(
        private PermissionRepository $permissionRepository
    ) {
    }

    public function __invoke(ServerRequestInterface $request, array $args): array
    {
        return [
            'success' => true,
            'result'  => $this->permissionRepository->getById((int)$args['id']),
        ];
    }
}

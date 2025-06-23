<?php

namespace Waps\Framework\Controller;

class UserController extends BaseController
{
    public function render(Request $request): void
    {
        $userId = $request->params[0] ?? null;
        $this->renderTwig('user.twig', ['userId' => $userId]);
    }
}

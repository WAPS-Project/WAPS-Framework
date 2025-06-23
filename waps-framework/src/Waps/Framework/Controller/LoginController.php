<?php

namespace Waps\Framework\Controller;

class LoginController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'static/Login.page.php');
    }
}

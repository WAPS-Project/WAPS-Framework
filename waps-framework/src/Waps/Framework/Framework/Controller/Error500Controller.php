<?php

namespace Waps\Framework\Controller;

class Error500Controller extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'static/Error_500.page.php');
    }
}

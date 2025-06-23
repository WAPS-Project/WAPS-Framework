<?php

namespace Waps\Framework\Controller;

class Error404Controller extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::VIEW_ROOT . 'static/Error_404.page.php');
    }
}

<?php

namespace Waps\Framework\Controller;

class LgController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::VIEW_ROOT . 'private/Lg.page.php');
    }
}

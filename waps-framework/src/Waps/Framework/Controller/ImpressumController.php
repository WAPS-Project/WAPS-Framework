<?php

namespace Waps\Framework\Controller;

class ImpressumController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'static/Impressum.page.php');
    }
}

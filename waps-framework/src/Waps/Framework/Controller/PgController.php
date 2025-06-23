<?php

namespace Waps\Framework\Controller;

class PgController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'private/Pg.page.php');
    }
}

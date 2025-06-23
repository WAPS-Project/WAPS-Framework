<?php

namespace Waps\Framework\Controller;

class LchoiceController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'private/Lchoice.page.php');
    }
}

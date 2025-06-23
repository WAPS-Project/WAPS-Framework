<?php

namespace Waps\Framework\Controller;

class ExampleController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'open/Example.page.php');
    }
}

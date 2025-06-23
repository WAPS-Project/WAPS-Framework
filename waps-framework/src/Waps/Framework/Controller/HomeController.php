<?php

namespace Waps\Framework\Controller;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'open/Home.page.php');
    }
}

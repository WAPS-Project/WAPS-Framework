<?php

namespace Waps\Framework\Controller;

class SettingsController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'static/Settings.page.php');
    }
}

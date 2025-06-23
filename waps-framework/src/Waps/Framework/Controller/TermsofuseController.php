<?php

namespace Waps\Framework\Controller;

class TermsofuseController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'static/Termsofuse.page.php');
    }
}

<?php

namespace Waps\Framework\Controller;

class GallerytestController extends BaseController
{
    public function render(Request $request): void
    {
        $this->renderView(self::$VIEW_ROOT . 'open/Gallerytest.page.php');
    }
}

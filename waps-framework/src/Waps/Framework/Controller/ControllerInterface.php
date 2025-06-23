<?php

namespace Waps\Framework\Controller;

use Waps\Framework\Http\Request;

interface ControllerInterface
{
    /**
     * Render the controller action
     *
     * @param Request $request
     * @return void
     */
    public function render(Request $request): void;
}

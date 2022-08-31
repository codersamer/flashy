<?php

namespace Codersamer\Flashy\Contracts;

use Codersamer\Flashy\Entities\FlashMessage;
use Illuminate\View\View;

interface IFlashyRenderer
{
    function render(FlashMessage $message) : View;
}

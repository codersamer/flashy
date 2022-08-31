<?php

namespace Codersamer\Flashy\Components;

use Codersamer\Flashy\Facades\Flashy;
use Illuminate\View\Component;

class FlashyComponent extends Component
{
    public function render()
    {
        $messages = Flashy::messages();
        Flashy::flush();
        return view('flashy::components.flashy', [
            'messages' => $messages
        ]);
    }
}

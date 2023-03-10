<?php

namespace Codersamer\Flashy\Renderers;

use Codersamer\Flashy\Contracts\IFlashyRenderer;
use Codersamer\Flashy\Entities\FlashMessage;
use Codersamer\Flashy\Enums\MessageLevel;
use Illuminate\View\View;

class TailwindRenderer implements IFlashyRenderer
{

    public function render(FlashMessage $message) : View
    {
        $messageClass = 'light';
        switch($message->getType())
        {
            case MessageLevel::Debug: $messageClass = 'primary'; break;
            case MessageLevel::Error: $messageClass = 'danger'; break;
            case MessageLevel::Warning: $messageClass = 'warning'; break;
            case MessageLevel::Info: $messageClass = 'info'; break;
            case MessageLevel::Success: $messageClass = 'success'; break;
            case MessageLevel::Log: $messageClass = 'secondary'; break;
        }
        return view('flashy::renders.tailwind.message', [
            'message' => $message,
            'class' => $messageClass
        ]);
    }
}

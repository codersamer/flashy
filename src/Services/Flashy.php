<?php

namespace Codersamer\Flashy\Services;

use Codersamer\Flashy\Entities\FlashMessage;
use Codersamer\Flashy\Enums\MessageTypes;
use Illuminate\Foundation\Application;

class Flashy
{

    protected array $messages = [];

    public function __construct(protected Application $application) { }


    /******************************/
    // Generators
    /******************************/

    public function message(String $text, MessageTypes $type = MessageTypes::Debug)
    {
        $message = FlashMessage::make($text)->type($type);
        $this->messages[] = $message;
        return $message;
    }

    public function success(String $text)
    {
        return $this->message($text, MessageTypes::Success);
    }

    public function error(String $text)
    {
        return $this->message($text, MessageTypes::Error);
    }

    public function info(String $text)
    {
        return $this->message($text, MessageTypes::Info);
    }

    public function warning(String $text)
    {
        return $this->message($text, MessageTypes::Warning);
    }

    public function log(String $text)
    {
        return $this->message($text, MessageTypes::Log);
    }

    public function debug(String $text)
    {
        return $this->message($text, MessageTypes::Debug);
    }

    /**
     * Flash Current Messages to Session before Changing Requests
     *
     * @return void
     */
    public function flash()
    {

    }

    /**
     * Clear Flashed Messages
     *
     * @return void
     */
    public function flush()
    {

    }
}

<?php

namespace Codersamer\Flashy\Services;

use Codersamer\Flashy\Contracts\IFlashyRenderer;
use Codersamer\Flashy\Entities\FlashMessage;
use Codersamer\Flashy\Enums\MessageLevel;
use Codersamer\Flashy\Enums\MessageTypes;
use Illuminate\Foundation\Application;

class Flashy
{

    protected array $messages = [];

    public function __construct(protected Application $application) { }


    /******************************/
    // Generators
    /******************************/

    public function message(String $text, MessageLevel $type = MessageLevel::Debug)
    {
        $message = FlashMessage::make($text)->type($type);
        $this->messages[] = $message;
        return $message;
    }

    public function success(String $text)
    {
        return $this->message($text, MessageLevel::Success);
    }

    public function error(String $text)
    {
        return $this->message($text, MessageLevel::Error);
    }

    public function info(String $text)
    {
        return $this->message($text, MessageLevel::Info);
    }

    public function warning(String $text)
    {
        return $this->message($text, MessageLevel::Warning);
    }

    public function log(String $text)
    {
        return $this->message($text, MessageLevel::Log);
    }

    public function debug(String $text)
    {
        return $this->message($text, MessageLevel::Debug);
    }

    public function messages()
    {
        return collect($this->messages);
    }

    /**
     * Get Suitable Render Engine
     *
     * @return IFlashyRenderer|null
     */
    public function getRenderEngine() : ?IFlashyRenderer
    {
        $renderEngineClass = config('flashy.render.use', null);
        $engines = config('flashy.render.engines', []);
        if(!isset($engines[$renderEngineClass])) { return null; }
        $renderEngineClass = $engines[$renderEngineClass];
        if($renderEngineClass == null || !class_exists($renderEngineClass)) { return null; }
        $instance = new $renderEngineClass;
        return $instance instanceof IFlashyRenderer ? $instance : null;
    }

    /**
     * Flash Current Messages to Session before Changing Requests
     *
     * @return void
     */
    public function flash()
    {
        $data = (serialize($this->messages));
        session(['flashy' => $data]);
    }

    /**
     * Clear Flashed Messages
     *
     * @return void
     */
    public function flush()
    {
        $this->messages = [];
    }

    public function restore()
    {
        if(session('flashy', null) != null)
        {
            $this->messages = unserialize(session('flashy', null));
            session()->forget('flashy');
        }
    }
}

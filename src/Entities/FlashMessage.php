<?php

namespace Codersamer\Flashy\Entities;

use Closure;
use Codersamer\Flashy\Enums\MessageLevel;
use Codersamer\Flashy\Facades\Flashy;
use Codersamer\Flashy\Traits\Attributable;

class FlashMessage
{

    use Attributable;

    protected String $text = '';

    protected MessageLevel $type = MessageLevel::Debug;

    protected String $title = '';

    protected String $icon = '';

    protected bool|Closure $show = true;

    protected array $attributes = [];

    protected array $buttons = [];

    /******************************/
    // Initiators
    /******************************/

    public static function make(String $text)
    { return (new static)->text($text); }

    /******************************/
    // Setters
    /******************************/

    public function text(String $text)
    {
        $this->text = $text; return $this;
    }

    public function type(String|MessageLevel $type)
    {
        $this->type = is_string($type) ? MessageLevel::from(strtolower($type)) : $type; return $this;
    }

    public function title(String $title)
    {
        $this->title = $title; return $this;
    }

    public function icon(String $icon)
    {
        $this->icon = $icon; return $this;
    }

    public function show(bool $show)
    {
        $this->show = $show; return $this;
    }

    public function class(String|array $class)
    {
        return $this->attribute('class', $class);
    }

    public function id(String $id)
    {
        return $this->attribute('id', $id);
    }

    public function button(FlashButton $button)
    {
        $this->buttons[] = $button;
        return $this;
    }


    /******************************/
    // Getters
    /******************************/

    public function getText() : String
    {
        return $this->text;
    }

    public function getType() : MessageLevel
    {
        return $this->type;
    }

    public function getTitle() : String
    {
        return $this->title;
    }

    public function getIcon() : String
    {
        return $this->icon;
    }



    public function getButtons() : array
    {
        return $this->buttons;
    }

    /******************************/
    // Accessors
    /******************************/

    public function hasTitle() : bool
    {
        return !empty($this->title);
    }

    public function hasIcon() : bool
    {
        return !empty($this->icon);
    }

    public function hasButtons() : bool
    {
        return count($this->buttons) > 0;
    }

    public function is(String|MessageLevel $type) : bool
    {
        $type = is_string($type) ? MessageLevel::from($type) : $type;
        return $type == $this->getType();
    }






    public function render()
    {
        $engine = Flashy::getRenderEngine();
        return $engine->render($this);
    }

    public function __serialize(): array
    {
        return [
            'text' => $this->text,
            'type' => $this->type->value,
            'title' => $this->title,
            'icon' => $this->icon,
            'show' => is_bool($this->show) ? $this->show : call_user_func($this->show),
            'attributes' => $this->attributes,
            'buttons' => $this->buttons
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->text($data['text'] ?? '');
        $this->type($data['type'] ?? '');
        $this->title($data['title'] ?? '');
        $this->icon($data['icon'] ?? '');
        $this->show($data['show'] ?? true);
        $this->attributes = $data['attributes'] ?? [];
        $this->buttons = $data['buttons'] ?? [];

    }
}

<?php

namespace Codersamer\Flashy\Entities;

use Closure;
use Codersamer\Flashy\Enums\MessageTypes;

class FlashMessage
{
    protected String $text = '';

    protected MessageTypes $type = MessageTypes::Debug;

    protected String $title = '';

    protected String $icon = '';

    protected bool|Closure $show = true;

    protected array $attributes = [];

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

    public function type(String|MessageTypes $type)
    {
        $this->type = is_string($type) ? MessageTypes::from(strtolower($type)) : $type; return $this;
    }

    public function title(String $title)
    {
        $this->title = $title; return $this;
    }

    public function icon(String $title)
    {
        $this->title = $title; return $this;
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

    public function attribute(String $name, String|array $value)
    {
        $name = strtolower($name);
        if(!isset($this->attributes[$name]))
        { $this->attributes[$name] = []; }
        $this->attributes[$name] =
            is_array($value)
            ? array_merge($this->attributes[$name], $value)
            : array_merge($this->attributes[$name], [$value]);
        return $this;
    }

    /******************************/
    // Getters
    /******************************/

    public function getText() : String
    {
        return $this->text;
    }

    public function getType() : MessageTypes
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
}

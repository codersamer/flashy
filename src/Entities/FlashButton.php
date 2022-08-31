<?php

namespace Codersamer\Flashy\Entities;

use Codersamer\Flashy\Enums\ButtonType;
use Codersamer\Flashy\Traits\Attributable;

class FlashButton
{

    use Attributable;

    protected ButtonType $type = ButtonType::Solid;

    protected String $text = '';

    protected String $icon = '';


    public function type(ButtonType|String $type)
    {
        $this->type = is_string($type) ? ButtonType::from($type) : $type;
        return $this;
    }

    public function text(String $text)
    {
        $this->text = $text;
        return $this;
    }

    public function icon(String $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public static function solid(String $text)
    {
        $button = new static;
        return $button->type(ButtonType::Solid)->text($text);
    }

    public static function outline(String $text)
    {
        $button = new static;
        return $button->type(ButtonType::Outline)->text($text);
    }

    public function getText() : String { return $this->text; }

    public function getType() : ButtonType { return $this->type; }

    public function getIcon() : String { return $this->icon; }

    public function hasIcon() : bool { return !empty($this->icon); }

    protected function onAttributesBuild()
    {
        $this->attribute('href', '#');
    }

}

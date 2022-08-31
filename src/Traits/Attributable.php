<?php

namespace Codersamer\Flashy\Traits;


trait Attributable
{

    protected array $attributes = [];

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

    public function getAttributes(array $merge = []) : array
    {
        if(method_exists($this, 'onAttributesBuild'))
        { $this->onAttributesBuild(); }
        $attributes = $this->attributes;
        foreach($merge as $key => $value)
        {
            if(!isset($attributes[$key])) { $attributes[$key] = []; }
            $value = is_array($value) ? $value : [$value];
            $attributes[$key] = array_merge_recursive($attributes[$key], $value);
        }

        foreach($attributes as $key => $value)
        {
            $attributes[$key] = implode(' ', $value);
        }

        return $attributes;
    }

    public function buildAttributes(array $merge = []) : String
    {
        $attributes = $this->getAttributes($merge);
        $data = [];
        foreach($attributes as $key => $value)
        {
            $data[] = $key.'="'.$value.'"';
        }
        return implode(' ', $data);
    }
}

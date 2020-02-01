<?php

namespace Neko\Menu;

use Neko\Menu\Html\Attributes;
use Neko\Menu\Traits\Conditions as ConditionsTrait;
use Neko\Menu\Traits\Activatable as ActivatableTrait;
use Neko\Menu\Traits\HasTextAttributes as HasAttributesTrait;
use Neko\Menu\Traits\HasHtmlAttributes as HasHtmlAttributesTrait;
use Neko\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;

class Link implements Item, HasHtmlAttributes, HasParentAttributes, Activatable
{
    use ActivatableTrait, HasHtmlAttributesTrait, HasParentAttributesTrait, ConditionsTrait, HasAttributesTrait;

    /** @var string */
    protected $text;

    /** @var string|null */
    protected $url = null;

    /** @var string */
    protected $prepend, $append = '';

    /** @var bool */
    protected $active = false;

    /** @var \Neko\Menu\Html\Attributes */
    protected $htmlAttributes, $parentAttributes;

    /**
     * @param string $url
     * @param string $text
     */
    protected function __construct(string $url, string $text)
    {
        $this->url = $url;
        $this->text = $text;
        $this->htmlAttributes = new Attributes();
        $this->parentAttributes = new Attributes();
    }

    /**
     * @param string $url
     * @param string $text
     *
     * @return static
     */
    public static function to(string $url, string $text)
    {
        return new static($url, $text);
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $attributes = new Attributes(['href' => $this->url]);
        $attributes->mergeWith($this->htmlAttributes);

        return $this->prepend."<a {$attributes}>{$this->text}</a>".$this->append;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}

<?php

namespace Neko\Menu;

use Neko\Menu\Html\Attributes;
use Neko\Menu\Traits\Activatable as ActivatableTrait;
use Neko\Menu\Traits\Conditions as ConditionsTrait;
use Neko\Menu\Traits\HasHtmlAttributes as HasHtmlAttributesTrait;
use Neko\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;
use Neko\Menu\Traits\HasTextAttributes as HasAttributesTrait;

class Link implements Item, HasHtmlAttributes, HasParentAttributes, Activatable
{
    use ActivatableTrait;
    use HasHtmlAttributesTrait;
    use HasParentAttributesTrait;
    use ConditionsTrait;
    use HasAttributesTrait;

    /** @var string */
    protected $text;

    /** @var string|null */
    protected $url = null;

    /** @var string */
    protected $prepend = '';

    /** @var string */
    protected $append = '';

    /** @var bool */
    protected $active = false;

    /** @var \Neko\Menu\Html\Attributes */
    protected $htmlAttributes;
    protected $parentAttributes;

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

        return $this->renderPrepend()."<a {$attributes}>{$this->text}</a>".$this->renderAppend();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getPrepend()
    {
        return $this->prepend;
    }

    public function struct()
    {
        return array("title"=>getTagspan($this->text()),"url"=>$this->getUrl());
    }
}

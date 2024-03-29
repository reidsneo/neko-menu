<?php

namespace Neko\Menu;

use Neko\Menu\Html\Attributes;
use Neko\Menu\Traits\Activatable as ActivatableTrait;
use Neko\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;

class Html implements Item, Activatable, HasParentAttributes
{
    use ActivatableTrait;
    use HasParentAttributesTrait;

    /** @var string */
    protected $html;

    /** @var string|null */
    protected $url = null;

    /** @var bool */
    protected $active = false;

    /** @var \Neko\Menu\Html\Attributes */
    protected $parentAttributes;

    /**
     * @param string $html
     */
    protected function __construct(string $html)
    {
        $this->html = $html;
        $this->parentAttributes = new Attributes();
    }

    /**
     * Create an item containing a chunk of raw html.
     *
     * @param string $html
     *
     * @return static
     */
    public static function raw(string $html)
    {
        return new static($html);
    }

    /**
     * Create an empty item.
     *
     * @return static
     */
    public static function empty()
    {
        return new static('');
    }

    /**
     * @return string
     */
    public function html(): string
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function struct()
    {
        return $this->html;
    }
}

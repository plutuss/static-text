<?php

namespace Plutuss\Wrapper;

class StaticTextPageWrapper implements StaticTextPageWrapperInterface
{

    private array $attribute;

    public function setAttribute(string $name, string $slug, string $template): static
    {
        $this->attribute = [
            'name' => $name,
            'slug' => $slug,
            'template' => $template
        ];

        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function blocks(): StaticTextWrapperInterface
    {
        return new StaticTextWrapper;
    }
}

<?php

namespace Plutuss\Wrapper;

interface StaticTextPageWrapperInterface
{

    /**
     * @param string $name
     * @param string $slug
     * @param string $template
     * @return mixed
     */
    public function setAttribute(string $name,
                                 string $slug,
                                 string $template): mixed;
}

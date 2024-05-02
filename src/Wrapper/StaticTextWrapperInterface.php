<?php

namespace Plutuss\Wrapper;

interface StaticTextWrapperInterface
{

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): static;

    /**
     * @param int $page_id
     * @return $this
     */
    public function setPageId(int $page_id): static;

    /**
     * @param string $key
     * @param string $value
     * @param string $type
     * @return $this
     */
    public function setData(string $key, string $value, string $type): static;

    /**
     * @return array
     */
    public function get(): array;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return int|null
     */
    public function getPageId(): ?int;

    /**
     * @return array
     */
    public function getData(): array;

}

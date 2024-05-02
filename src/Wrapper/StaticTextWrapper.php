<?php

namespace Plutuss\Wrapper;

class StaticTextWrapper implements StaticTextWrapperInterface
{
    private ?string $name;
    private ?int $page_id;
    private array $data;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $page_id
     * @return $this
     */
    public function setPageId(int $page_id): static
    {
        $this->page_id = $page_id;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $type
     * @return $this
     */
    public function setData(string $key, string $value, string $type): static
    {
        $data = [
            [
                "id" => 1,
                "key" => $key,
                "value" => $value,
                "type" => $type,
            ],

        ];
        if (!empty($this->data)) {
            $last = end($this->data);
            $id = $last['id'];
            $data[0]['id'] = ++$id;
            $this->data = array_merge($this->data, $data);
            return $this;
        }

        $this->data = $data;
        return $this;
    }

    /**
     * @return array{name: string, page_id: int, data: array}
     */
    public function get(): array
    {
        $data = $this->data;
        $name = $this->name;
        $page_id = $this->page_id;

        unset($this->data);
        unset($this->name);
        unset($this->page_id);

        return [
            'name' => $name,
            'page_id' => $page_id,
            'data' => $data
        ];

    }

}

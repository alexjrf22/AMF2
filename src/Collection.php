<?php

namespace ALEX;

// uma trait adiciona metodos a uma classe sem necessidade de herança.

    trait Collection
    {
        private $itens= [];

    public function __construct(array $itens = [])
    {
        $this->itens = $itens;
    }

    public function offsetExists($offset)
    {
        return isset($this->itens[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->itens[$offset];
    }

    public function offsetSet($offset, $value)
    {
        //se o valor for uma função anonima passar o valor da instancia da classe.
        if (is_callable($value))
        {
            $value = $value($this);
        }

        $this->itens[$offset] = $value;
       
    }

    public function offsetUnset($offset)
    {
        unset ($this->itens[$offset]);
    }
    }
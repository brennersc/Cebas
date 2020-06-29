<?php

abstract class Enum{
    protected $valor;

    function __construct($valor)
    {
        $this->setValor($valor);
    }

    function __get($property)
    {
        return $this->valor;
    }

    function __set($property, $valor)
    {
        $this->setValor($valor);
    }

    public function getValor(){
        return $this->$valor;
    }
    
    public function setValor($valor)
    {
        if ($this->isValidEnumValue($valor))
            $this->valor = $valor;
        else
            throw new Exception("Tipo especificado é inválido!");
    }

    public function isValidEnumValue($checkValue)
    {
        $reflector = new ReflectionClass(get_class($this));
        foreach ($reflector->getConstants() as $valor_valido)
        {
            if ($valor_valido == $checkValue) return true;
        }
        return false;
    }

    function __toString()
    {
        return (string)$this->valor;
    }
}
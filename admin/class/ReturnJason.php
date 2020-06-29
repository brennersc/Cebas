<?php

class ReturnJason implements JsonSerializable{
    private $erro;
    private $mensagem;

    public function __construct(array $data)
    {
        $this->erro = $data['erro'];
        $this->mensagem = $data['mensagem'];
    }

    public function jsonSerialize()
    {
        return 
        [
            'erro'   => $this->erro,
            'mensagem' => $this->mensagem
        ];
    }
}
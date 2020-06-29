<?php
include_once('class/Enum.php');

class StatusEnum extends Enum {
    const NaoIniciado = 1;
    const EmAnalise = 2;
    const Aprovado = 3;
    const Reprovado = 4;
  }
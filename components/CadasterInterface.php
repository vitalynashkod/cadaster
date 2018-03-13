<?php

namespace app\components;

/**
 * Interface CadasterInterface
 * @package app\components
 */
interface CadasterInterface
{
    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @param string $number
     */
    public function setCadastralNumber(string $number);

    /**
     * @param string $area
     */
    public function setArea(string  $area);
}
<?php

namespace EvolutionCMS\Main\Components\SnippetResult\controllers;

use EvolutionCMS\Main\Components\SnippetResult\constants\OutputModes;
use EvolutionCMS\Main\Components\SnippetResult\exceptions\InvalidOutputModeException;

class SnippetResult
{
    /** @var bool */
    public $status;
    /** @var mixed */
    public $result_data;
    /** @var int */
    public $error_code;
    /** @var string|int|float */
    public $error_message;
    /** @var array */
    public $process_info;

    /** @var int */
    private $outputMode = OutputModes::JSON_OUTPUT_MODE;

    /**
     * SnippetResult constructor.
     *
     * @param bool $bool_status
     * @param null $data
     * @param int $error_code
     * @param string $error_message
     *
     * @todo описать способ использования
     */
    public function __construct($bool_status = false, $data = null, $error_code = 0, $error_message = '')
    {
        $this->status = (bool)$bool_status;
        $this->result_data = $data;
        $this->error_code = $error_code;
        $this->error_message = $error_message;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $res = null;
        switch ($this->outputMode) {
            case OutputModes::HTML_OUTPUT_MODE:
                $res = $this->result_data;
                break;
            case OutputModes::JSON_OUTPUT_MODE:
                header('Content-Type: application/json');
                $res = json_encode($this, JSON_UNESCAPED_UNICODE);
                break;
        }

        return (string)$res;
    }

    /**
     * @param bool $bool_status
     * @param null $data
     * @param int $error_code
     * @param string $error_message
     *
     * @return $this
     *
     * @todo описать способ использования
     */
    public function setResult($bool_status = false, $data = null, $error_code = 0, $error_message = '')
    {
        $this->status = (bool)$bool_status;
        if (!is_null($data)) {
            $this->result_data = $data;
        }
        $this->error_code = $error_code;
        $this->error_message = $error_message;

        return $this;
    }

    /**
     * @param int $mode
     * @return $this
     * @throws InvalidOutputModeException
     * @throws \ReflectionException
     */
    public function setOutputMode(int $mode)
    {
        $allowedModes = (new \ReflectionClass(OutputModes::class))->getConstants();

        if (!in_array($mode, $allowedModes)) {
            throw new InvalidOutputModeException();
        }

        $this->outputMode = $mode;

        return $this;
    }
}

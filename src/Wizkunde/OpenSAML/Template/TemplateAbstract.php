<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Configuration;
use Wizkunde\OpenSAML\ConfigurationTrait;
use Wizkunde\OpenSAML\Configuration\Timestamp;
use Wizkunde\OpenSAML\Configuration\UniqueID;

/**
 * Class TemplateAbstract
 *
 * Abstract class that is used for creating templates
 *
 * @package Wizkunde\OpenSAML\Template
 */
abstract class TemplateAbstract implements TemplateInterface
{
    use ConfigurationTrait;

    protected $uniqueId;
    protected $timestamp;

    public function __construct(UniqueID $uniqueId, Timestamp $timestamp)
    {
        $this->setUniqueId($uniqueId);
        $this->setTimestamp($timestamp);
    }

    public function setUniqueId(UniqueID $uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    public function setTimestamp(Timestamp $timestamp)
    {
        $this->timestamp = $timestamp;
    }
}

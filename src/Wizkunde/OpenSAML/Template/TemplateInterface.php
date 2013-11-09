<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Configuration;
use Wizkunde\OpenSAML\Configuration\Timestamp;
use Wizkunde\OpenSAML\Configuration\UniqueID;

/**
 * Class TemplateInterface
 *
 * Interface thats used for all SAML templates
 *
 * @package Wizkunde\OpenSAML\Template
 */
interface TemplateInterface
{
    public function __construct(UniqueID $uniqueId, Timestamp $timestamp);

    /**
     * Automatically return the template as a string
     *
     * @return string
     */
    public function __toString();
}

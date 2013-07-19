<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Configuration;
use Wizkunde\OpenSAML\ConfigurationTrait;

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
}
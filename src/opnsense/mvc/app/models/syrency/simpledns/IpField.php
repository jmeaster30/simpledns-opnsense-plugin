<?php
namespace syrency\simpledns;

use OPNsense\Base\FieldTypes\BaseListField;

class IpField extends BaseListField
{
  
  protected $internalAsList = false;

  /**
   * @var string when multiple values could be provided at once, specify the split character
   */
  protected $internalFieldSeparator = ',';

  /**
   * @var string Network family (ipv4, ipv6)
   */
  protected $internalAddressFamily = 'ipv4';

  public function __construct($ref = null, $tagname = null)
  {
    parent::__construct($ref, $tagname);
    //$this->setMultiple(true);
  }

  public function setAsList($value) 
  {
    $this->internalAsList = $value == 'Y';
  }

  public function getAsList($value)
  {
    return $this->internalAsList;
  }

  public function getValidators()
  {
    $validators = parent::getValidators();
    if ($this->internalValue != null) {
      $validators[] = new CallbackValidator(["callback" => function ($data) {
        foreach ($this->internalAsList ? explode($this->internalFieldSeparator, $data) : [$data] as $value) {
          if (($this->internalAddressFamily == 'ipv4' || $this->internalAddressFamily == null) && Util::isIpv4Address($value)) {
            continue;
          }

          if (($this->internalAddressFamily == 'ipv6' || $this->internalAddressFamily == null) &&Util::isIpv6Address($value)) {
            continue;
          }

          return ["\"" . $value . "\" is invalid. " . $this->getValidationMessage()];
        }
      }]);
    }

    return $validators;
  }
}
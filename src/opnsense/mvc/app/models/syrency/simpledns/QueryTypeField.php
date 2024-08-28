<?php
namespace syrency\simpledns;

use OPNsense\Base\FieldTypes\OptionField;

class QueryTypeField extends OptionField
{
    public function __construct($ref = null, $tagname = null)
    {
      parent::__construct($ref, $tagname);
      $this->setOptionValues(array('A', 'AAAA', 'CNAME', 'MX', 'NS', 'DROP'));
      $this->setValidationMessage("Query type must be 'A', 'AAAA', 'CNAME', 'MX', 'NS', or 'DROP'")
    }
}
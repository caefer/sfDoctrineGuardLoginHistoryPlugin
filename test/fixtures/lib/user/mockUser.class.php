<?php

class mockUser
{
  public function setAttribute()
  {
  }

  public function getAttribute()
  {
    return 1;
  }

  public function getAttributeHolder()
  {
    return $this;
  }

  public function remove()
  {
  }

  public function getGuardUser()
  {
    return Doctrine_Core::getTable('sfGuardUser')->find(1);
  }
}

<?php

class HeartBeat extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function version()
  {
    return $this->_get_value("1");
  }
  function set_version($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ConnMeta extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function groupId()
  {
    return $this->_get_value("1");
  }
  function set_groupId($value)
  {
    return $this->_set_value("1", $value);
  }
  function secretKey()
  {
    return $this->_get_value("2");
  }
  function set_secretKey($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ConnAuthAck extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBBool";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function status()
  {
    return $this->_get_value("1");
  }
  function set_status($value)
  {
    return $this->_set_value("1", $value);
  }
  function feedback()
  {
    return $this->_get_value("2");
  }
  function set_feedback($value)
  {
    return $this->_set_value("2", $value);
  }
}
class MessageStoreAck extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBBool";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function messageId()
  {
    return $this->_get_value("1");
  }
  function set_messageId($value)
  {
    return $this->_set_value("1", $value);
  }
  function status()
  {
    return $this->_get_value("2");
  }
  function set_status($value)
  {
    return $this->_set_value("2", $value);
  }
  function feedback()
  {
    return $this->_get_value("3");
  }
  function set_feedback($value)
  {
    return $this->_set_value("3", $value);
  }
}
class DeliverAck extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBBool";
    $this->values["5"] = "";
  }
  function messageId()
  {
    return $this->_get_value("1");
  }
  function set_messageId($value)
  {
    return $this->_set_value("1", $value);
  }
  function topic()
  {
    return $this->_get_value("2");
  }
  function set_topic($value)
  {
    return $this->_set_value("2", $value);
  }
  function messageType()
  {
    return $this->_get_value("3");
  }
  function set_messageType($value)
  {
    return $this->_set_value("3", $value);
  }
  function groupId()
  {
    return $this->_get_value("4");
  }
  function set_groupId($value)
  {
    return $this->_set_value("4", $value);
  }
  function status()
  {
    return $this->_get_value("5");
  }
  function set_status($value)
  {
    return $this->_set_value("5", $value);
  }
}
class TxACKPacket extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
  }
  function messageId()
  {
    return $this->_get_value("1");
  }
  function set_messageId($value)
  {
    return $this->_set_value("1", $value);
  }
  function topic()
  {
    return $this->_get_value("2");
  }
  function set_topic($value)
  {
    return $this->_set_value("2", $value);
  }
  function messageType()
  {
    return $this->_get_value("3");
  }
  function set_messageType($value)
  {
    return $this->_set_value("3", $value);
  }
  function status()
  {
    return $this->_get_value("4");
  }
  function set_status($value)
  {
    return $this->_set_value("4", $value);
  }
  function feedback()
  {
    return $this->_get_value("5");
  }
  function set_feedback($value)
  {
    return $this->_set_value("5", $value);
  }
}
class Header extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBBool";
    $this->values["7"] = "";
    $this->fields["8"] = "PBBool";
    $this->values["8"] = "";
  }
  function messageId()
  {
    return $this->_get_value("1");
  }
  function set_messageId($value)
  {
    return $this->_set_value("1", $value);
  }
  function topic()
  {
    return $this->_get_value("2");
  }
  function set_topic($value)
  {
    return $this->_set_value("2", $value);
  }
  function messageType()
  {
    return $this->_get_value("3");
  }
  function set_messageType($value)
  {
    return $this->_set_value("3", $value);
  }
  function expiredTime()
  {
    return $this->_get_value("4");
  }
  function set_expiredTime($value)
  {
    return $this->_set_value("4", $value);
  }
  function deliverLimit()
  {
    return $this->_get_value("5");
  }
  function set_deliverLimit($value)
  {
    return $this->_set_value("5", $value);
  }
  function groupId()
  {
    return $this->_get_value("6");
  }
  function set_groupId($value)
  {
    return $this->_set_value("6", $value);
  }
  function commit()
  {
    return $this->_get_value("7");
  }
  function set_commit($value)
  {
    return $this->_set_value("7", $value);
  }
  function fly()
  {
    return $this->_get_value("8");
  }
  function set_fly($value)
  {
    return $this->_set_value("8", $value);
  }
}
class BytesMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "Header";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function header()
  {
    return $this->_get_value("1");
  }
  function set_header($value)
  {
    return $this->_set_value("1", $value);
  }
  function body()
  {
    return $this->_get_value("2");
  }
  function set_body($value)
  {
    return $this->_set_value("2", $value);
  }
}
class StringMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "Header";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function header()
  {
    return $this->_get_value("1");
  }
  function set_header($value)
  {
    return $this->_set_value("1", $value);
  }
  function body()
  {
    return $this->_get_value("2");
  }
  function set_body($value)
  {
    return $this->_set_value("2", $value);
  }
}
?>
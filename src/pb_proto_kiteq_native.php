<?php
/**
 * Auto generated from kiteq.proto at 2015-03-11 17:32:53
 */

/**
 * HeartBeat message
 */
class HeartBeat extends \ProtobufMessage
{
    /* Field index constants */
    const VERSION = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::VERSION => array(
            'name' => 'version',
            'required' => true,
            'type' => 5,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::VERSION] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'version' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setVersion($value)
    {
        return $this->set(self::VERSION, $value);
    }

    /**
     * Returns value of 'version' property
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->get(self::VERSION);
    }
}

/**
 * ConnMeta message
 */
class ConnMeta extends \ProtobufMessage
{
    /* Field index constants */
    const GROUPID = 1;
    const SECRETKEY = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GROUPID => array(
            'name' => 'groupId',
            'required' => true,
            'type' => 7,
        ),
        self::SECRETKEY => array(
            'name' => 'secretKey',
            'required' => true,
            'type' => 7,
        ),
    );

	public function __call($m, $arg) {
		$arr = explode('_', $m);
		$m = $arr[0].ucfirst($arr[1]);
		$this->$m($arg[0]);
	}

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::GROUPID] = null;
        $this->values[self::SECRETKEY] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'groupId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGroupId($value)
    {
        return $this->set(self::GROUPID, $value);
    }

    /**
     * Returns value of 'groupId' property
     *
     * @return string
     */
    public function getGroupId()
    {
        return $this->get(self::GROUPID);
    }

    /**
     * Sets value of 'secretKey' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSecretKey($value)
    {
        return $this->set(self::SECRETKEY, $value);
    }

    /**
     * Returns value of 'secretKey' property
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->get(self::SECRETKEY);
    }
}

/**
 * ConnAuthAck message
 */
class ConnAuthAck extends \ProtobufMessage
{
    /* Field index constants */
    const STATUS = 1;
    const FEEDBACK = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STATUS => array(
            'default' => true, 
            'name' => 'status',
            'required' => true,
            'type' => 8,
        ),
        self::FEEDBACK => array(
            'name' => 'feedback',
            'required' => true,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

	public function __call($m, $arg) {
		$arr = explode('_', $m);
		$m = $arr[0].ucfirst($arr[1]);
		$this->$m($arg[0]);
	}

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::STATUS] = null;
        $this->values[self::FEEDBACK] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'status' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setStatus($value)
    {
        return $this->set(self::STATUS, $value);
    }

    /**
     * Returns value of 'status' property
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->get(self::STATUS);
    }

    /**
     * Sets value of 'feedback' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setFeedback($value)
    {
        return $this->set(self::FEEDBACK, $value);
    }

    /**
     * Returns value of 'feedback' property
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->get(self::FEEDBACK);
    }
}

/**
 * MessageStoreAck message
 */
class MessageStoreAck extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGEID = 1;
    const STATUS = 2;
    const FEEDBACK = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGEID => array(
            'name' => 'messageId',
            'required' => true,
            'type' => 7,
        ),
        self::STATUS => array(
            'default' => true, 
            'name' => 'status',
            'required' => true,
            'type' => 8,
        ),
        self::FEEDBACK => array(
            'name' => 'feedback',
            'required' => true,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

	public function __call($m, $arg) {
		$arr = explode('_', $m);
		$m = $arr[0].ucfirst($arr[1]);
		$this->$m($arg[0]);
	}

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MESSAGEID] = null;
        $this->values[self::STATUS] = null;
        $this->values[self::FEEDBACK] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'messageId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageId($value)
    {
        return $this->set(self::MESSAGEID, $value);
    }

    /**
     * Returns value of 'messageId' property
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->get(self::MESSAGEID);
    }

    /**
     * Sets value of 'status' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setStatus($value)
    {
        return $this->set(self::STATUS, $value);
    }

    /**
     * Returns value of 'status' property
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->get(self::STATUS);
    }

    /**
     * Sets value of 'feedback' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setFeedback($value)
    {
        return $this->set(self::FEEDBACK, $value);
    }

    /**
     * Returns value of 'feedback' property
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->get(self::FEEDBACK);
    }
}

/**
 * DeliverAck message
 */
class DeliverAck extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGEID = 1;
    const TOPIC = 2;
    const MESSAGETYPE = 3;
    const GROUPID = 4;
    const STATUS = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGEID => array(
            'name' => 'messageId',
            'required' => true,
            'type' => 7,
        ),
        self::TOPIC => array(
            'name' => 'topic',
            'required' => true,
            'type' => 7,
        ),
        self::MESSAGETYPE => array(
            'name' => 'messageType',
            'required' => true,
            'type' => 7,
        ),
        self::GROUPID => array(
            'name' => 'groupId',
            'required' => true,
            'type' => 7,
        ),
        self::STATUS => array(
            'default' => true, 
            'name' => 'status',
            'required' => true,
            'type' => 8,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MESSAGEID] = null;
        $this->values[self::TOPIC] = null;
        $this->values[self::MESSAGETYPE] = null;
        $this->values[self::GROUPID] = null;
        $this->values[self::STATUS] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'messageId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageId($value)
    {
        return $this->set(self::MESSAGEID, $value);
    }

    /**
     * Returns value of 'messageId' property
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->get(self::MESSAGEID);
    }

    /**
     * Sets value of 'topic' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTopic($value)
    {
        return $this->set(self::TOPIC, $value);
    }

    /**
     * Returns value of 'topic' property
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->get(self::TOPIC);
    }

    /**
     * Sets value of 'messageType' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageType($value)
    {
        return $this->set(self::MESSAGETYPE, $value);
    }

    /**
     * Returns value of 'messageType' property
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->get(self::MESSAGETYPE);
    }

    /**
     * Sets value of 'groupId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGroupId($value)
    {
        return $this->set(self::GROUPID, $value);
    }

    /**
     * Returns value of 'groupId' property
     *
     * @return string
     */
    public function getGroupId()
    {
        return $this->get(self::GROUPID);
    }

    /**
     * Sets value of 'status' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setStatus($value)
    {
        return $this->set(self::STATUS, $value);
    }

    /**
     * Returns value of 'status' property
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->get(self::STATUS);
    }
}

/**
 * TxACKPacket message
 */
class TxACKPacket extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGEID = 1;
    const TOPIC = 2;
    const MESSAGETYPE = 3;
    const STATUS = 4;
    const FEEDBACK = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGEID => array(
            'name' => 'messageId',
            'required' => true,
            'type' => 7,
        ),
        self::TOPIC => array(
            'name' => 'topic',
            'required' => true,
            'type' => 7,
        ),
        self::MESSAGETYPE => array(
            'name' => 'messageType',
            'required' => true,
            'type' => 7,
        ),
        self::STATUS => array(
            'default' => 0, 
            'name' => 'status',
            'required' => true,
            'type' => 5,
        ),
        self::FEEDBACK => array(
            'name' => 'feedback',
            'required' => true,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MESSAGEID] = null;
        $this->values[self::TOPIC] = null;
        $this->values[self::MESSAGETYPE] = null;
        $this->values[self::STATUS] = null;
        $this->values[self::FEEDBACK] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'messageId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageId($value)
    {
        return $this->set(self::MESSAGEID, $value);
    }

    /**
     * Returns value of 'messageId' property
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->get(self::MESSAGEID);
    }

    /**
     * Sets value of 'topic' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTopic($value)
    {
        return $this->set(self::TOPIC, $value);
    }

    /**
     * Returns value of 'topic' property
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->get(self::TOPIC);
    }

    /**
     * Sets value of 'messageType' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageType($value)
    {
        return $this->set(self::MESSAGETYPE, $value);
    }

    /**
     * Returns value of 'messageType' property
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->get(self::MESSAGETYPE);
    }

    /**
     * Sets value of 'status' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setStatus($value)
    {
        return $this->set(self::STATUS, $value);
    }

    /**
     * Returns value of 'status' property
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->get(self::STATUS);
    }

    /**
     * Sets value of 'feedback' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setFeedback($value)
    {
        return $this->set(self::FEEDBACK, $value);
    }

    /**
     * Returns value of 'feedback' property
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->get(self::FEEDBACK);
    }
}

/**
 * Header message
 */
class Header extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGEID = 1;
    const TOPIC = 2;
    const MESSAGETYPE = 3;
    const EXPIREDTIME = 4;
    const DELIVERLIMIT = 5;
    const GROUPID = 6;
    const COMMIT = 7;
    const FLY = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGEID => array(
            'name' => 'messageId',
            'required' => true,
            'type' => 7,
        ),
        self::TOPIC => array(
            'name' => 'topic',
            'required' => true,
            'type' => 7,
        ),
        self::MESSAGETYPE => array(
            'name' => 'messageType',
            'required' => true,
            'type' => 7,
        ),
        self::EXPIREDTIME => array(
            'default' => -1, 
            'name' => 'expiredTime',
            'required' => true,
            'type' => 5,
        ),
        self::DELIVERLIMIT => array(
            'default' => 100, 
            'name' => 'deliverLimit',
            'required' => true,
            'type' => 5,
        ),
        self::GROUPID => array(
            'name' => 'groupId',
            'required' => true,
            'type' => 7,
        ),
        self::COMMIT => array(
            'name' => 'commit',
            'required' => true,
            'type' => 8,
        ),
        self::FLY => array(
            'default' => true, 
            'name' => 'fly',
            'required' => true,
            'type' => 8,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

	public function __call($m, $arg) {
		$arr = explode('_', $m);
		$m = $arr[0].ucfirst($arr[1]);
		$this->$m($arg[0]);
	}

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MESSAGEID] = null;
        $this->values[self::TOPIC] = null;
        $this->values[self::MESSAGETYPE] = null;
        $this->values[self::EXPIREDTIME] = null;
        $this->values[self::DELIVERLIMIT] = null;
        $this->values[self::GROUPID] = null;
        $this->values[self::COMMIT] = null;
        $this->values[self::FLY] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'messageId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageId($value)
    {
        return $this->set(self::MESSAGEID, $value);
    }

    /**
     * Returns value of 'messageId' property
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->get(self::MESSAGEID);
    }

    /**
     * Sets value of 'topic' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTopic($value)
    {
        return $this->set(self::TOPIC, $value);
    }

    /**
     * Returns value of 'topic' property
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->get(self::TOPIC);
    }

    /**
     * Sets value of 'messageType' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMessageType($value)
    {
        return $this->set(self::MESSAGETYPE, $value);
    }

    /**
     * Returns value of 'messageType' property
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->get(self::MESSAGETYPE);
    }

    /**
     * Sets value of 'expiredTime' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setExpiredTime($value)
    {
        return $this->set(self::EXPIREDTIME, $value);
    }

    /**
     * Returns value of 'expiredTime' property
     *
     * @return int
     */
    public function getExpiredTime()
    {
        return $this->get(self::EXPIREDTIME);
    }

    /**
     * Sets value of 'deliverLimit' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setDeliverLimit($value)
    {
        return $this->set(self::DELIVERLIMIT, $value);
    }

    /**
     * Returns value of 'deliverLimit' property
     *
     * @return int
     */
    public function getDeliverLimit()
    {
        return $this->get(self::DELIVERLIMIT);
    }

    /**
     * Sets value of 'groupId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGroupId($value)
    {
        return $this->set(self::GROUPID, $value);
    }

    /**
     * Returns value of 'groupId' property
     *
     * @return string
     */
    public function getGroupId()
    {
        return $this->get(self::GROUPID);
    }

    /**
     * Sets value of 'commit' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setCommit($value)
    {
        return $this->set(self::COMMIT, $value);
    }

    /**
     * Returns value of 'commit' property
     *
     * @return bool
     */
    public function getCommit()
    {
        return $this->get(self::COMMIT);
    }

    /**
     * Sets value of 'fly' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setFly($value)
    {
        return $this->set(self::FLY, $value);
    }

    /**
     * Returns value of 'fly' property
     *
     * @return bool
     */
    public function getFly()
    {
        return $this->get(self::FLY);
    }
}

/**
 * BytesMessage message
 */
class BytesMessage extends \ProtobufMessage
{
    /* Field index constants */
    const HEADER = 1;
    const BODY = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::HEADER => array(
            'name' => 'header',
            'required' => true,
            'type' => 'Header'
        ),
        self::BODY => array(
            'name' => 'body',
            'required' => true,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::HEADER] = null;
        $this->values[self::BODY] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'header' property
     *
     * @param Header $value Property value
     *
     * @return null
     */
    public function setHeader(Header $value)
    {
        return $this->set(self::HEADER, $value);
    }

    /**
     * Returns value of 'header' property
     *
     * @return Header
     */
    public function getHeader()
    {
        return $this->get(self::HEADER);
    }

    /**
     * Sets value of 'body' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBody($value)
    {
        return $this->set(self::BODY, $value);
    }

    /**
     * Returns value of 'body' property
     *
     * @return string
     */
    public function getBody()
    {
        return $this->get(self::BODY);
    }
}

/**
 * StringMessage message
 */
class StringMessage extends \ProtobufMessage
{
    /* Field index constants */
    const HEADER = 1;
    const BODY = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::HEADER => array(
            'name' => 'header',
            'required' => true,
            'type' => 'Header'
        ),
        self::BODY => array(
            'name' => 'body',
            'required' => true,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

	public function __call($m, $arg) {
		$arr = explode('_', $m);
		$m = $arr[0].ucfirst($arr[1]);
		$this->$m($arg[0]);
	}

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::HEADER] = null;
        $this->values[self::BODY] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'header' property
     *
     * @param Header $value Property value
     *
     * @return null
     */
    public function setHeader(Header $value)
    {
        return $this->set(self::HEADER, $value);
    }

    /**
     * Returns value of 'header' property
     *
     * @return Header
     */
    public function getHeader()
    {
        return $this->get(self::HEADER);
    }

    /**
     * Sets value of 'body' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBody($value)
    {
        return $this->set(self::BODY, $value);
    }

    /**
     * Returns value of 'body' property
     *
     * @return string
     */
    public function getBody()
    {
        return $this->get(self::BODY);
    }
}

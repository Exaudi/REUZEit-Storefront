<?php
/**
 * PtsV2PayoutsPost201ResponseProcessorInformation
 *
 * PHP version 5
 *
 * @category Class
 * @package  CyberSource
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * CyberSource Merged Spec
 *
 * All CyberSource API specs merged together. These are available at https://developer.cybersource.com/api/reference/api-reference.html
 *
 * OpenAPI spec version: 0.0.1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace CyberSource\Model;

use \ArrayAccess;

/**
 * PtsV2PayoutsPost201ResponseProcessorInformation Class Doc Comment
 *
 * @category    Class
 * @package     CyberSource
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PtsV2PayoutsPost201ResponseProcessorInformation implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ptsV2PayoutsPost201Response_processorInformation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'approvalCode' => 'string',
        'responseCode' => 'string',
        'transactionId' => 'string',
        'systemTraceAuditNumber' => 'string',
        'responseCodeSource' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'approvalCode' => null,
        'responseCode' => null,
        'transactionId' => null,
        'systemTraceAuditNumber' => null,
        'responseCodeSource' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'approvalCode' => 'approvalCode',
        'responseCode' => 'responseCode',
        'transactionId' => 'transactionId',
        'systemTraceAuditNumber' => 'systemTraceAuditNumber',
        'responseCodeSource' => 'responseCodeSource'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'approvalCode' => 'setApprovalCode',
        'responseCode' => 'setResponseCode',
        'transactionId' => 'setTransactionId',
        'systemTraceAuditNumber' => 'setSystemTraceAuditNumber',
        'responseCodeSource' => 'setResponseCodeSource'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'approvalCode' => 'getApprovalCode',
        'responseCode' => 'getResponseCode',
        'transactionId' => 'getTransactionId',
        'systemTraceAuditNumber' => 'getSystemTraceAuditNumber',
        'responseCodeSource' => 'getResponseCodeSource'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['approvalCode'] = isset($data['approvalCode']) ? $data['approvalCode'] : null;
        $this->container['responseCode'] = isset($data['responseCode']) ? $data['responseCode'] : null;
        $this->container['transactionId'] = isset($data['transactionId']) ? $data['transactionId'] : null;
        $this->container['systemTraceAuditNumber'] = isset($data['systemTraceAuditNumber']) ? $data['systemTraceAuditNumber'] : null;
        $this->container['responseCodeSource'] = isset($data['responseCodeSource']) ? $data['responseCodeSource'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['approvalCode']) && (strlen($this->container['approvalCode']) > 6)) {
            $invalid_properties[] = "invalid value for 'approvalCode', the character length must be smaller than or equal to 6.";
        }

        if (!is_null($this->container['responseCode']) && (strlen($this->container['responseCode']) > 10)) {
            $invalid_properties[] = "invalid value for 'responseCode', the character length must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['transactionId']) && (strlen($this->container['transactionId']) > 15)) {
            $invalid_properties[] = "invalid value for 'transactionId', the character length must be smaller than or equal to 15.";
        }

        if (!is_null($this->container['systemTraceAuditNumber']) && (strlen($this->container['systemTraceAuditNumber']) > 6)) {
            $invalid_properties[] = "invalid value for 'systemTraceAuditNumber', the character length must be smaller than or equal to 6.";
        }

        if (!is_null($this->container['responseCodeSource']) && (strlen($this->container['responseCodeSource']) > 1)) {
            $invalid_properties[] = "invalid value for 'responseCodeSource', the character length must be smaller than or equal to 1.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if (strlen($this->container['approvalCode']) > 6) {
            return false;
        }
        if (strlen($this->container['responseCode']) > 10) {
            return false;
        }
        if (strlen($this->container['transactionId']) > 15) {
            return false;
        }
        if (strlen($this->container['systemTraceAuditNumber']) > 6) {
            return false;
        }
        if (strlen($this->container['responseCodeSource']) > 1) {
            return false;
        }
        return true;
    }


    /**
     * Gets approvalCode
     * @return string
     */
    public function getApprovalCode()
    {
        return $this->container['approvalCode'];
    }

    /**
     * Sets approvalCode
     * @param string $approvalCode Issuer-generated approval code for the transaction.
     * @return $this
     */
    public function setApprovalCode($approvalCode)
    {
        if (!is_null($approvalCode) && (strlen($approvalCode) > 6)) {
            throw new \InvalidArgumentException('invalid length for $approvalCode when calling PtsV2PayoutsPost201ResponseProcessorInformation., must be smaller than or equal to 6.');
        }

        $this->container['approvalCode'] = $approvalCode;

        return $this;
    }

    /**
     * Gets responseCode
     * @return string
     */
    public function getResponseCode()
    {
        return $this->container['responseCode'];
    }

    /**
     * Sets responseCode
     * @param string $responseCode Transaction status from the processor.
     * @return $this
     */
    public function setResponseCode($responseCode)
    {
        if (!is_null($responseCode) && (strlen($responseCode) > 10)) {
            throw new \InvalidArgumentException('invalid length for $responseCode when calling PtsV2PayoutsPost201ResponseProcessorInformation., must be smaller than or equal to 10.');
        }

        $this->container['responseCode'] = $responseCode;

        return $this;
    }

    /**
     * Gets transactionId
     * @return string
     */
    public function getTransactionId()
    {
        return $this->container['transactionId'];
    }

    /**
     * Sets transactionId
     * @param string $transactionId Network transaction identifier (TID). This value can be used to identify a specific transaction when you are discussing the transaction with your processor.
     * @return $this
     */
    public function setTransactionId($transactionId)
    {
        if (!is_null($transactionId) && (strlen($transactionId) > 15)) {
            throw new \InvalidArgumentException('invalid length for $transactionId when calling PtsV2PayoutsPost201ResponseProcessorInformation., must be smaller than or equal to 15.');
        }

        $this->container['transactionId'] = $transactionId;

        return $this;
    }

    /**
     * Gets systemTraceAuditNumber
     * @return string
     */
    public function getSystemTraceAuditNumber()
    {
        return $this->container['systemTraceAuditNumber'];
    }

    /**
     * Sets systemTraceAuditNumber
     * @param string $systemTraceAuditNumber This field is returned only for **American Express Direct** and **Visa Platform Connect**.  #### American Express Direct  System trace audit number (STAN). This value identifies the transaction and is useful when investigating a chargeback dispute.  #### Visa Platform Connect  System trace number that must be printed on the customer’s receipt.  For details, see `receipt_number` field description in [Credit Card Services Using the SCMP API.](https://apps.cybersource.com/library/documentation/dev_guides/CC_Svcs_SCMP_API/html/wwhelp/wwhimpl/js/html/wwhelp.htm)
     * @return $this
     */
    public function setSystemTraceAuditNumber($systemTraceAuditNumber)
    {
        if (!is_null($systemTraceAuditNumber) && (strlen($systemTraceAuditNumber) > 6)) {
            throw new \InvalidArgumentException('invalid length for $systemTraceAuditNumber when calling PtsV2PayoutsPost201ResponseProcessorInformation., must be smaller than or equal to 6.');
        }

        $this->container['systemTraceAuditNumber'] = $systemTraceAuditNumber;

        return $this;
    }

    /**
     * Gets responseCodeSource
     * @return string
     */
    public function getResponseCodeSource()
    {
        return $this->container['responseCodeSource'];
    }

    /**
     * Sets responseCodeSource
     * @param string $responseCodeSource Used by Visa only and contains the response source/reason code that identifies the source of the response decision.
     * @return $this
     */
    public function setResponseCodeSource($responseCodeSource)
    {
        if (!is_null($responseCodeSource) && (strlen($responseCodeSource) > 1)) {
            throw new \InvalidArgumentException('invalid length for $responseCodeSource when calling PtsV2PayoutsPost201ResponseProcessorInformation., must be smaller than or equal to 1.');
        }

        $this->container['responseCodeSource'] = $responseCodeSource;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\CyberSource\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\CyberSource\ObjectSerializer::sanitizeForSerialization($this));
    }
}



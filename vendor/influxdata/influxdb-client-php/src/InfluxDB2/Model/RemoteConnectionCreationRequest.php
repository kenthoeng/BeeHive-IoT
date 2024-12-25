<?php
/**
 * RemoteConnectionCreationRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * InfluxDB OSS API Service
 *
 * The InfluxDB v2 API provides a programmatic interface for all interactions with InfluxDB. Access the InfluxDB API using the `/api/v2/` endpoint.
 *
 * OpenAPI spec version: 2.0.0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 3.3.4
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace InfluxDB2\Model;

use \ArrayAccess;
use \InfluxDB2\ObjectSerializer;

/**
 * RemoteConnectionCreationRequest Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class RemoteConnectionCreationRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'RemoteConnectionCreationRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'description' => 'string',
        'org_id' => 'string',
        'remote_url' => 'string',
        'remote_api_token' => 'string',
        'remote_org_id' => 'string',
        'allow_insecure_tls' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'name' => null,
        'description' => null,
        'org_id' => null,
        'remote_url' => 'uri',
        'remote_api_token' => null,
        'remote_org_id' => null,
        'allow_insecure_tls' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'name' => 'name',
        'description' => 'description',
        'org_id' => 'orgID',
        'remote_url' => 'remoteURL',
        'remote_api_token' => 'remoteAPIToken',
        'remote_org_id' => 'remoteOrgID',
        'allow_insecure_tls' => 'allowInsecureTLS'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'description' => 'setDescription',
        'org_id' => 'setOrgId',
        'remote_url' => 'setRemoteUrl',
        'remote_api_token' => 'setRemoteApiToken',
        'remote_org_id' => 'setRemoteOrgId',
        'allow_insecure_tls' => 'setAllowInsecureTls'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'description' => 'getDescription',
        'org_id' => 'getOrgId',
        'remote_url' => 'getRemoteUrl',
        'remote_api_token' => 'getRemoteApiToken',
        'remote_org_id' => 'getRemoteOrgId',
        'allow_insecure_tls' => 'getAllowInsecureTls'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['org_id'] = isset($data['org_id']) ? $data['org_id'] : null;
        $this->container['remote_url'] = isset($data['remote_url']) ? $data['remote_url'] : null;
        $this->container['remote_api_token'] = isset($data['remote_api_token']) ? $data['remote_api_token'] : null;
        $this->container['remote_org_id'] = isset($data['remote_org_id']) ? $data['remote_org_id'] : null;
        $this->container['allow_insecure_tls'] = isset($data['allow_insecure_tls']) ? $data['allow_insecure_tls'] : false;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['org_id'] === null) {
            $invalidProperties[] = "'org_id' can't be null";
        }
        if ($this->container['remote_url'] === null) {
            $invalidProperties[] = "'remote_url' can't be null";
        }
        if ($this->container['remote_api_token'] === null) {
            $invalidProperties[] = "'remote_api_token' can't be null";
        }
        if ($this->container['remote_org_id'] === null) {
            $invalidProperties[] = "'remote_org_id' can't be null";
        }
        if ($this->container['allow_insecure_tls'] === null) {
            $invalidProperties[] = "'allow_insecure_tls' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets org_id
     *
     * @return string
     */
    public function getOrgId()
    {
        return $this->container['org_id'];
    }

    /**
     * Sets org_id
     *
     * @param string $org_id org_id
     *
     * @return $this
     */
    public function setOrgId($org_id)
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets remote_url
     *
     * @return string
     */
    public function getRemoteUrl()
    {
        return $this->container['remote_url'];
    }

    /**
     * Sets remote_url
     *
     * @param string $remote_url remote_url
     *
     * @return $this
     */
    public function setRemoteUrl($remote_url)
    {
        $this->container['remote_url'] = $remote_url;

        return $this;
    }

    /**
     * Gets remote_api_token
     *
     * @return string
     */
    public function getRemoteApiToken()
    {
        return $this->container['remote_api_token'];
    }

    /**
     * Sets remote_api_token
     *
     * @param string $remote_api_token remote_api_token
     *
     * @return $this
     */
    public function setRemoteApiToken($remote_api_token)
    {
        $this->container['remote_api_token'] = $remote_api_token;

        return $this;
    }

    /**
     * Gets remote_org_id
     *
     * @return string
     */
    public function getRemoteOrgId()
    {
        return $this->container['remote_org_id'];
    }

    /**
     * Sets remote_org_id
     *
     * @param string $remote_org_id remote_org_id
     *
     * @return $this
     */
    public function setRemoteOrgId($remote_org_id)
    {
        $this->container['remote_org_id'] = $remote_org_id;

        return $this;
    }

    /**
     * Gets allow_insecure_tls
     *
     * @return bool
     */
    public function getAllowInsecureTls()
    {
        return $this->container['allow_insecure_tls'];
    }

    /**
     * Sets allow_insecure_tls
     *
     * @param bool $allow_insecure_tls allow_insecure_tls
     *
     * @return $this
     */
    public function setAllowInsecureTls($allow_insecure_tls)
    {
        $this->container['allow_insecure_tls'] = $allow_insecure_tls;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


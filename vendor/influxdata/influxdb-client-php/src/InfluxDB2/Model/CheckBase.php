<?php
/**
 * CheckBase
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
 * CheckBase Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class CheckBase implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CheckBase';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'org_id' => 'string',
        'task_id' => 'string',
        'owner_id' => 'string',
        'created_at' => '\DateTime',
        'updated_at' => '\DateTime',
        'query' => '\InfluxDB2\Model\DashboardQuery',
        'status' => '\InfluxDB2\Model\TaskStatusType',
        'description' => 'string',
        'latest_completed' => '\DateTime',
        'last_run_status' => 'string',
        'last_run_error' => 'string',
        'labels' => '\InfluxDB2\Model\Label[]',
        'links' => '\InfluxDB2\Model\CheckBaseLinks'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'org_id' => null,
        'task_id' => null,
        'owner_id' => null,
        'created_at' => 'date-time',
        'updated_at' => 'date-time',
        'query' => null,
        'status' => null,
        'description' => null,
        'latest_completed' => 'date-time',
        'last_run_status' => null,
        'last_run_error' => null,
        'labels' => null,
        'links' => null
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
        'id' => 'id',
        'name' => 'name',
        'org_id' => 'orgID',
        'task_id' => 'taskID',
        'owner_id' => 'ownerID',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'query' => 'query',
        'status' => 'status',
        'description' => 'description',
        'latest_completed' => 'latestCompleted',
        'last_run_status' => 'lastRunStatus',
        'last_run_error' => 'lastRunError',
        'labels' => 'labels',
        'links' => 'links'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'org_id' => 'setOrgId',
        'task_id' => 'setTaskId',
        'owner_id' => 'setOwnerId',
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt',
        'query' => 'setQuery',
        'status' => 'setStatus',
        'description' => 'setDescription',
        'latest_completed' => 'setLatestCompleted',
        'last_run_status' => 'setLastRunStatus',
        'last_run_error' => 'setLastRunError',
        'labels' => 'setLabels',
        'links' => 'setLinks'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'org_id' => 'getOrgId',
        'task_id' => 'getTaskId',
        'owner_id' => 'getOwnerId',
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt',
        'query' => 'getQuery',
        'status' => 'getStatus',
        'description' => 'getDescription',
        'latest_completed' => 'getLatestCompleted',
        'last_run_status' => 'getLastRunStatus',
        'last_run_error' => 'getLastRunError',
        'labels' => 'getLabels',
        'links' => 'getLinks'
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

    const LAST_RUN_STATUS_FAILED = 'failed';
    const LAST_RUN_STATUS_SUCCESS = 'success';
    const LAST_RUN_STATUS_CANCELED = 'canceled';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLastRunStatusAllowableValues()
    {
        return [
            self::LAST_RUN_STATUS_FAILED,
            self::LAST_RUN_STATUS_SUCCESS,
            self::LAST_RUN_STATUS_CANCELED,
        ];
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['org_id'] = isset($data['org_id']) ? $data['org_id'] : null;
        $this->container['task_id'] = isset($data['task_id']) ? $data['task_id'] : null;
        $this->container['owner_id'] = isset($data['owner_id']) ? $data['owner_id'] : null;
        $this->container['created_at'] = isset($data['created_at']) ? $data['created_at'] : null;
        $this->container['updated_at'] = isset($data['updated_at']) ? $data['updated_at'] : null;
        $this->container['query'] = isset($data['query']) ? $data['query'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['latest_completed'] = isset($data['latest_completed']) ? $data['latest_completed'] : null;
        $this->container['last_run_status'] = isset($data['last_run_status']) ? $data['last_run_status'] : null;
        $this->container['last_run_error'] = isset($data['last_run_error']) ? $data['last_run_error'] : null;
        $this->container['labels'] = isset($data['labels']) ? $data['labels'] : null;
        $this->container['links'] = isset($data['links']) ? $data['links'] : null;
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
        if ($this->container['query'] === null) {
            $invalidProperties[] = "'query' can't be null";
        }
        $allowedValues = $this->getLastRunStatusAllowableValues();
        if (!is_null($this->container['last_run_status']) && !in_array($this->container['last_run_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'last_run_status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
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
     * @param string $org_id The ID of the organization that owns this check.
     *
     * @return $this
     */
    public function setOrgId($org_id)
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets task_id
     *
     * @return string|null
     */
    public function getTaskId()
    {
        return $this->container['task_id'];
    }

    /**
     * Sets task_id
     *
     * @param string|null $task_id The ID of the task associated with this check.
     *
     * @return $this
     */
    public function setTaskId($task_id)
    {
        $this->container['task_id'] = $task_id;

        return $this;
    }

    /**
     * Gets owner_id
     *
     * @return string|null
     */
    public function getOwnerId()
    {
        return $this->container['owner_id'];
    }

    /**
     * Sets owner_id
     *
     * @param string|null $owner_id The ID of creator used to create this check.
     *
     * @return $this
     */
    public function setOwnerId($owner_id)
    {
        $this->container['owner_id'] = $owner_id;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime|null $created_at created_at
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param \DateTime|null $updated_at updated_at
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->container['updated_at'] = $updated_at;

        return $this;
    }

    /**
     * Gets query
     *
     * @return \InfluxDB2\Model\DashboardQuery
     */
    public function getQuery()
    {
        return $this->container['query'];
    }

    /**
     * Sets query
     *
     * @param \InfluxDB2\Model\DashboardQuery $query query
     *
     * @return $this
     */
    public function setQuery($query)
    {
        $this->container['query'] = $query;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \InfluxDB2\Model\TaskStatusType|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \InfluxDB2\Model\TaskStatusType|null $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

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
     * @param string|null $description An optional description of the check.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets latest_completed
     *
     * @return \DateTime|null
     */
    public function getLatestCompleted()
    {
        return $this->container['latest_completed'];
    }

    /**
     * Sets latest_completed
     *
     * @param \DateTime|null $latest_completed A timestamp ([RFC3339 date/time format](https://docs.influxdata.com/influxdb/v2.3/reference/glossary/#rfc3339-timestamp)) of the latest scheduled and completed run.
     *
     * @return $this
     */
    public function setLatestCompleted($latest_completed)
    {
        $this->container['latest_completed'] = $latest_completed;

        return $this;
    }

    /**
     * Gets last_run_status
     *
     * @return string|null
     */
    public function getLastRunStatus()
    {
        return $this->container['last_run_status'];
    }

    /**
     * Sets last_run_status
     *
     * @param string|null $last_run_status last_run_status
     *
     * @return $this
     */
    public function setLastRunStatus($last_run_status)
    {
        $allowedValues = $this->getLastRunStatusAllowableValues();
        if (!is_null($last_run_status) && !in_array($last_run_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'last_run_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['last_run_status'] = $last_run_status;

        return $this;
    }

    /**
     * Gets last_run_error
     *
     * @return string|null
     */
    public function getLastRunError()
    {
        return $this->container['last_run_error'];
    }

    /**
     * Sets last_run_error
     *
     * @param string|null $last_run_error last_run_error
     *
     * @return $this
     */
    public function setLastRunError($last_run_error)
    {
        $this->container['last_run_error'] = $last_run_error;

        return $this;
    }

    /**
     * Gets labels
     *
     * @return \InfluxDB2\Model\Label[]|null
     */
    public function getLabels()
    {
        return $this->container['labels'];
    }

    /**
     * Sets labels
     *
     * @param \InfluxDB2\Model\Label[]|null $labels labels
     *
     * @return $this
     */
    public function setLabels($labels)
    {
        $this->container['labels'] = $labels;

        return $this;
    }

    /**
     * Gets links
     *
     * @return \InfluxDB2\Model\CheckBaseLinks|null
     */
    public function getLinks()
    {
        return $this->container['links'];
    }

    /**
     * Sets links
     *
     * @param \InfluxDB2\Model\CheckBaseLinks|null $links links
     *
     * @return $this
     */
    public function setLinks($links)
    {
        $this->container['links'] = $links;

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



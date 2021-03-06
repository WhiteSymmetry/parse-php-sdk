<?php

namespace Parse;

/**
 * ParsePushStatus - Representation of PushStatus for push notifications
 *
 * @author Ben Friedman <ben@axolsoft.com>
 */
class ParsePushStatus extends ParseObject
{
    public static $parseClassName = '_PushStatus';

    /**
     * Returns a push status object or null from an id
     *
     * @param string $id    Id to get this push status by
     * @return ParsePushStatus|null
     */
    public static function getFromId($id)
    {
        try {
            // return the associated PushStatus object
            $query = new ParseQuery(self::$parseClassName);
            return $query->get($id, true);

        } catch (ParseException $pe) {
            // no push found
            return null;

        }

    }

    /**
     * Gets the time this push was sent at
     *
     * @return \DateTime
     */
    public function getPushTime()
    {
        return new \DateTime($this->get("pushTime"));

    }

    /**
     * Gets the query used to send this push
     *
     * @return ParseQuery
     */
    public function getPushQuery()
    {
        $query = $this->get("query");

        // get the conditions
        $queryConditions = json_decode($query, true);

        // setup a query
        $query = new ParseQuery(self::$parseClassName);

        // set the conditions
        $query->_setConditions($queryConditions);

        return $query;

    }

    /**
     * Gets the payload
     *
     * @return array
     */
    public function getPushPayload()
    {
        return json_decode($this->get("payload"), true);

    }

    /**
     * Gets the source of this push
     *
     * @return string
     */
    public function getPushSource()
    {
        return $this->get("source");

    }

    /**
     * Gets the status of this push
     *
     * @return string
     */
    public function getPushStatus()
    {
        return $this->get("status");

    }

    /**
     * Gets the number of pushes sent
     *
     * @return int
     */
    public function getPushesSent()
    {
        return $this->get("numSent");

    }

    /**
     * Gets the hash for this push
     *
     * @return string
     */
    public function getPushHash()
    {
        return $this->get("pushHash");

    }

    /**
     * Gets the number of pushes failed
     *
     * @return int
     */
    public function getPushesFailed()
    {
        return $this->get("numFailed");

    }
}
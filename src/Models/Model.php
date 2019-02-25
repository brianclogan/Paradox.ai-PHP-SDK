<?php

namespace darkgoldblade01\Paradox\Olivia\Models;

class Model {

    protected $create_required_fields = [];

    protected $update_required_fields = [];

    /**
     * Model constructor.
     *
     * @param null $information
     */
    public function __construct($information = null)
    {
        if($information) {
            $this->fill($information);
        }
    }

    /**
     * Fill
     *
     * Fill the class with the
     * fields that are required.
     *
     * @param $information
     * @return $this
     */
    protected function fill($information) {
        foreach($information AS $key => $val) {
            $this->{$key} = $val;
        }
        return $this;
    }

    /**
     * To Array
     *
     * Returns the current object
     * as an array.
     *
     * @return array
     */
    public function to_array()
    {
        return (array) $this;
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->{$key};
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->{$key} = $value;
    }

    /**
     * Can Create
     *
     * Checks to see if the
     * required fields are
     * set.
     *
     * @throws \Exception
     */
    public function can_create() {
        foreach($this->create_required_fields AS $required) {
            if(strpos($required, '|') !== false) {
                $either = explode('|', $required);
                $okay = false;
                foreach($either AS $item) {
                    if(isset($this->{$item})) {
                        $okay = true;
                    }
                }
                if(!$okay) {
                    throw new \Exception('Either ' . implode(' or ', $either) . ' are required to create a ' . get_class($this) . '.');
                }
            } else {
                if (!isset($this->{$required})) {
                    throw new \Exception(ucfirst($required) . ' is required to create a ' . get_class($this) . '.');
                }
            }
        }
    }

    /**
     * Can Update
     *
     * Checks to see if the
     * required fields are
     * set.
     *
     * @throws \Exception
     */
    public function can_update() {
        foreach($this->update_required_fields AS $required) {
            if(strpos($required, '|') !== false) {
                $either = explode('|', $required);
                $okay = false;
                foreach($either AS $item) {
                    if(isset($this->{$item})) {
                        $okay = true;
                    }
                }
                if(!$okay) {
                    throw new \Exception('Either ' . implode(' or ', $either) . ' are required to update a ' . get_class($this) . '.');
                }
            } else {
                if (!isset($this->{$required})) {
                    throw new \Exception(ucfirst($required) . ' is required to update a ' . get_class($this) . '.');
                }
            }
        }
    }
}
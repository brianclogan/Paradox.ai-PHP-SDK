<?php

namespace darkgoldblade01\Paradox\Olivia\Models;

class Candidate {

    public $stage = [];

    /**
     * Candidate constructor.
     *
     * @param null $candidate_information
     */
    public function __construct($candidate_information = null)
    {
        if($candidate_information) {
            $this->fill($candidate_information);
        }
    }

    /**
     * @param $candidate
     * @return $this
     */
    protected function fill($candidate) {
        $from_api = false;
        if(isset($candidate->candidate) && isset($candidate->stage)) {
            $from_api = true;
        }
        if($from_api) {
            if(isset($candidate->candidate)) {
                foreach($candidate->candidate AS $key => $val) {
                    $this->{$key} = $val;
                }
            }
            if(isset($candidate->stage)) {
                foreach($candidate->stage AS $key => $val) {
                    $this->stage[$key] = $val;
                }
            }
        } else {
            foreach($candidate AS $key => $val) {
                $this->{$key} = $val;
            }
        }
        return $this;
    }

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
}
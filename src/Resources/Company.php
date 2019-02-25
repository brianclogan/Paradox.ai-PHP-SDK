<?php
namespace darkgoldblade01\Paradox\Olivia\Resources;

use darkgoldblade01\Paradox\Olivia\Models\Location;
use darkgoldblade01\Paradox\Olivia\Olivia;

class Company extends Olivia
{

    /**
     * Get Conversations
     *
     * Get the conversations for the
     * company you are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-company-conversations
     *
     * @param bool $conversations
     *
     * @return mixed
     */
    public function get_conversations($conversations = true) {
        return $this->get('company/conversations', [
            'query' => [
                'conversations' => $conversations
            ]
        ]);
    }


    /**
     * Get Locations
     *
     * Get the locations for the
     * company you are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-company-locations
     *
     * @param bool $locations
     *
     * @return mixed
     */
    public function get_locations($locations = true) {
        $response = $this->get('company/locations', [
            'query' => [
                'locations' => $locations
            ]
        ]);

        $locations = [];

        foreach($response->locations AS $key => $location) {
            $locations[] = new Location($location);
        }

        if(function_exists('collect')) {
            $response->locations = collect($locations);
        } else {
            $response->locations = $locations;
        }

        return $response;
    }


    /**
     * Get AI Assistant
     *
     * Get the AI Assistant's
     * name and image for the
     * company you are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-ai-assistants-name-and-image
     *
     * @return mixed
     */
    public function get_ai_assistant() {
        return $this->get('company/ai');
    }


    /**
     * Job Requisition Feed
     *
     * Get the Job Requisition
     * feed for the company you
     * are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#job-requisition-feed
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function job_requisition_feed() {
        $this->coming_soon();
        return $this->get('company/jobs');
    }


    /**
     * Users Feed
     *
     * Get the Users Feed for the
     * company you are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#users-feed
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function users_feed() {
        $this->coming_soon();
        return $this->get('company/users');
    }
}
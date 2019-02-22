<?php
namespace darkgoldblade01\Paradox\Olivia\Resources;

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
        return $this->get('company/locations', [
            'query' => [
                'conversations' => $locations
            ]
        ]);
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
}
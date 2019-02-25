<?php
namespace darkgoldblade01\Paradox\Olivia\Resources;

use darkgoldblade01\Paradox\Olivia\Models\Candidate;
use darkgoldblade01\Paradox\Olivia\Olivia;

class Candidates extends Olivia
{

    /**
     * Get Candidates
     *
     * Get the candidates for the
     * company you are authorized as.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-candidates
     *
     * @param array $opts
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function get_candidates(array $opts = []) {
        $defaultOptions = [
            'start_date' => null,
            'end_date' => null,
            'start_keyword' => null,
            'limit' => 50,
            'status' => null,
            'group_name' => null,
            'location_id' => null,
            'source' => null,
            'conversations' => null
        ];

        $options = array_replace_recursive($defaultOptions, $opts);

        $response = $this->get('candidates', $options);

        $candidates = [];

        foreach($response->candidates AS $key => $candidate) {
            $candidates[] = new Candidate($candidate);
        }

        if(function_exists('collect')) {
            $response->candidates = collect($candidates);
        } else {
            $response->candidates = $candidates;
        }

        return $response;
    }

    /**
     * Create Candidate
     *
     * Creates a candidate for the
     * company you are authorized as.
     *
     * @param Candidate $candidate
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function create_candidate(Candidate $candidate) {
        $candidate->can_create();
        return $this->post('candidates', [
            'form_params' => $candidate->to_array()
        ]);
    }

    /**
     * Get Candidate
     *
     * Gets a single candidate for the
     * company you are authorized as.
     *
     * @param string $oid The Olivia ID of the candidate you are trying to get.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function get_candidate($oid) {
        return new Candidate($this->get('candidates/' . $oid));
    }

    /**
     * Update Candidate
     *
     * Updates a candidate for the
     * company you are authorized as.
     *
     * @param Candidate $candidate
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function update_candidate(Candidate $candidate) {
        $candidate->can_update();
        return new Candidate($this->get('candidates/' . $candidate->OID));
    }

    /**
     * Delete Candidate
     *
     * Deletes a candidate for the
     * company you are authorized as.
     *
     * @param Candidate $candidate
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function delete_candidate(Candidate $candidate) {
        return $this->delete('candidates/' . $candidate->OID);
    }

    /**
     * Unsubscribe Candidate
     *
     * Unsubscribe a candidate for the
     * company you are authorized as.
     *
     * @param Candidate $candidate
     * @param bool $unsubscribe True to unsubscribe, false to resubscribe
     *
     * @return mixed
     */
    public function unsubscribe_candidate(Candidate $candidate, $unsubscribe = true) {
        return $this->put('candidates/unsubscribe', [
            'form_params' => [
                'OID' => $candidate->OID,
                'action_id' => ($unsubscribe?'1':'0')
            ]
        ]);
    }

}
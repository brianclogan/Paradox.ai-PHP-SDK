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

        $response->candidates = collect($candidates);

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
     * @return mixed
     */
    public function create_candidate(Candidate $candidate) {
        return $this->post('candidates', [
            'form_params' => $candidate->to_array()
        ]);
    }

}
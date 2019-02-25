<?php
namespace darkgoldblade01\Paradox\Olivia\Resources;

use darkgoldblade01\Paradox\Olivia\Models\User;
use darkgoldblade01\Paradox\Olivia\Olivia;

class Users extends Olivia
{

    /**
     * Get Company Users
     *
     * Get all company users.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-company-users
     *
     * @param int $limit
     * @param int $page
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function get_company_users($limit = 50, $page = 1) {
        $response = $this->get('users', [
            'query' => [
                'limit' => $limit,
                'page' => $page
            ]
        ]);

        $users = [];

        foreach($response->users AS $key => $user) {
            $users[] = new User($user);
        }

        if(function_exists('collect')) {
            $response->users = collect($users);
        } else {
            $response->users = $users;
        }

        return $response;
    }

    /**
     * Get User
     *
     * Get a company user.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#get-single-users
     *
     * @param User|string $user
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function get_user($user) {
        if(is_string($user)) {
            $oid = $user;
        } else {
            $oid = $user->OID;
        }
        $response = $this->get('users/' . $oid);

        return $response;
    }

    /**
     * Create User
     *
     * Create a new user.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#create-users
     *
     * @param User $user
     *
     * @throws \Exception
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function create_user(User $user) {
        $user->can_create();
        $response = $this->post('users', [
            'form_params' => $user->to_array()
        ]);

        return $response;
    }

    /**
     * Update User
     *
     * Update a user.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#update-user
     *
     * @param User $user
     *
     * @throws \Exception
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function update_user(User $user) {
        $user->can_update();
        $response = $this->put('users/' . $user->OID, [
            'form_params' => $user->to_array()
        ]);

        return $response;
    }

    /**
     * Delete User
     *
     * Delete a user.
     *
     * Reference: https://paradox.readme.io/v1.0/reference#delete-user
     *
     * @param User $user
     *
     * @throws \Exception
     *
     * @return object Returns an object with total count, limit, offset, and candidates that are in a collection.
     */
    public function delete_user(User $user) {
        $response = $this->delete('users/' . $user->OID);

        return $response;
    }

}
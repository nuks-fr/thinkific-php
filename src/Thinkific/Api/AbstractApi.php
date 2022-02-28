<?php

/*
 * This file is part of the Thinkific library.
 *
 * (c) Graphem Solutions <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thinkific\Api;

use Thinkific\Thinkific;

abstract class AbstractApi
{

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $return;

    /**
     * @var AdapterInterface
     */
    protected $api;

    /**
     * @var string
     */
    protected $client;

    /**
     * Request data when doing create or update method
     *
     * @var string
     */


    public function __construct(Thinkific $client)
    {
        $this->client = $client;
        $this->api = $client->getClient();
    }

    /**
     * Get all elements
     *
     * @param
     * @return array
     */
    public function getAll($page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get(
                $this->service,
                [
                    'query' =>
                    [
                        'page' => $page,
                        'limit' => $limit
                    ]
                ]
            )
        );
    }


    /**
     * Get element by id
     *
     * @param
     * @return array
     */
    public function getById($id)
    {
        return json_decode($this->api->get($this->service . '/' . $id));
    }
}

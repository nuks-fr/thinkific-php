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

use Exception;

class Bundles extends AbstractApi
{

    /**
     * @var string
     */
    protected $service = 'bundles';

    public function getAll($page = 1, $limit = 25)
    {
        throw new Exception();
    }

    /**
     * Get a business unit
     *
     * @param
     * @return array
     */
    public function getCoursesById($bundleId, $page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get(
                $this->service . '/' . $bundleId . '/courses',
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
     * Get a business unit
     *
     * @param
     * @return array
     */
    public function getEnrollmentsById($bundleId, $page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get(
                $this->service . '/' . $bundleId . '/enrollments',
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
}

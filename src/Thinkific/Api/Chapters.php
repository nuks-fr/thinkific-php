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

class Chapters extends AbstractApi{
  
    /**
     * @var string
     */
    protected $service = 'chapters';

    /**
     * Get a business unit
     *
     * @param  
     * @return array
     */
    public function getContentsById($chapterId, $page = 1, $limit = 25)
    {
        return json_decode(
            $this->api->get($this->service . '/' . $chapterId . '/contents',
                ['query' => 
                    [
                        'page' => $page, 
                        'limit' => $limit
                    ]
                ]
            )
        );
    }
}

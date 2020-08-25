<?php
/*
 * This file is part of the Thinkific library.
 *
 * (c) Graphem Solutions <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thinkific\SSO;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class SSO{

    /**
     * @var String
     */
    protected $apiKey;

    /**
     * @var String
     */
    protected $subdomain;    

    public function __construct($apiKey, $subdomain)
    {
        $this->apiKey = $apiKey;
        $this->subdomain = $subdomain;
    }
    /**
    * Produce the SSO link
    * PARAM:
    * [
    *    {
    *       "first_name": "Thinkific",
    *        "last_name": "Admin",
    *        "email": "thinkific@thinkific.com",
    *        "iat": 1520875725
    *        "external_id": "thinkific@thinkific.com",
    *        "bio": "Mostly harmless",
    *        "company": "Thinkific",
    *        "timezone": "America/Los_Angeles",
    *    }
    *    ]
    * @return string
    */
    public function getLink($issueBy = '', array $userData, $returnUrl = '', $errorUrl = '')
    {
        $signer  = new Sha256();
        $time    = time();        
        $token = (new Builder())->issuedBy($issueBy)
                                ->issuedAt($time) 
                                ->expiresAt($time + 3600)                          
                                ->with('email', $userData['email']) 
                                ->with('first_name', $userData['first_name']) 
                                ->with('last_name', $userData['last_name']);

        if(isset($userData['external_id'])){
            $token->with('external_id', $userData['external_id']);
        }

        $token = $token->sign($signer, $this->apiKey)->getToken(); 

        $url = "https://$this->subdomain.thinkific.com/api/sso/v2/sso/jwt?jwt=$token";

        if(!empty($returnUrl)){ $url = $url . "&return_to=$returnUrl";}
        if(!empty($errorUrl)) {  $url = $url . "&error_url=$errorUrl";}

        return $url;
    }
}
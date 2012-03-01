<?php

/**
 * Indy Framework
 *
 * An open source application development framework for PHP
 *
 * @author		Mark P Haskins
 * @copyright	Copyright (c) 2010 - 2012, IndyFramework.org
 * @link		http://www.indyframework.org
 */

/**
 * Implementation of the AWSS3Service.
 *
 * @package indyframework/providers
 */

defined( 'INDY_EXEC' ) or die( 'Restricted access' );

require_once INDY_SERVICE . 'AWSS3Service.php';

require_once INDY_EXTERNAL . AWS_SDK. 'sdk.class.php';

class AWSS3ServiceProvider implements ProviderInterface, AWSS3Service
{
	private $aws_s3;
	
    public function applicationEvent(ServiceRepository $serviceRepository, $event)
    {
        switch($event)
        {
            case APPLICATION_LOAD:
            {
                $serviceRepository->registerService('AWSS3Service', $this);
                break;
            }
            case APPLICATION_INIT:
            {
            	$this->aws_s3 = new AmazonS3();
            	break;
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    ///// Application Load Direct Inject functions
    ////////////////////////////////////////////////////////////////////////////
    public function setRegion($region)
    {
    	$this->aws_as_region = $region;
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    ///// Implementation of the AWSS3Service interface
    ////////////////////////////////////////////////////////////////////////////
    public function copyFile(array $source, array $destination, array $options = null) {
    	
    	$response = $this->aws_s3->copy_object($source, $destination, $options);
    	
    	return $response;
    }
}
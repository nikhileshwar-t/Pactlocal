<?php
/**
* Copyright (c) Microsoft Corporation.  All Rights Reserved.  Licensed under the MIT License.  See License in the project root for license information.
* 
* AgreementFileProperties File
* PHP version 7
*
* @category  Library
* @package   Microsoft.Graph
* @copyright © Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
namespace Beta\Microsoft\Graph\Model;

/**
* AgreementFileProperties class
*
* @category  Model
* @package   Microsoft.Graph
* @copyright © Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
class AgreementFileProperties extends Entity
{
    /**
    * Gets the fileData
    *
    * @return AgreementFileData The fileData
    */
    public function getFileData()
    {
        if (array_key_exists("fileData", $this->_propDict)) {
            if (is_a($this->_propDict["fileData"], "Beta\Microsoft\Graph\Model\AgreementFileData")) {
                return $this->_propDict["fileData"];
            } else {
                $this->_propDict["fileData"] = new AgreementFileData($this->_propDict["fileData"]);
                return $this->_propDict["fileData"];
            }
        }
        return null;
    }
    
    /**
    * Sets the fileData
    *
    * @param AgreementFileData $val The fileData
    *
    * @return AgreementFileProperties
    */
    public function setFileData($val)
    {
        $this->_propDict["fileData"] = $val;
        return $this;
    }
    
    /**
    * Gets the fileName
    *
    * @return string The fileName
    */
    public function getFileName()
    {
        if (array_key_exists("fileName", $this->_propDict)) {
            return $this->_propDict["fileName"];
        } else {
            return null;
        }
    }
    
    /**
    * Sets the fileName
    *
    * @param string $val The fileName
    *
    * @return AgreementFileProperties
    */
    public function setFileName($val)
    {
        $this->_propDict["fileName"] = $val;
        return $this;
    }
    
    /**
    * Gets the isDefault
    *
    * @return bool The isDefault
    */
    public function getIsDefault()
    {
        if (array_key_exists("isDefault", $this->_propDict)) {
            return $this->_propDict["isDefault"];
        } else {
            return null;
        }
    }
    
    /**
    * Sets the isDefault
    *
    * @param bool $val The isDefault
    *
    * @return AgreementFileProperties
    */
    public function setIsDefault($val)
    {
        $this->_propDict["isDefault"] = boolval($val);
        return $this;
    }
    
    /**
    * Gets the language
    *
    * @return string The language
    */
    public function getLanguage()
    {
        if (array_key_exists("language", $this->_propDict)) {
            return $this->_propDict["language"];
        } else {
            return null;
        }
    }
    
    /**
    * Sets the language
    *
    * @param string $val The language
    *
    * @return AgreementFileProperties
    */
    public function setLanguage($val)
    {
        $this->_propDict["language"] = $val;
        return $this;
    }
    
}
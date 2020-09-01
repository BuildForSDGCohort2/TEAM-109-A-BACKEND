<?php
/**
 * Enumfile
 *
 * PHP version 5
 */

namespace App\Enums;

use BenSampo\Enum\Enum;
/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Permissions extends Enum
{

    //  user
    const CHANGE_PASSWORD = "CHANGE_PASSWORD";
    const UPDATE_ACCOUNT = "UPDATE_ACCOUNT";


    // admin user
    const ACTIVATE_USER = "ACTIVATE_USER";
    const DISABLE_USER = "DISABLE_USER";
    const VIEW_USER = "DELETE_USER";


    // super_admin user
    const CREATE_USER = "CREATE_USER";
    const DELETE_USER = "DELETE_USER";
    const UPDATE_USER = "UPDATE_USER";
    const CHANGE_STATUS = "CHANGE_STATUS";


    /**
     * Enum file
     *
     * PHP version 5
     */
    public static function getSuperAdminPermissions(){
        return [
            self::CREATE_USER,
            self::DELETE_USER,
            self::UPDATE_USER,
            self::CHANGE_STATUS
        ];
    }

    /**
     * Enum file
     *
     * PHP version 5
     */

    public static function getAdminPermissions(){
        return [
            self::ACTIVATE_USER,
            self::DISABLE_USER,
            self::VIEW_USER,
        ];
    }


    /**
     * Enum file
     *
     * PHP version 5
     */
    public static function getFarmerPermissions(){
        return [
           self::CHANGE_PASSWORD,
           self::UPDATE_ACCOUNT,
        ];
    }


    /**
     * Enum file
     *
     * PHP version 5
     */
    public static function getProcessorPermissions(){
        return [
           self::CHANGE_PASSWORD,
           self::UPDATE_ACCOUNT,
        ];
    }


    /**
     * Enum file
     *
     * PHP version 5
     */
    public static function getStoragePermissions(){
        return [
           self::CHANGE_PASSWORD,
           self::UPDATE_ACCOUNT,
        ];
    }
}

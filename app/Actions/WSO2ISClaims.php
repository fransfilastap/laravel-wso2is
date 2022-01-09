<?php

namespace App\Actions;

final class WSO2ISClaims
{
    /**
     * Username claim
     * @var string
     */
    public static string $USERNAME = "http://wso2.org/claims/username";

    /**
     * Role claim
     * 
     * @var string
     */
    public static string $ROLE = "http://wso2.org/claims/role";

    /**
     * 
     * Department (K/L)
     * 
     * @var string
     */
    public static string $DEPARTMENT = "http://wso2.org/claims/department";

    /**
     * Email Address
     * 
     * @var string
     */
    public static string $EMAIL_ADDRESS = "http://wso2.org/claims/emailaddress";

    /**
     * 
     * Lastname
     * 
     * @var string
     */
    public static string $LAST_NAME = "http://wso2.org/claims/lastname";

    /**
     * Fullname
     * 
     * @var string
     */
    public static string $GIVEN_NAME = "http://wso2.org/claims/givenname";


    /**
     * 
     * @var string
     */
    public static string $USER_PRINCIPAL = "http://wso2.org/claims/userprincipal";


    /**
     * 
     * @var string
     */
    public static string $IS_READONLY_USER = "http://wso2.org/claims/identity/isReadOnlyUser";


    /**
     * 
     * @var string
     */
    public static string $MODIFIED = "http://wso2.org/claims/modified";


    /**
     * 
     * @var string
     */
    public static string $FULL_NAME = "http://wso2.org/claims/fullname";


    /**
     * 
     * @var string
     */
    public static string $CREATED = "http://wso2.org/claims/created";


    /**
     * 
     * @var string
     */
    public static string $RESOURCE_TYPE = "http://wso2.org/claims/resourceType";


    /**
     * 
     * @var string
     */
    public static string $USERID = "http://wso2.org/claims/userid";
}

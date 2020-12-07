<?php

namespace App\Constants;
class MenuConstants
{
    const MUNU = array(
        "ROLE_ADMIN" => array(
            "Dashboard"=>"/application/admin/dashboard",
            "Users"=>"/application/users",
            "Properties"=>array(
                "Properties"=>"/application/properties/applicationUserID",
                "Add Properties"=>"/application/properties/add/applicationUserID",
            ),
            "Users Plans"=>"/application/plans",
            "Configuration"=>"/application/config",
        ),
        "ROLE_AGENCY" => array(
            "Dashboard"=>"/application/agency/applicationUserID/dashboard",
            "Users"=>"/application/agent/applicationUserID",
            "Properties"=>array(
                "Properties"=>"/application/properties/applicationUserID",
                "Add Properties"=>"/application/properties/add/applicationUserID",
            ),
            "Configuration"=>"/application/config",
        ),
        "ROLE_AGENT" => array(
            "Dashboard"=>"/application/agent/applicationUserID/dashboard",
            "Properties"=>"/application/properties/applicationUserID",
            "Properties"=>array(
                "Properties"=>"/application/properties/applicationUserID",
                "Add Properties"=>"/application/properties/add/applicationUserID",
            ),
        ),
        "ROLE_FSBO" => array(
            "Dashboard"=>"/application/agent/applicationUserID/dashboard",
            "Properties"=>"/application/properties/applicationUserID",
            "Configuration"=>"/application/config",
        ),
    );
}

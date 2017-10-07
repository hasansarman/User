<?php

if (function_exists('current_permission_value') === false) {
    function current_permission_value($model, $permissionTitle, $permissionAction)
    {
       //        print_r($model->PERMISSIONS);
        $value = array_get($model->PERMISSIONS, "$permissionTitle.$permissionAction");
        if ($value === true) {
            return 1;
        }
        if ($value === false) {
            return -1;
        }

        return 0;
    }
}

<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Permissions\PermissionManager;

abstract class BaseUserModuleController extends AdminBaseController
{
    /**
     * @var PermissionManager
     */
    protected $PERMISSIONS;

    /**
     * @param Request $request
     * @return array
     */
    protected function mergeRequestWithPermissions(Request $request)
    {

//dd($request->all());
//$input = $request->all();
        $PERMISSIONS = $this->PERMISSIONS->clean($request->PERMISSIONS);

        return array_merge($request->all(), ['PERMISSIONS' => $PERMISSIONS]);
    }
}

<?php namespace Modules\User\Http\Controllers\Admin;


use Illuminate\Support\Facades\Log;
use Modules\User\Contracts\Authentication;
use Modules\User\Events\UserHasBegunResetProcess;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Permissions\PermissionManager;
use Modules\User\Repositories\RoleRepository;
use Modules\User\Repositories\UserRepository;
use Laracasts\Flash\Flash;

class UserController extends BaseUserModuleController
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var RoleRepository
     */
    private $role;
    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @param PermissionManager $permissions
     * @param UserRepository    $user
     * @param RoleRepository    $role
     * @param Authentication    $auth
     */
    public function __construct(
        PermissionManager $PERMISSIONS,
        UserRepository $user,
        RoleRepository $role,
        Authentication $auth
    ) {
        parent::__construct();

        $this->PERMISSIONS = $PERMISSIONS;
        $this->user = $user;
        $this->role = $role;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->all();

        $currentUser = $this->auth->check();

        return view('user::admin.users.index', compact('users', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->role->all();

        return view('user::admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {

        Log::error($request);
        $data = $this->mergeRequestWithPermissions($request);

        $this->user->createWithRoles($data, $request->roles, true);

      //  flash(trans('user::messages.user created'));

        return redirect()->route('admin.user.user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        if (!$user = $this->user->find($id)) {
          //  flash()->error(trans('user::messages.user not found'));

            return redirect()->route('admin.user.user.index');
        }
        $roles = $this->role->all();

        $currentUser = $this->auth->check();

        return view('user::admin.users.edit', compact('user', 'roles', 'currentUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int               $id
     * @param  UpdateUserRequest $request
     * @return Response
     */
//UpdateUserRequest
    public function update($id, UpdateUserRequest $request)
    {
       // echo "foo";
      //  dd($request->all());

        // To see all the posted stuff
     //   dd($request->all());
        $data = $this->mergeRequestWithPermissions($request);
//
        $this->user->updateAndSyncRoles($id, $data, $request->roles);
//
      //  flash(trans('user::messages.user updated'));

        return redirect()->route('admin.user.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->delete($id);

        //flash(trans('user::messages.user deleted'));

        return redirect()->route('admin.user.user.index');
    }

    public function sendResetPassword($user, Authentication $auth)
    {
        $user = $this->user->find($user);
        $code = $auth->createReminderCode($user);

        event(new UserHasBegunResetProcess($user, $code));

        //flash(trans('user::auth.reset password email was sent'));

        return redirect()->route('admin.user.user.edit', $user->ID);
    }
}

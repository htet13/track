<?php

namespace App\Http\Controllers\Backend;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilter $filter)
    {
        $users = $this->userRepository->all($filter,30);

        $roles = $this->roleRepository->allRoles();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->allRoles();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $status = $this->userRepository->store($request);

        ($status) ? $message = trans('cruds.user.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.user.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->roleRepository->allRoles();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $status = $this->userRepository->update($user, $request);

        ($status) ? $message = trans('cruds.user.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.user.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
        
            $status = $this->userRepository->destroy($user);

            ($status) ? $message = trans('cruds.user.title_singular') . ' ' . trans('global.delete_success') : $message = trans('cruds.user.title_singular') . ' ' . trans('global.delete_fail');

            toast($message,$status ? 'success' : 'error');
            
            return redirect()->route('admin.user.index');

        } catch (QueryException $e) {

            toast('A foreign data is existing.','error');

            return redirect()->route('admin.user.index');
        }
    }

      /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel()
    {
        return $this->userRepository->exportExcel();
    }
}

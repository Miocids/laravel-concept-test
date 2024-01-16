<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Http\Resources\{UserCollection, UserResource};
use Illuminate\Http\{JsonResponse, Response, RedirectResponse};
use App\Services\{UserService};
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Contracts\Foundation\Application;

/**
 * @property UserService $userService
 */
class UserController extends Controller
{
    /**
     * UserController Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|UserCollection
     */
    public function index(): Factory|View|Application|UserCollection
    {
        $response = $this->userService->getAllRepository();
            if (\request()->ajax())
                return new UserCollection($response);

        return view("pages.users.index",["responses" => $response]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("pages.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->store();

        return \redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Response|null
     */
    public function show(string $id): ?Response
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        return view("pages.users.edit",[
            "response"  => $this->userService->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $this->userService->update($id);

        return \redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->userService->delete($id);

        return \redirect()->route("users.index");
    }
}
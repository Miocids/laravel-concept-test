<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreDashboardRequest, UpdateDashboardRequest};
use App\Http\Resources\{DashboardCollection, DashboardResource};
use Illuminate\Http\{JsonResponse, Response, RedirectResponse};
use App\Services\{UserService};
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Contracts\Foundation\Application;

/**
 * @property DashboardService $dashboardService
 */
class DashboardController extends Controller
{
    /**
     * DashboardController Constructor
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(UserService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|DashboardCollection
     */
    public function index(): Factory|View|Application|DashboardCollection
    {
        $response = $this->dashboardService->getAllRepository();
            if (\request()->ajax())
                return new DashboardCollection($response);

        return view("pages.dashboards.index",["responses" => $response]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("pages.dashboards.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDashboardRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreDashboardRequest $request): RedirectResponse
    {
        $this->dashboardService->store();

        return \redirect()->route("dashboards.index");
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
        return view("pages.dashboards.edit",[
            "response"  => $this->dashboardService->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDashboardRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateDashboardRequest $request, string $id): RedirectResponse
    {
        $this->dashboardService->update($id);

        return \redirect()->route("dashboards.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->dashboardService->delete($id);

        return \redirect()->route("dashboards.index");
    }
}
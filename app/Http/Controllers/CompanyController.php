<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreCompanyRequest, UpdateCompanyRequest};
use App\Http\Resources\{CompanyCollection, CompanyResource};
use Illuminate\Http\{JsonResponse, Response, RedirectResponse};
use App\Services\{CompanyService};
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Contracts\Foundation\Application;

/**
 * @property CompanyService $companyService
 */
class CompanyController extends Controller
{
    /**
     * CompanyController Constructor
     *
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application|CompanyCollection
     */
    public function index(): Factory|View|Application|CompanyCollection
    {
        $response = $this->companyService->getAllRepository();
            if (\request()->ajax())
                return new CompanyCollection($response);

        return view("pages.companies.index",["responses" => $response]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("pages.companies.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $this->companyService->store();

        return \redirect()->route("companies.index");
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
        return view("pages.companies.edit",[
            "response"  => $this->companyService->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateCompanyRequest $request, string $id): RedirectResponse
    {
        $this->companyService->update($id);

        return \redirect()->route("companies.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->companyService->delete($id);

        return \redirect()->route("companies.index");
    }
}
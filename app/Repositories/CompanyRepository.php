<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Company};
use Illuminate\Support\Carbon;

class CompanyRepository extends BaseRepository
{

    /**
     * Construct CompanyRepository class
     */
    public function __construct()
    {
        parent::__construct(new Company);
    }

    /**
     * Get the results of the data model Companywith their respective filters
     *
     * @return mixed
     */
    public function getAllRepository(): mixed
    {
        return $this->getRepository()
            ->query()
            ->when(\request("key"), function ($query){
                return $query->where("key",\request("key"));
            })
            ->when(\request("status"), function ($query){
                return $query->where("status",\request()->boolean("status"));
            })
            ->when(\request("text"), function ($query){
                return $query->where(function ($subQuery){
                    return $subQuery->whereLike(["key"], \request()->string("text")->title())
                    ->orWhereHas("hasRelation", function ($hasQuery){
                        return $hasQuery->whereLike(["key"], \request()->string("text")->title());
                    });
                });
            })
            ->latest()
            ->when(\request("page"), function ($query){
                return $query->fastPaginate(\request("to"));
            },function ($query){
                return $query->get();
            });
    }

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function saveRepository(array $attributes): ?Model
    {
        return $this->save([
            "name" => $attributes["name"]
        ],$attributes);
    }

    /**
     * @param array $attributes
     * @param string $id
     * @return Model|null
     */
    public function updateRepository(array $attributes,string $id): ?Model
    {
        return $this->save([
            "id" => $id
        ],$attributes);
    }

}
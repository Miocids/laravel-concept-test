<?php namespace App\Services;

use App\Repositories\{UserRepository};
use Illuminate\Support\Facades\{Cache, DB, Mail, Auth};
use Illuminate\Support\{Arr, Collection, Str};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\{Response};

class UserService extends UserRepository
{
    /**
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function login()
    {
        try {
            $credentials = \request()->only("email","password");

            if (Auth::attempt($credentials))
                return redirect()->route('dashboard');

            return back()->withErrors([
                'user' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
            

     } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Model|null
     * @throws \Exception
     */
    public function store(): ?Model
    {
        DB::beginTransaction();
        try {

            $payload = \request()->merge([
                "company_id"    => \request()->input("company"),
                "password"      => \bcrypt(\request()->input("password"))
            ])->except("company");

            $user = $this->saveRepository($payload);

            \auth()->login($user);

            DB::commit();

            return $user;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return Model|null
     * @throws \Exception
     */
    public function update(string $id): ?Model
    {
        DB::beginTransaction();
        try {
            $payload = \request()->merge([
                "company_id"    => \request()->input("company")
            ])->except("company","_token","_method");

            $response = $this->updateRepository($payload,$id);

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

}

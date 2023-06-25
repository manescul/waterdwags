<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDogDataJob;
use App\Models\Dog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DogController extends Controller
{
    protected const DOG_NAME = 'name';
    protected const DOG_MANDATORY_FIELDS = [
        self::DOG_NAME,
    ];

    public function addDog(Request $request): Response
    {
        $dogData = $request->json()->all();

        if (!$this->isDogDataValid($dogData)) {
            return abort(422);
        }

        StoreDogDataJob::dispatch($dogData)->afterResponse();

        return response('', 200);
    }

    public function listDogs(Request $request): JsonResponse
    {
        $dogsQuery = Dog::query();

        if ($name = $request->get('name')) {
            $this->addNameFilter($name, $dogsQuery);
        }

        $dogs = $dogsQuery->pluck('data')->toArray();

        return new JsonResponse(
            $this->decodeJsonDogs($dogs)
        );
    }

    protected function isDogDataValid(array $dogData): bool
    {
        foreach (self::DOG_MANDATORY_FIELDS as $field) {
            if(!isset($dogData[$field])) {
                return false;
            }
        }

        return true;
    }

    protected function addNameFilter(string $name, Builder $dogsQuery): void
    {
        $dogsQuery->whereRaw("(data->>'name') like '%$name%'");
    }

    protected function decodeJsonDogs(array $dogs): array
    {
        array_walk($dogs,
            function (string &$dog) {
                $dog = json_decode($dog);
            }
        );

        return $dogs;
    }
}

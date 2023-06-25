<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDogDataJob;
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

    protected function isDogDataValid(array $dogData): bool
    {
        foreach (self::DOG_MANDATORY_FIELDS as $field) {
            if(!isset($dogData[$field])) {
                return false;
            }
        }

        return true;
    }
}

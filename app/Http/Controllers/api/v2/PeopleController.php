<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query("page");
        $perPage = $request->query("per_page");
        $search = $request->query("search");
        $admins = People::with("type")
            ->where("name", "ilike", "%" . $search . "%")
            ->orderBy("id", "asc")
            ->paginate($perPage, ["*"], "page", $page);
        return Helper::apiResponse(true, "Successfully got records.", $admins);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "type_id" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["name", "type_id"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 400);
        }

        $formData = [
            "name" => $request->input("name"),
            "type_id" => (int) $request->input("type_id"),
        ];

        $createdPeople = People::create($formData);
        $people = People::with("type")->find($createdPeople->id);

        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $people
        );
    }

    public function show($id)
    {
        $people = People::with("type")->find($id);
        if (!$people) {
            return Helper::apiResponse(false, "Record not found.", null, 400);
        }
        return Helper::apiResponse(true, "Successfully got record.", $people);
    }

    public function update(Request $request, People $people)
    {
        //
    }

    public function destroy(People $people)
    {
        //
    }
}

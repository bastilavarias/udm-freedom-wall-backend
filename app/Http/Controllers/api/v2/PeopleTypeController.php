<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use App\Models\PeopleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleTypeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query("page");
        $perPage = $request->query("per_page");
        $search = $request->query("search");
        $admins = PeopleType::where(
            "label",
            "ilike",
            "%" . $search . "%"
        )->paginate($perPage, ["*"], "page", $page);
        return Helper::apiResponse(true, "Successfully got records.", $admins);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "label" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["label"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 400);
        }

        $formData = [
            "label" => $request->input("label"),
            "description" => $request->input("description"),
        ];

        $peopleType = PeopleType::create($formData);

        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $peopleType
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $peopleType = PeopleType::find($id);
        return Helper::apiResponse(
            true,
            "Successfully got record.",
            $peopleType
        );
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

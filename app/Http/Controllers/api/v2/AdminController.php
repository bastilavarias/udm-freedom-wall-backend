<?php

namespace App\Http\Controllers\api\v2;

use App\Common\Helper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query("page");
        $perPage = $request->query("per_page");
        $search = $request->query("search");
        $admins = Account::where("username", "ilike", "%" . $search . "%")
            ->orWhere("name", "ilike", "%" . $search . "%")
            ->paginate($perPage, ["*"], "page", $page);
        return Helper::apiResponse(true, "Successfully got records.", $admins);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "username" => "required|unique:accounts",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["name", "username", "password"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 400);
        }

        $formData = [
            "name" => $request->input("name"),
            "username" => $request->input("username"),
            "password" => Hash::make($request->input("password")),
        ];

        $admin = Account::create($formData);

        return Helper::apiResponse(
            true,
            "Successfully created record.",
            $admin
        );
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $admin = Account::find($id);
        return Helper::apiResponse(true, "Successfully got records.", $admin);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "name" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $validatorMessages = $validator->messages();
            $errorMessage = Helper::getValidatorErrorMessage(
                $validatorMessages,
                ["id", "name", "password"]
            );
            return Helper::apiResponse(false, $errorMessage, null, 400);
        }

        $formData = [
            "id" => $request->input("id"),
            "name" => $request->input("name"),
            "password" => Hash::make($request->input("password")),
        ];

        $admin = Account::find($formData["id"]);
        if (!$admin) {
            return Helper::apiResponse(false, "Record not found.", null, 400);
        }

        $admin->fill($formData)->save();

        return Helper::apiResponse(
            true,
            "Successfully updated record.",
            $admin
        );
    }

    public function destroy($id)
    {
        $admin = Account::find($id);
        if ($admin) {
            $admin->delete();
            return Helper::apiResponse(
                true,
                "Successfully deleted record.",
                $admin
            );
        }
        return Helper::apiResponse(
            true,
            "Successfully deleted record.",
            $admin
        );
    }
}

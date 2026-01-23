<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::get();
        return response()->json([
            'success' => true,
            'message' => "Member data fetched",
            "data" => $member

        ]);
    }
    public function show($id)
    {
        $member = Member::find($id);
        


        if (!$member) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Member ID: {$id} not found",
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => "Member ID: {$id} fetched",
            'data' => $member
        ]);
    }
}

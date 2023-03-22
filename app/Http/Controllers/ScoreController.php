<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function get()
    {
        try {
            $data = Auth()->user()->score;
            return response()->json([
                "status" => true,
                "score" => $data
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = Auth()->user();
            $valid = $request->validate([
                "score" => "required"
            ]);

            $message = "";
            if ($user->score < $request->score) {
                User::findOrFail($user->id)->update($valid);
                $message = "berhasil melakuukan update";
            } else {
                $message = "tidak diupdate";
            }

            return response()->json([
                "status" => true,
                "messsage" => $message
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage()
            ]);
        }
    }
}

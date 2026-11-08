<?php

namespace App\Helpers;

use App\Models\SavedJob;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class SavedJobHelper
{
    public static function getSavedJobIds()
    {
        // CHƯA LOGIN
        if (!Auth::check()) {

            return [];
        }

        $account = Auth::user();

        // TÌM CANDIDATE
        $candidate = Candidate::where(
            'account_id',
            $account->account_id
        )->first();

        // KHÔNG CÓ CANDIDATE
        if (!$candidate) {

            return [];
        }

        // LẤY DANH SÁCH JOB ĐÃ SAVE
        return SavedJob::where(
                'candidate_id',
                $candidate->candidate_id
            )
            ->pluck('job_id')
            ->toArray();
    }
}
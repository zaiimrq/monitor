<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function issuePdfDownloader(?Issue $issue = null) {
        $data = [
                'timses' => $issue->user->name,
                'title' => $issue->title,
                'created_at' => $issue->created_at,
                'updated_at' => $issue->updated_at
            ];
        PDF::loadView('download.issue.pdf', $data);
    }
}

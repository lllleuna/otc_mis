<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicationReportExport implements FromView
{
    protected $cooperatives;
    protected $user;

    public function __construct($cooperatives, $user)
    {
        $this->cooperatives = $cooperatives;
        $this->user = $user;
    }

    public function view(): View
    {
        return view('exports.application_report', [
            'cooperatives' => $this->cooperatives,
            'user' => $this->user,
        ]);
    }
}

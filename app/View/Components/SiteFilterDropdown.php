<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SiteFilterDropdown extends Component
{
    public $siteArr;
    public $selectedSite;

    public function __construct($siteArr, $selectedSite)
    {
        $this->siteArr = $siteArr;
        $this->selectedSite = $selectedSite;
    }

    public function render()
    {
        return view('components.site-filter-dropdown');
    }
}


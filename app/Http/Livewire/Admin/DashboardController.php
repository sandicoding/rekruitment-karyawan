<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Apply as ModelsAppyController;
use App\Models\Job as ModelsJobController;
use App\Models\User as ModelsUserController;


class DashboardController extends Component
{
  public function render()
  {
    return view('dashboard', [
      'apply' => ModelsAppyController::count(),
      'job' => ModelsJobController::count(),
      'user' => ModelsUserController::count(),
    ]);
  }
}

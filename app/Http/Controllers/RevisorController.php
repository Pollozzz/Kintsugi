<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    // Logiche revisione annunci

    public function index()
    {
        return view('revisor.index');
    }

    public function accept(Advertisement $advertisement)
    {
        $advertisement->setAccepted(true);

        return redirect()
            ->back()
            ->with('message', __('ui.reviewerApproved', ['title' => $advertisement->title]));
    }

    public function reject(Advertisement $advertisement)
    {
        $advertisement->setAccepted(false);

        return redirect()
            ->back()
            ->with('message', __('ui.reviewerRejected', ['title' => $advertisement->title]));
    }

    public function revision(Advertisement $advertisement)
    {
        $advertisement->setAccepted(null);

        return redirect()
            ->back()
            ->with('message', __('ui.reviewerPending', ['title' => $advertisement->title]));
    }

    public function show(Advertisement $advertisement)
    {

        return view('revisor.show', compact('advertisement'));

    }

    // Fine logiche revisione annunci

    // Logiche mail-revisor

    public function becomeRevisor()
    {
        Mail::to(config('mail.admin_address'))->send(new BecomeRevisor(Auth::user()));

        return redirect()->route('welcome')->with('message', __('ui.reviewerRequestSent'));
    }

    public function confirmMakeRevisor(User $user): View
    {
        return view('revisor.confirm-make', compact('user'));
    }

    public function makeRevisor(User $user): RedirectResponse
    {
        $user->is_revisor = true;
        $user->save();

        return redirect()->route('welcome')->with('message', __('ui.reviewerRoleGranted'));
    }

    // Fine Logiche mail-revisor

}

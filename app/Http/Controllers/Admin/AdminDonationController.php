<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('user')->latest()->paginate(5);
        return view('admin.donations.index', compact('donations'));
    }

    public function download($id)
    {
        $donation = Donation::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('admin.donations.receipt', compact('donation'));
        return $pdf->download("receipt_donation_{$donation->id}.pdf");
    }
}

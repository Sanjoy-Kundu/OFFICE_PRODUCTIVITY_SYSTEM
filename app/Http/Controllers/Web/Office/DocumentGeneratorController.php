<?php

namespace App\Http\Controllers\Web\Office;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class DocumentGeneratorController extends Controller
{
 /**
     * চিঠি ও ডকুমেন্ট জেনারেটর ভিউ
     */
    public function create()
    {
        try {
            return view('office.correspondence.documents.create');
        } catch (Throwable $e) {
            Log::error('Document Generator View Error: ' . $e->getMessage());

            return redirect()->route('office.correspondence.index')
                ->with('error', 'ডকুমেন্ট জেনারেটর লোড করতে সমস্যা হয়েছে।');
        }
    }
}

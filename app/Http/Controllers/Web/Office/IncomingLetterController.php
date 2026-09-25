<?php

namespace App\Http\Controllers\Web\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class IncomingLetterController extends Controller
{
  /**
     * আগত চিঠি রেজিস্টার তালিকা ভিউ
     */
    public function index(Request $request)
    {
        try {
            return view('office.correspondence.incoming.index');
        } catch (Throwable $e) {
            Log::error('Incoming Letters Index Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->route('office.correspondence.index')
                ->with('error', 'আগত চিঠিপত্র লোড করা সম্ভব হয়নি।');
        }
    }

    /**
     * নতুন আগত চিঠি তৈরির ফর্ম ভিউ
     */
    public function create()
    {
        try {
            return view('office.correspondence.incoming.create');
        } catch (Throwable $e) {
            Log::error('Incoming Letter Create View Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->route('office.correspondence.incoming.index')
                ->with('error', 'আগত চিঠির এন্ট্রি ফর্ম লোড করা যায়নি।');
        }
    }
}

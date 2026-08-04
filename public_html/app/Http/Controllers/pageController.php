<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;

class pageController extends Controller
{
     public function index()
    {
        return view('user.index');
    }
    public function exhibitorsRegister()
    {
        return view('exhibitors-register');
    }
    public function visitorsRegister()
    {
        return view('visitors-register');
    }


     public function saveVisitorsRegister(Request $request)
    {
        $data = $request->all();
        $company_id = 12;
        $exhibition_id = 20;
        $data['company_id'] = $company_id;
        $data['exhibition_id'] = $exhibition_id;
        $response  = Http::post('https://event.rowbest.in/api/master-visitor-reg', $data);
        // $response  = Http::post('http://127.0.0.1:9000/api/master-visitor-reg', $data);

        if ($response->successful()) {
            $responseData = $response->json();
            if ($responseData['status'] == true) {
                return response()->json(['status' => true, 'qr_id' => $responseData['id'], 'badge_no' => $responseData['badge_id'], 'visitor' => $data]);
            } else {
                return response()->json(['status' => false, 'msg' => $responseData['message']]);
            }
        } else {
            return response()->json('Sorry, something went wrong. try again later');
        }
    }
    public function badgeSuccess(Request $request)
     {
        $qr_id = $request->qr_id;
        $badge_no = $request->badge_no;
        $visitor = json_decode($request->visitor);
        $visitor = [
            'name' => $visitor->name,
            'profile' => $visitor->profile,
            'company_name' => $visitor->company_name,
            'designation' => $visitor->designation,
            'city' => $visitor->city,
            'mobile_number' => $visitor->mobile_number,
            'mobile_code' => $visitor->mobile_code,
        ];
        $badge_no = $badge_no;
        $badge_no = str_pad($badge_no, 4, '0', STR_PAD_LEFT);
        $qr_id = $qr_id;
        $visitor = $visitor;
        $imageLogo = public_path('assets/logo/logoblc.png');
        $imageLogo23 = public_path('assets/logo/logoblc.png');
        $imageLogo = base64_encode(file_get_contents($imageLogo));
        $imageLogo23 = base64_encode(file_get_contents($imageLogo23));
        $url = 'https://event.rowbest.in/register/' . $qr_id;
        $qrCode = QrCode::size(256)->generate($url);
        $qrCodeBase64 = base64_encode($qrCode);

        // Load the same view with QR code for PDF generation
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('badge', compact('imageLogo', 'imageLogo23', 'visitor', 'badge_no', 'qrCodeBase64'));
        return $pdf->stream();
    }

    public function subEventRegister(Request $request, $slug)
    {
        return view('sub-event-registration', compact('slug'));
    }

    public function saveSubEventRegister(Request $request,$slug)
    {
        $data = $request->all();
        $company_id = 12;
        $exhibition_id = 20;
        $slug = $slug;
        $data['company_id'] = $company_id;
        $data['exhibition_id'] = $exhibition_id;
        $data['slug'] = $slug;
        $response  = Http::post('https://event.rowbest.in/api/sub-event-visitor-reg', $data);
        // $response  = Http::post('http://127.0.0.1:9000/api/sub-event-visitor-reg', $data);

        if ($response->successful()) {
            $responseData = $response->json();
            if ($responseData['status'] == true) {
                return response()->json(['status' => true, 'qr_id' => $responseData['id'], 'badge_no' => $responseData['badge_id'], 'visitor' => $data]);
            } else {
                return response()->json(['status' => false, 'msg' => $responseData['message']]);
            }
        } else {
            return response()->json('Sorry, something went wrong. try again later');
        }
    }



}


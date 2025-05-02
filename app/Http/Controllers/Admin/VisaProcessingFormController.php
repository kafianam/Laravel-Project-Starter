<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaProcessingForm;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ApprovedStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class VisaProcessingFormController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
    
        if ($user->role === 'admin') {
            $forms = VisaProcessingForm::with('service')->latest()->get();
        } else {
            $forms = VisaProcessingForm::with('service')->where('user_id', $user->id)->latest()->get();
        }
    
        return view('visa_processing.index', compact('forms'));
    }
    

    public function create()
    {
        $services = Service::all();
        return view('visa_processing.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['passport_copy', 'ticket_copy', 'hotel_booking', 'other_doc', 'itineraries']);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('passport_copy')) $data['passport_copy'] = $request->file('passport_copy')->store('documents', 'public');
        if ($request->hasFile('ticket_copy')) $data['ticket_copy'] = $request->file('ticket_copy')->store('documents', 'public');
        if ($request->hasFile('hotel_booking')) $data['hotel_booking'] = $request->file('hotel_booking')->store('documents', 'public');
        if ($request->hasFile('other_doc')) $data['other_doc'] = $request->file('other_doc')->store('documents', 'public');

        $data['advance_purchase'] = $request->input('advance_purchase', []);
        $data['itineraries'] = $request->input('itineraries', []);

        VisaProcessingForm::create($data);

        return redirect()->route('visa_processing.index')->with('success', 'Visa form submitted successfully.');
    }

    public function show($id)
    {
        $visaProcessingForm = VisaProcessingForm::findOrFail($id);
        
        return view('visa_processing.show', compact('visaProcessingForm'));
    }
    

    public function edit($id)
    {
        $visaProcessingForm = VisaProcessingForm::findOrFail($id);
        $services = Service::all();
    
        $advancePurchases = is_array($visaProcessingForm->advance_purchase)
            ? $visaProcessingForm->advance_purchase
            : [];
    
        return view('visa_processing.edit', compact('visaProcessingForm', 'services', 'advancePurchases'));
    }
    
    public function update(Request $request, $id)
    {
        $visaForm = VisaProcessingForm::findOrFail($id);
        $user = auth()->user();

        // Validation rules
        $rules = [
            'service_id' => 'required|exists:services,id',
            'name' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'travel_from' => 'nullable|string|max:255',
            'travel_type' => 'nullable|string|max:255',
            'expected_travel_date' => 'nullable|date',
            'primary_contact' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'passport_copy' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'ticket_copy' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'hotel_booking' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'other_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ];

        if ($user->role === 'admin') {
            $rules = array_merge($rules, [
                'advance_purchase' => 'nullable|array',
                'application_status' => 'required|in:Pending,Processing,On Hold,Approved,Cancel,Reject',
                'payment_status' => 'required|in:Paid,Unpaid',
                'payment_method' => 'required|in:Cash,Bkash,Rocket,Nagod,Cheque,Online Bank Transfer',
                'payment_date' => 'nullable|date',
            ]);
        }

        $validated = $request->validate($rules);

        $previousStatus = $visaForm->application_status;
        // Fill form
        $visaForm->fill($validated);

        // File uploads
        foreach (['passport_copy', 'ticket_copy', 'hotel_booking', 'other_doc'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $visaForm->$fileField = $request->file($fileField)->store('visa_docs', 'public');
            }
        }

        // Admin-only updates
        if ($user->role === 'admin') {
            $visaForm->advance_purchase = $request->input('advance_purchase', []);
        $visaForm->application_status = $request->input('application_status');
            $visaForm->payment_status = $request->input('payment_status');
            $visaForm->payment_method = $request->input('payment_method');
            $visaForm->payment_date = $request->input('payment_date');
        }

        $visaForm->save();

        //  Check if status changed to Approved
        if ($user->role === 'admin' && $visaForm->application_status === 'Approved' && $previousStatus !== 'Approved') {
            Log::info("Application approved for ID: $id");

            // Generate PDF
            $pdf = Pdf::loadView('pdf.visa_approval', ['form' => $visaForm]);

            $fileName = $visaForm->name . '_' . $visaForm->passport_number . '.pdf';
            $filePath = storage_path('app/public/visa_pdfs/' . $fileName);

            Storage::put('public/visa_pdfs/' . $fileName, $pdf->output());

            // Send email
            if ($visaForm->email) {
                Mail::to($visaForm->email)->send(new ApprovedStatusMail($visaForm, $filePath));
            }

            Log::info("Approval email sent to " . $visaForm->email);
        }
        return redirect()->route('visa_processing.index')->with('success', 'Visa processing form updated successfully.');
    }

    public function destroy(VisaProcessingForm $visaProcessingForm)
    {
        $visaProcessingForm->delete();
        return redirect()->route('visa_processing.index')->with('success', 'Form deleted successfully.');
    }

    public function downloadPdf(VisaProcessingForm $visaProcessingForm)
    {
        $pdf = Pdf::loadView('visa_processing.pdf', compact('visaProcessingForm'));
        return $pdf->download('visa_application_'.$visaProcessingForm->id.'.pdf');
    }
}
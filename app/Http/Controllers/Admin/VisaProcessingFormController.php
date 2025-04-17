<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaProcessingForm;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisaProcessingFormController extends Controller
{
    public function index()
    {
        $forms = VisaProcessingForm::with('service')->latest()->get();
        return view('visa_processing.index', compact('forms'));
    }

    public function create()
    {
        $services = Service::all();
        return view('visa_processing.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['passport_copy', 'ticket_copy', 'hotel_booking', 'other_doc']);
    
        // Handle files
        if ($request->hasFile('passport_copy')) {
            $data['passport_copy'] = $request->file('passport_copy')->store('documents', 'public');
        }
        if ($request->hasFile('ticket_copy')) {
            $data['ticket_copy'] = $request->file('ticket_copy')->store('documents', 'public');
        }
        if ($request->hasFile('hotel_booking')) {
            $data['hotel_booking'] = $request->file('hotel_booking')->store('documents', 'public');
        }
        if ($request->hasFile('other_doc')) {
            $data['other_doc'] = $request->file('other_doc')->store('documents', 'public');
        }
    
        // Handle advance_purchase checkboxes
        $data['advance_purchase'] = $request->input('advance_purchase', []);
    
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

    // If advance_purchase is already an array, no need to decode
    $advancePurchases = $visaProcessingForm->advance_purchase ?? [];


    return view('visa_processing.edit', compact('visaProcessingForm', 'services', 'advancePurchases'));
}


    public function update(Request $request, $id)
    {
        $visaForm = VisaProcessingForm::findOrFail($id);
        $user = auth()->user();
    
        // Base validation rules
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
    
        // Admin-only fields
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
    
        // Only update allowed fields
        $visaForm->fill($validated);
    
        // Handle file uploads
        foreach (['passport_copy', 'ticket_copy', 'hotel_booking', 'other_doc'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $visaForm->$fileField = $request->file($fileField)->store('visa_docs', 'public');
            }
        }
    
        // Only admin can update the restricted fields
        if ($user->role === 'admin') {
            $visaForm->advance_purchase = json_encode($request->input('advance_purchase', []));
            $visaForm->application_status = $request->application_status;
            $visaForm->payment_status = $request->payment_status;
            $visaForm->payment_method = $request->payment_method;
            $visaForm->payment_date = $request->payment_date;
        }
    
        $visaForm->save();
    
        return redirect()->route('visa_processing.index')->with('success', 'Visa processing form updated successfully.');
    }
    

    public function destroy(VisaProcessingForm $visaProcessingForm)
    {
        $visaProcessingForm->delete();
        return redirect()->route('visa_processing.index')->with('success', 'Form deleted successfully.');
    }
    
}

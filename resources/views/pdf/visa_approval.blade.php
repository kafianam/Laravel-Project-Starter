<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Letter of Introduction for Visa Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            font-size: 16px;
            line-height: 1.6;
        }

        .header, .footer {
            text-align: right;
            margin-bottom: 30px;
        }

        .underline {
            display: inline-block;
            min-width: 180px;
            border-bottom: 1px solid black;
            padding: 2px;
        }

        .bold {
            font-weight: bold;
        }

        .section {
            margin-top: 20px;
        }

        .signature-section {
            margin-top: 50px;
        }

        .small-text {
            font-size: 12px;
        }

        .signature-seal-wrapper {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .signature-seal-wrapper img {
            height: 80px;
        }

        .signature-img {
            height: 50px;
        }
    </style>
</head>
<body>

    <div class="header">
        Controller of Immigration<br>
        Singapore<br>
        Date: <span class="underline">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
    </div>

    <h2 style="text-align: center;">LETTER OF INTRODUCTION FOR VISA APPLICATION</h2>

    <div class="section">
        Dear Sir,
    </div>

    <div class="section">
        The applicant for the visa, <span class="bold">{{ $form->name }}</span> (name of applicant) of 
        <span class="underline">{{ $form->nationality }}</span> (Country/Place), holder of passport/travel document no. 
        <span class="underline">{{ $form->passport_number }}</span>, is coming to Singapore from 
        <span class="underline">{{ $form->travel_from }}</span> (Country/Place of embarkation) for the purpose of 
        <span class="underline">{{ $form->travel_type }}</span> (e.g., holiday, transit, business, meeting, exhibition, visiting friends & relatives, employment, education for others, please specify).
        The applicant is my <span class="underline">Client</span> (e.g., father, mother, brother, sister, son, daughter, spouse, business partner; for others, please specify).
    </div>

    <div class="section">
        Yours faithfully,
    </div>

    <hr style="margin-top: 50px; margin-bottom: 30px;">

    <div class="section">
        <div class="bold">Only for application where Local Contact is an individual:</div>
        
        <div class="signature-section">
            _____________________________  &nbsp;&nbsp;&nbsp; _____________________________ <br>
            Signature of Local Contact &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NRIC (Pink / Blue) No
        </div>

        <div class="signature-section">
            _____________________________  &nbsp;&nbsp;&nbsp; _____________________________ <br>
            Name of Local Contact &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact Number
        </div>

        <div class="signature-section">
            _____________________________  &nbsp;&nbsp;&nbsp; _____________________________ <br>
            Address of Local Contact &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email Address
        </div>
    </div>

    <hr style="margin-top: 50px; margin-bottom: 30px;">

    <div class="section">
        <div class="bold">Only for application where Local Contact is a company:</div>

        <div class="signature-seal-wrapper">
            <img src="{{ public_path('images/rahman-signature.png') }}" alt="Signature" class="signature-img">
            <img src="{{ public_path('images/company-seal.png') }}" alt="Company Seal">
        </div>

        <div class="signature-section">
            <span class="bold">Md Mostafizur Rahman, S7981802Z, Director</span><br>
            Name, NRIC No. and Designation/Capacity
        </div>

        <div class="signature-section">
            <span class="bold">JOY TRAVEL & TOURS PTE LTD, 199 Syed Alwi Road #02-199A Singapore 207731</span><br>
            Company Name and Address
        </div>

        <div class="signature-section">
            <span class="bold">201004525C</span> (Unique Entity Number - UEN of the Company/Firm)
        </div>

        <div class="signature-section">
            <span class="bold">+65 91381993</span> (Contact Number)
        </div>

        <div class="signature-section">
            <span class="bold">joyholidays88@gmail.com</span> (Email Address)
        </div>
    </div>

    <div class="footer small-text">
        V39A
    </div>

</body>
</html>

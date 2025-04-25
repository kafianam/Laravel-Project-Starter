<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visa Approval</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            font-size: 16px;
            line-height: 1.8;
        }

        .label {
            font-weight: bold;
        }

        .underline {
            display: inline-block;
            min-width: 250px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        .section {
            margin-bottom: 20px;
        }

        .center-text {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }

        .content-block {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <div class="section">
        <span class="label">Date:</span>
        <span class="underline">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
    </div>

    <div class="center-text">TO WHOM IT MAY CONCERN</div>

    <div class="content-block">
        This is to certify that <span class="underline">{{ $form->name }}</span> bearing Passport No.
        <span class="underline">{{ $form->passport_number }}</span>, nationality <span class="underline">{{ $form->nationality }}</span>,
        has applied for a visa to <span class="underline">{{ $form->travel_from }}</span> for the purpose of
        <span class="underline">{{ $form->travel_type }}</span>.
    </div>

    <div class="content-block">
        All the necessary documentation and service formalities have been completed for the visa application through our agency. The application is now being processed and the visa has been approved based on the submitted documents and information.
    </div>

    <div class="content-block">
        We confirm that the following service has been provided by us: 
        <span class="underline">{{ $form->service->service_name ?? 'N/A' }}</span>.
    </div>

    <div class="content-block">
        Applicant Type: <span class="underline">Client</span>
    </div>

    <div class="content-block">
        Should you have any further queries regarding this applicant or the visa process, please do not hesitate to contact us.
    </div>

    <div class="content-block" style="margin-top: 50px;">
        Yours sincerely,<br><br>
        <strong>Visa Processing Team</strong><br>
        Joy Trip Singapore
    </div>

</body>
</html>

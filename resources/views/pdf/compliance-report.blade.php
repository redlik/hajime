<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compliance Report</title>
    <style>
        body {
            font-size: 12px;
        }

        .text-red {
            color: red;
        }

        .text-small {
            font-size: 11px;
        }

        table {
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-left-header {
            width: 240px;
            font-weight: bold;
            text-align: left;
            padding: 7px;
        }

        .table-header {
            font-weight: bold;
            text-align: left;
            padding: 7px;
            background-color: #e5e7eb;
        }

        .table-left-align {
            text-align: left;
            font-weight: normal;
            padding: 7px 20px 7px 7px;
        }
    </style>
</head>
<body>
<h2 style="text-align: center;margin-bottom: 30px">IJA CLub Compliance Status Report {{ now()->format('Y') }}</h2>
<table>
    <tr>
        <th class="table-left-header">Club Name</th>
        <th class="table-left-align"><strong>{{ $club['name'] }}</strong></th>
    </tr>
    <tr>
        <th class="table-left-header">Name of Secretary</th>
        <th class="table-left-align">{{ $secretary['name'] ?? 'Not set'}}</th>
    </tr>
    <tr>
        <th class="table-left-header">Name of Head / Lead Coach</th>
        <th class="table-left-align">{{ $headCoach['name'] ?? 'Not set'}}</th>
    </tr>
</table>

<table style="width: 710px;">
    @if($designated)
        <tr>
            <th class="table-header">Name of Designated Person</th>
            <th class="table-header">Vetting Expiry Date</th>
            <th class="table-header">Safeguarding 3</th>
            <th class="table-header">First Date</th>
        </tr>
        <tr>
            <th class="table-left-align">{{ $designated['name'] }}</th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $designated['vetting_expiry'] < now()
])>
                {{ $designated['vetting_expiry'] }}
            </span>
            </th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $designated['safeguarding_expiry'] < now()
])>
                {{ $designated['safeguarding_expiry'] }}</th>
            </span>
            <th class="table-left-align">
            <span @class([
		'text-red' => $designated['first_aid_expiry'] < now()
])>
                {{ $designated['first_aid_expiry'] }}</th>
            </span>
        </tr>
    @endif
    @if($childrens)
        <tr>
            <th class="table-header">Name of Children's Officer</th>
            <th class="table-header">Vetting Expiry Date</th>
            <th class="table-header">Safeguarding 2</th>
            <th class="table-header">First Date</th>
        </tr>
        <tr>
            <th class="table-left-align">{{ $childrens['name'] }}</th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $childrens['vetting_expiry'] < now()
])>
                {{ $childrens['vetting_expiry'] }}
            </span>
            </th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $childrens['safeguarding_expiry'] < now()
])>
                {{ $childrens['safeguarding_expiry'] }}</th>
            </span>
            <th class="table-left-align">
            <span @class([
		'text-red' => $childrens['first_aid_expiry'] < now()
])>
                {{ $childrens['first_aid_expiry'] }}</th>
            </span>
        </tr>
    @endif
    @if($secretary)
        <tr>
            <th class="table-header">Name of Secretary</th>
            <th class="table-header">Vetting Expiry Date</th>
            <th class="table-header">Safeguarding 1</th>
            <th class="table-header">First Date</th>
        </tr>
        <tr>
            <th class="table-left-align">{{ $secretary['name'] }}</th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $secretary['vetting_expiry'] < now()
])>
                {{ $secretary['vetting_expiry'] }}
            </span>
            </th>
            <th class="table-left-align">
            <span @class([
		'text-red' => $secretary['safeguarding_expiry'] < now()
])>
                {{ $secretary['safeguarding_expiry'] }}</th>
            </span>
            <th class="table-left-align">
            <span @class([
		'text-red' => $secretary['first_aid_expiry'] < now()
])>
                {{ $secretary['first_aid_expiry'] }}</th>
            </span>
        </tr>
    @endif
</table>
@if(count($coaches) > 0)
    <table style="width: 710px;">
        <tr>
            <th class="table-header">Name of Coach</th>
            <th class="table-header">Qualification</th>
            <th class="table-header">Vetting Expiry Date</th>
            <th class="table-header">Safeguarding Expiry Date</th>
            <th class="table-header">First Date Expiry Date</th>
        </tr>
        @foreach($coaches as $coach)
            <tr>
                <th class="table-left-align">{{ $coach['name'] }}</th>
                <th class="table-left-align" style="padding-right: 7px">{{ $coach['coaching_qualification'] }}
                    <br>
                    <span class="text-small" @class([
		'text-red' => $coach['coaching_date'] < now()
])>
                        {{ $coach['coaching_date'] }}
                    </span>
                </th>
                <th class="table-left-align"><span @class([
		'text-red' => $coach['vetting_expiry'] < now()
])>{{ $coach['vetting_expiry'] }}</span></th>
                <th class="table-left-align"><span @class([
		'text-red' => $coach['safeguarding_expiry'] < now()
])>{{ $coach['safeguarding_expiry'] }}</span></th>
                <th class="table-left-align"><span @class([
		'text-red' => $coach['first_aid_expiry'] < now()
])>{{ $coach['first_aid_expiry'] }}</span></th>
            </tr>
        @endforeach
    </table>
@else
    <h4>No Coaches registered</h4>
@endif
@if(count($volunteers) > 0)
    <table style="width: 710px;">
        <tr>
            <th class="table-header">Name of Volunteer</th>
            <th class="table-header">Vetting Expiry Date</th>
            <th class="table-header">Safeguarding Expiry Date</th>
        </tr>
        @foreach($volunteers as $volunteer)
            <tr>
                <th class="table-left-align">{{ $volunteer['name'] }}</th>
                <th class="table-left-align"><span @class([
		'text-red' => $volunteer['vetting_expiry'] < now()
                ])>{{ $volunteer['vetting_expiry'] }}</span></th>
                <th class="table-left-align"><span @class([
		'text-red' => $volunteer['safeguarding_expiry'] < now()
                ])>{{ $volunteer['safeguarding_expiry'] }}</span></th>
            </tr>
        @endforeach
    </table>
@else
    <h4>No Volunteers registered</h4>
@endif
<h3>Sport Ireland Ethics – Club Self-Assessment</h3>
<table style="width: 400px;">
    <tr>
        <th class="table-header">Self Assessment submitted</th>
        <th class="table-header">Date Submitted</th>
    </tr>
    <tr>
        <th class="table-left-align">
            @if($club['ethics_assessment'])
                <span>Yes</span>
            @else
                <span>No</span>
            @endif
        </th>
        <th class="table-left-align">{{ $club['ethics_assessment_date'] ?? '-'}}</th>
    </tr>
</table>
<h3 class="font-bold text-xl text-gray-500 mb-2">Club Compliant</h3>
@if($club['compliant'])
    <div><strong>Yes</strong></div>
@else
    <div class="text-red">No</div>
@endif
<table style="width:500px; border: none; margin-top: 10px;">
    <tr>
        <th style="font-weight: normal;border:none;text-align: left">Report date: {{ date('d M Y') }}</th>
        <th style="font-weight: normal;border:none;text-align: left">Checked by: {{ Auth::user()->name }}</th>
    </tr>
</table>
@ray(get_defined_vars())
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compliance Report</title>
    <style>
        body {
            font-size: 13px;
        }
        .text-red {
            color: red;
        }

        .table-left-header {
            width: 250px;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>{{ $club['name'] }}</h1>
<table>
    <tr>
        <th class="table-left-header">Name of Secretary</th>
        <th style="font-weight: normal">{{ $secretary['name'] ?? 'Not set'}}</th>
    </tr>
    <tr>
        <th class="table-left-header">Name of Head / Lead Coach</th>
        <th style="font-weight: normal">{{ $headCoach['name'] ?? 'Not set'}}</th>
    </tr>
</table>
</body>
</html>

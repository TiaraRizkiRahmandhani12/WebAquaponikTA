<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
            /* Menengahkan teks dalam kolom */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data
        @if ($chartId == 'suhuchart')
            Suhu
        @elseif ($chartId == 'tdsValuechart')
            TDS Value
        @elseif ($chartId == 'phchart')
            pH Air
        @elseif ($chartId == 'jarakairchart')
            Jarak Air
        @elseif ($chartId == 'jarakpakanchart')
            Jarak Pakan
        @endif
        2 Minggu Terakhir
    </h1>

    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->created_at->format('d M H:i') }}</td>
                    <td>
                        @if ($chartId == 'suhuchart')
                            {{ $record->suhu }}
                        @elseif ($chartId == 'tdsValuechart')
                            {{ $record->tdsValue }}
                        @elseif ($chartId == 'phchart')
                            {{ $record->phAir }}
                        @elseif ($chartId == 'jarakairchart')
                            {{ $record->jarakAir }}
                        @elseif ($chartId == 'jarakpakanchart')
                            {{ $record->jarakPakan }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

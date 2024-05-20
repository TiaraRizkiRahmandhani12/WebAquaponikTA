<!-- download.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Page</title>
</head>

<body>
    <h1>Data Download</h1>

    <table border="1">
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
                    @if ($chartId == 'suhuchart')
                        <td>{{ $record->suhu }}</td>
                    @elseif ($chartId == 'tdsValuechart')
                        <td>{{ $record->tds }}</td>
                    @elseif ($chartId == 'phchart')
                        <td>{{ $record->ph }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

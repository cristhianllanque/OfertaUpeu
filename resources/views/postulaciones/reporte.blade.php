<!-- resources/views/postulaciones/reporte.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Postulaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Postulaciones</h1>
    <p>Usuario: {{ auth()->user()->name }}</p>
    <p>Fecha: {{ now()->setTimezone('America/Lima')->format('d/m/Y H:i') }}</p> <!-- Hora ajustada a Lima -->

    <table>
        <thead>
            <tr>
                <th>Título de Oferta</th>
                <th>Descripción</th>
                <th>Salario</th>
                <th>Ubicación</th>
                <th>Fecha de Vencimiento</th>
                <th>Estado</th>
                <th>Fecha de Postulación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postulaciones as $postulacion)
                <tr>
                    <td>{{ $postulacion->oferta->titulo }}</td>
                    <td>{{ $postulacion->oferta->descripcion }}</td>
                    <td>{{ $postulacion->oferta->salario }}</td>
                    <td>{{ $postulacion->oferta->ubicacion }}</td>
                    <td>{{ $postulacion->oferta->fecha_vencimiento }}</td>
                    <td>{{ ucfirst($postulacion->estado) }}</td>
                    <td>{{ $postulacion->created_at->setTimezone('America/Lima')->format('d/m/Y H:i') }}</td> <!-- Fecha de postulación ajustada a Lima -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

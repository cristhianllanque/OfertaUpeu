<!-- resources/views/ofertas/reporte.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Oferta</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            background-color: #f9f9f9;
        }

        h1, h2, h3 {
            color: #2c3e50;
            border-bottom: 2px solid #2980b9; /* Subrayado */
            padding-bottom: 5px;
        }

        p {
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: #ffffff;
        }

        .highlight {
            background-color: #ecf0f1; /* Color de fondo suave */
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        /* Estilos para resaltar */
        .important {
            color: #e74c3c; /* Color rojo */
            font-weight: bold;
        }

        .info {
            color: #3498db; /* Color azul */
            font-weight: bold;
        }

        .details {
            background-color: #d5f5e3; /* Color verde claro */
            border-left: 5px solid #28b463; /* Borde verde */
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Reporte de Oferta: <span class="highlight">{{ $oferta->titulo }}</span></h1>
    
    <h2>Detalles de la Oferta</h2>
    <div class="details">
        <p><strong>Descripción:</strong> {{ $oferta->descripcion }}</p>
        <p><strong>Salario:</strong> {{ $oferta->salario }} {{ $oferta->moneda }}</p>
        <p><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
        <p><strong>Fecha de Vencimiento:</strong> {{ \Carbon\Carbon::parse($oferta->fecha_vencimiento)->format('d/m/Y') }}</p>
        <p><strong>Publicado por:</strong> {{ $oferta->creador->name }}</p>
        <p><strong>Email de la Empresa:</strong> {{ $oferta->creador->email }}</p>
        <p><strong>Teléfono de la Empresa:</strong> {{ $oferta->creador->telefono ?? 'No proporcionado' }}</p>
        <p><strong>Fecha de Publicación:</strong> {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y H:i') }}</p>
    </div>

    <h2>Descripción Completa</h2>
    <p class="details">{{ $oferta->descripcion_completa ?? 'No hay descripción completa proporcionada.' }}</p>

    <h2>Postulaciones</h2>
    <p>Esta oferta ha recibido un total de <span class="highlight">{{ $oferta->postulaciones->count() }}</span> postulaciones.</p>
    <table>
        <thead>
            <tr>
                <th>Nombre del Postulante</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Fecha de Postulación</th>
                <th>Hora de Postulación</th>
                <th>CV (Archivo)</th>
                <th>Comentarios de la Empresa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($oferta->postulaciones as $postulacion)
                <tr>
                    <td>{{ $postulacion->user->name }}</td>
                    <td>{{ $postulacion->user->email }}</td>
                    <td>{{ $postulacion->user->telefono ?? 'No proporcionado' }}</td>
                    <td>{{ ucfirst($postulacion->estado) }}</td>
                    <td>{{ \Carbon\Carbon::parse($postulacion->created_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($postulacion->created_at)->format('H:i') }}</td>
                    <td>
                        @if($postulacion->cv)
                            <a href="{{ asset('storage/' . $postulacion->cv) }}" target="_blank">Ver CV</a>
                        @else
                            Sin CV
                        @endif
                    </td>
                    <td>{{ $postulacion->comentarios ?? 'Sin comentarios' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Instrucciones para la Empresa</h2>
    <p>Asegúrate de revisar cada postulación detenidamente y de comunicarte con los candidatos seleccionados para la entrevista.</p>

    <h2>Resumen y Recomendaciones</h2>
    <p>Basado en las postulaciones, se sugiere realizar entrevistas con los postulantes destacados. Evalúa sus perfiles y elige los más adecuados para la oferta.</p>

    <h2>Conclusión</h2>
    <p>Este es un resumen de las oportunidades y el interés generado por la oferta publicada.</p>

    <div class="footer">
        <p><strong>Fecha de generación del reporte:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>

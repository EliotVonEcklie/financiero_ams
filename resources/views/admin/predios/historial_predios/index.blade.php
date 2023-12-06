<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Destino Economico</th>
            <th>Fecha</th>
            <th>Tipo Documento</th>
            <th>Documento</th>
            <th>Nombre Propietario</th>
            <th>Direccion</th>
            <th>Hectareas</th>
            <th>Metros Cuadrados</th>
            <th>Area Construida</th>
            <th>Tasa por Mil</th>
            <th>Estrato</th>
            <th>Tipo Predio</th>
        </tr>
        @foreach ($historial_predios as $historial_predio)
            <tr>
                <td>{{ $historial_predio->id }}</td>
                <td><a href="{{ route('admin.destino_economicos.show', ['destino_economico' => $historial_predio->destino_economico]) }}">{{ $historial_predio->destino_economico->nombre }}</a></td>
                <td>{{ $historial_predio->fecha }}</td>
                <td>{{ $historial_predio->tipo_documento }}</td>
                <td>{{ $historial_predio->documento }}</td>
                <td>{{ $historial_predio->nombre_propietario }}</td>
                <td>{{ $historial_predio->direccion }}</td>
                <td>{{ $historial_predio->hectareas }}</td>
                <td>{{ $historial_predio->metros_cuadrados }}</td>
                <td>{{ $historial_predio->area_construida }}</td>
                <td>{{ $historial_predio->tasa_por_mil }}</td>
                <td>{{ $historial_predio->estrato }}</td>
                <td>{{ $historial_predio->tipo_predio }}</td>
            </tr>
        @endforeach
    </table>
</div>

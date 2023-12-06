<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Codigo</th>
            <th>Nombre</th>
        </tr>
        @foreach ($destino_economicos as $destino_economico)
            <tr>
                <td>{{ $destino_economico->id }}</td>
                <td>{{ $destino_economico->codigo }}</td>
                <td>{{ $destino_economico->nombre }}</td>
            </tr>
        @endforeach
    </table>
</div>

<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Codigo Catastro</th>
            <th>Total</th>
            <th>Orden</th>
            <th>Historial Predios</th>
            <th>Avaluos</th>
        </tr>
        @foreach ($predios as $predio)
            <tr>
                <td>{{ $predio->id }}</td>
                <td>{{ $predio->codigo_catastro }}</td>
                <td>{{ $predio->total }}</td>
                <td>{{ $predio->orden }}</td>
                <td><a href="{{ route('admin.predios.historial_predios.index', ['predio' => $predio]) }}">Ver</a></td>
                <td><a href="{{ route('admin.predios.avaluos.index', ['predio' => $predio]) }}">Ver</a></td>
            </tr>
        @endforeach
    </table>
</div>

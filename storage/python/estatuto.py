import sys

if __name__ == '__main__' and len(sys.argv) == 3:
    from json import loads

    input: dict = loads(sys.argv[2])
    output: list[dict] = []

    import math

    def unidad_monetaria(nombre: str, valor: int|float) -> float:
        return math.ceil(valor / input.unidad_monetarias[nombre])

    def en_rango(valor: float, desde: float, hasta: float) -> bool:
        return (valor >= desde) and (hasta == -1 or valor <= hasta)

    from io import open
    with open(sys.argv[1], 'r') as f:
        for predio in input.predios:

            def es_rural() -> bool:
                return predio.predio_tipo == 1
            def es_urbano() -> bool:
                return predio.predio_tipo == 2
            def tiene_destino_nombre(nombre: str) -> bool:
                return predio.destino_economico.nombre == nombre
            def tiene_destino_codigo(codigo: str) -> bool:
                return predio.destino_economico.codigo == codigo

            def aplicar_bomberil(condicion: bool, tasa: int, tipo: bool) -> None:
                if not output[predio.id].bomberil and condicion:
                    output[predio.id].bomberil_tasa = tasa
                    output[predio.id].bomberil_tarifa = tipo
                    output[predio.id].bomberil = True
            def aplicar_ambiental(condicion: bool, tasa: int, tipo: bool) -> None:
                if not output[predio.id].ambiental and condicion:
                    output[predio.id].ambiental_tasa = tasa
                    output[predio.id].ambiental_tarifa = tipo
                    output[predio.id].ambiental = True
            def aplicar_alumbrado(condicion: bool, tasa: int, tipo: bool) -> None:
                if not output[predio.id].alumbrado and condicion:
                    output[predio.id].alumbrado_tasa = tasa
                    output[predio.id].alumbrado_tarifa = tipo
                    output[predio.id].alumbrado = True

            eval(f.read(), {
                'predio': predio,
                'unidad_monetaria': unidad_monetaria,
                'en_rango': en_rango,
                'tiene_destino_nombre': tiene_destino_nombre,
                'tiene_destino_codigo': tiene_destino_codigo,
                'aplicar_bomberil': aplicar_bomberil,
                'EN_ADELANTE': -1,
                'PORCENTAJE': True,
                'TASA_POR_MIL': False,
            })

"""
predio : Predio object
predio.valor_avaluo : El valor del avaluo del predio
predio.estrato : El estrato del predio
predio.destino_economico : El destino economico del predio

constantes:

EN_ADELANTE : Constante para indicar que un valor es mayor o igual a otro
PORCENTAJE : Constante para indicar que un valor es un porcentaje
TASA_POR_MIL : Constante para indicar que un valor es por mil

Funciones para modificar estatuto

aplicar_bomberil(condicion: bool, tasa: int|float, tipo: bool) -> None : Aplicar la condicion bomberil

Funciones filtro:

en_rango(valor: int|float, desde: int|float, hasta: int|float) -> bool : Verificar si un valor esta en un rango
es_rural() -> bool : Verificar si el predio es rural
es_urbano() -> bool : Verificar si el predio es urbano
tiene_destino_nombre(nombre: str) -> bool : Verificar si el predio tiene un destino economico por nombre
tiene_destino_codigo(codigo: str) -> bool : Verificar si el predio tiene un destino economico por codigo

Funciones miscelanes:

unidad_monetaria(nombre: str, valor: int|float) -> float : Convertir un valor a una unidad monetaria
"""

def en_rango():
    pass
def unidad_monetaria():
    pass
def aplicar_bomberil():
    pass
def tiene_destino_nombre():
    pass
EN_ADELANTE = -1
PORCENTAJE = True
TASA_POR_MIL = False

predio = {}

valor_avaluo = unidad_monetaria('UVT', predio.valor_avaluo)

aplicar_bomberil(
    tiene_destino_nombre('Predios urbanos para vivienda'),
    6,
    PORCENTAJE
)

aplicar_bomberil(
    tiene_destino_nombre('Predios rurales para vivienda') and
    en_rango(valor_avaluo, 600, EN_ADELANTE),
    5,
    PORCENTAJE
)

aplicar_bomberil(
    tiene_destino_nombre('Predios urbanos y rurales edificados'),
    7,
    PORCENTAJE
)

aplicar_bomberil(
    tiene_destino_nombre('Predios no edificados'),
    10,
    PORCENTAJE
)

aplicar_bomberil(
    tiene_destino_nombre('Industriales urbanos y rurales'),
    7,
    PORCENTAJE
)

aplicar_bomberil(
    tiene_destino_nombre('Comerciales urbanos y rurales'),
    7,
    PORCENTAJE
)

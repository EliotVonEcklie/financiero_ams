function decimal (value: number): string {
    return new Intl.NumberFormat('es-ES', {
        style: 'decimal'
    }).format(value);
}

function currency (value: number, currency: string): string {
    return `${decimal(value)}  ${currency}`;
}

function cop (value: number): string {
    return `$ ${currency(value, 'COP')}`;
}

export default {
    decimal: decimal,
    currency: currency,
    cop: cop
}

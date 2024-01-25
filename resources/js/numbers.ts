function decimal (value: number): string {
    return new Intl.NumberFormat('es-CO', {
        style: 'decimal'
    }).format(value)
}

function currency (value: number, currency: string): string {
    return `${decimal(value)}  ${currency}`
}

function cop (value: number): string {
    return `$${decimal(value)}`
}

export default {
    decimal,
    currency,
    cop
}

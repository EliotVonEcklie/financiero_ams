export default {
    decimal (value: number): string {
        return new Intl.NumberFormat('es-CO', {
            style: 'decimal'
        }).format(value)
    },
    currency (value: number, currency: string): string {
        return `${this.decimal(value)}  ${currency}`
    },
    cop (value: number): string {
        return `$${this.decimal(value)}`
    }
}

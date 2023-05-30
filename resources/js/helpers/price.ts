export default function formatPrice(value: number) {
    let options = {
        style: 'decimal',
    };

    return new Intl.NumberFormat('ru-RU', options).format(value);
}

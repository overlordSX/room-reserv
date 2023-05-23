export function dateWithMonth (date: Date) {
    let formatter = Intl.DateTimeFormat('ru', {
        day: 'numeric',
        weekday: 'short',
    });

    return formatter.format(date);
}

export function fullDate (date: Date) {
    let formatter = Intl.DateTimeFormat('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        localeMatcher: "lookup",
    });

    console.log(formatter.formatToParts(date));

    let formatParts = formatter.formatToParts(date);

    let day = formatParts.find((item) => {
        return item.type === 'day';
    });
    let month = formatParts.find((item) => {
        return item.type === 'month';
    });
    let year = formatParts.find((item) => {
        return item.type === 'year';
    });
    return day?.value + ' ' + month?.value + ' ' + year?.value;
}

export function dateWithMonth (date: Date) {
    let formatter = Intl.DateTimeFormat('ru', {
        day: 'numeric',
        weekday: 'long',
    });

    return formatter.format(date);
}

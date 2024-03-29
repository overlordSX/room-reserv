export function plural(forms: Array<string>, n: number): string {
    let idx;
    // @see http://docs.translatehouse.org/projects/localization-guide/en/latest/l10n/pluralforms.html
    if (n % 10 === 1 && n % 100 !== 11) {
        idx = 0; // many
    } else if (n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20)) {
        idx = 1; // few
    } else {
        idx = 2; // one
    }
    return forms[idx] || '';
}

export function squarePlural(value: number) {
    let formatter = new Intl.NumberFormat('ru', {
        style: 'unit',
        unit: 'square',
        unitDisplay: 'short',
    });

    return formatter.format(value);
}

export function startDateAddDays(startDate: Date, addDays: number): Date {
    let localDate = new Date(startDate);
    localDate.setDate(localDate.getDate() + addDays);

    return localDate;
}

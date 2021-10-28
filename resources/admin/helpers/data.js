/**
 * @param {string | number | Date} value
 * @param {Intl.DateTimeFormatOptions} format
 */
export function dateFormat(value, format = {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
    hour: 'numeric',
    minute: 'numeric'
}) {
    format.timeZone = 'UTC';
    return new Date(value).toLocaleString('pl-PL', format);
}

/**
 * @param {Intl.DateTimeFormatOptions} date1
 * @param {Intl.DateTimeFormatOptions} date2
 */
export function dateDiffInDays(date1, date2) {
    const dt1 = new Date(date1);
    const dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
}
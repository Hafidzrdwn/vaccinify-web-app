export default function changeFormat(data) {
  const date = new Date(data)

  const monthsName = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ]

  const month = date.getMonth()
  const day = date.getDate()
  const year = date.getFullYear()

  return `${monthsName[month]} ${day}, ${year}`
}
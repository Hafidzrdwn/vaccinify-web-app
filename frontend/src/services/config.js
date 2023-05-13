export let fetchConf = {
  headers: new Headers({
    "Content-Type": "application/json",
    "Accept": "application/json",
    common: {
      'X-Requested-With': 'XMLHttpRequest',
    },
  }),
  credentials: 'same-origin',
}
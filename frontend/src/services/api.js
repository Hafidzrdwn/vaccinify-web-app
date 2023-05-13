import { fetchConf } from './config'

export default class Api {

  constructor(url = '', method = '', data = '') {
    this.url = url
    this.method = method
    this.data = data
  }

  login() {
    return fetch(base(this.url), {
      method: this.method,
      body: JSON.stringify(this.data),
      ...fetchConf
    })
  }
  logout() {
    return fetch(base(this.url), {
      method: this.method,
      ...fetchConf
    })
  }

  getConsultation() {
    return fetch(base(this.url), {
      method: this.method,
      ...fetchConf
    })
  }

  getVaccinations() {
    return fetch(base(this.url), {
      method: this.method,
      ...fetchConf
    })
  }
}
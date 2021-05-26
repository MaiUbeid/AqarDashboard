class localStorageService {
  ls = window.localStorage

  setItem(key, value) {
    value = JSON.stringify(value)
    this.ls.setItem(key, value)
    return true
  }

  getItem(key) {
    let value = this.ls.getItem(key)
    try {
      return JSON.parse(value)
    } catch (e) {
      return null
    }
  }


  getLang = () => {
    // return "ar"
    let value = this.ls.getItem("aqarz_lang");
    try {
      return JSON.parse(value)
    } catch {
      return "ar"
    }
  }

}

export default new localStorageService();
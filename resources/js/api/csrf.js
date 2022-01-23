import Api from './api' 
import cookie from 'js-cookie'
export default {
    getCookie() {
        let token = cookie.get('XSRF-TOKEN')

        if (token) {
            return new Promise(resolve => {
                resolve(token)
            })
        }

        return Api.get("/csrf-cookie")
    }
}

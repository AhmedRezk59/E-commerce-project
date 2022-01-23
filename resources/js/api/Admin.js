import Api from './api'



export default {
    register(form) {
        return Api().post('/admin/register', form)
    }
    ,

    login(form) {
        return Api().post('/admin/login', form)
    },

    logout(form) {

        return Api().post('/admin/logout', form)
    },
}
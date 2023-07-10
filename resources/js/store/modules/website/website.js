//website module

const state = {
    website: JSON.parse(localStorage.getItem('storedwebsite')) || {},
    websites: JSON.parse(localStorage.getItem('storedwebsites')) || [],
};
const getters = {
    Website(state) {
        return state.website;
    },
    Websites(state) {
        return state.websites;
    },
};
const actions = {
    website(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedwebsite');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Websites.length){
                        var response = context.getters.Websites.filter(website => website.id === payload.id);
                        console.log(response[0])
                        context.commit('website', response[0]);
                        resolve(response[0]);
                    }else{
                            axios.get(payload.url + payload.id)
                            .then((response) => {
                                context.commit('website',  response.data.website);
                                resolve(response);
                        })
                            .catch(error => {
                                console.log(error, 'error');
                                reject(error);
                        });
                    }
                });
        }
    },
    websites(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                    axios.get(url)
                        .then((response) => {
                            context.commit('websites', response.data.websites);
                            resolve(response);
                        })
                        .catch(error => {
                            console.log(error, 'error');
                            reject(error);
                        });
            });
        }
    },
    addWebsite(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('addwebsite', response.data.website);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateWebsite(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('updatewebsite', response.data.website);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deleteWebsite(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get("/api/website/delete/" + payload.id)
                .then((response)=>{
                        context.commit('deletewebsite', response.data.website);
                        resolve(response);
                })
                .catch(error => {
                    console.log(error, 'errortext')
                    reject(error);
                });
            }
        });
    },
}
const mutations = {
    website(state, data) {
        localStorage.setItem('storedwebsite', JSON.stringify(data));
        return state.website  =  JSON.parse(localStorage.getItem('storedwebsite'));
    },
    websites(state, data){
       localStorage.setItem('storedwebsites', JSON.stringify(data));
       return state.websites  =  JSON.parse(localStorage.getItem('storedwebsites'));
    },
    addwebsite(state, data) {
        let storedwebsites = JSON.parse(localStorage.getItem('storedwebsites'));
        storedwebsites.push(data);
        localStorage.setItem('storedwebsites', JSON.stringify(storedwebsites));

        return state.websites =  JSON.parse(localStorage.getItem('storedwebsites'));
    },
    updatewebsite(state, data){
        let storedwebsites = JSON.parse(localStorage.getItem('storedwebsites'));
        const index = storedwebsites.findIndex(website => website.id === data.id);
        storedwebsites.splice(index, 1, data);

        localStorage.setItem('storedwebsites', JSON.stringify(storedwebsites));
        return state.websites  =  JSON.parse(localStorage.getItem('storedwebsites'));
    },
    deletewebsite(state, data){
        let storedwebsites = JSON.parse(localStorage.getItem('storedwebsites'));
        const index = storedwebsites.findIndex(website => website.id === data.id);
        var newdata = storedwebsites.splice(index, 1)

        localStorage.setItem('storedwebsites', JSON.stringify(newdata));
        return state.websites  =  JSON.parse(localStorage.getItem('storedwebsites'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};













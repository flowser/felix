//subscriber module

const state = {
    subscriber: JSON.parse(localStorage.getItem('storedsubscriber')) || {},
    subscribers: JSON.parse(localStorage.getItem('storedsubscribers')) || [],
};
const getters = {
    Subscriber(state) {
        return state.subscriber;
    },
    Subscribers(state) {
        return state.subscribers;
    },
};
const actions = {
    subscriber(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedsubscriber');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Subscribers.length){
                        var response = context.getters.Subscribers.filter(subscriber => subscriber.id === payload.id);
                        console.log(response[0])
                        context.commit('subscriber', response[0]);
                        resolve(response[0]);
                    }else{
                            axios.get(payload.url + payload.id)
                            .then((response) => {
                                context.commit('subscriber',  response.data.subscriber);
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
    subscribers(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                    axios.get(url)
                        .then((response) => {
                            context.commit('subscribers', response.data.subscribers);
                            resolve(response);
                        })
                        .catch(error => {
                            console.log(error, 'error');
                            reject(error);
                        });
            });
        }
    },
    addSubscriber(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    // context.commit('addsubscriber', response.data.subscriber);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updateSubscriber(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    // context.commit('updatesubscriber', response.data.subscriber);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deleteSubscriber(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get("/api/subscriber/delete/" + payload.id)
                .then((response)=>{
                        context.commit('deletesubscriber', response.data.subscriber);
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
    subscriber(state, data) {
        localStorage.setItem('storedsubscriber', JSON.stringify(data));
        return state.subscriber  =  JSON.parse(localStorage.getItem('storedsubscriber'));
    },
    subscribers(state, data){
       localStorage.setItem('storedsubscribers', JSON.stringify(data));
       return state.subscribers  =  JSON.parse(localStorage.getItem('storedsubscribers'));
    },
    addsubscriber(state, data) {
        let storedsubscribers = JSON.parse(localStorage.getItem('storedsubscribers'));
        storedsubscribers.push(data);
        localStorage.setItem('storedsubscribers', JSON.stringify(storedsubscribers));

        return state.subscribers =  JSON.parse(localStorage.getItem('storedsubscribers'));
    },
    updatesubscriber(state, data){
        let storedsubscribers = JSON.parse(localStorage.getItem('storedsubscribers'));
        const index = storedsubscribers.findIndex(subscriber => subscriber.id === data.id);
        storedsubscribers.splice(index, 1, data);

        localStorage.setItem('storedsubscribers', JSON.stringify(storedsubscribers));
        return state.subscribers  =  JSON.parse(localStorage.getItem('storedsubscribers'));
    },
    deletesubscriber(state, data){
        let storedsubscribers = JSON.parse(localStorage.getItem('storedsubscribers'));
        const index = storedsubscribers.findIndex(subscriber => subscriber.id === data.id);
        var newdata = storedsubscribers.splice(index, 1)

        localStorage.setItem('storedsubscribers', JSON.stringify(newdata));
        return state.subscribers  =  JSON.parse(localStorage.getItem('storedsubscribers'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};














//post module

const state = {
    post: JSON.parse(localStorage.getItem('storedpost')) || {},
    posts: JSON.parse(localStorage.getItem('storedposts')) || [],
};
const getters = {
    Post(state) {
        return state.post;
    },
    Posts(state) {
        return state.posts;
    },
};
const actions = {
    post(context, payload) {
        if (context.rootGetters.Auth) {
            localStorage.removeItem('storedpost');
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                return new Promise((resolve, reject) => {
                    if(context.getters.Posts.length){
                        var response = context.getters.Posts.filter(post => post.id === payload.id);
                        console.log(response[0])
                        context.commit('post', response[0]);
                        resolve(response[0]);
                    }else{
                            axios.get(payload.url + payload.id)
                            .then((response) => {
                                context.commit('post',  response.data.post);
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
    posts(context, url) {
        if (context.rootGetters.Auth) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                    axios.get(url)
                        .then((response) => {
                            context.commit('posts', response.data.posts);
                            resolve(response);
                        })
                        .catch(error => {
                            console.log(error, 'error');
                            reject(error);
                        });
            });
        }
    },
    addPost(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.post(payload.createurl)
                .then((response)=>{
                    context.commit('addpost', response.data.post);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    updatePost(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                payload.patch(payload.updateurl + payload.id)
                .then((response)=>{
                    context.commit('updatepost', response.data.post);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error, 'error')
                    reject(error);
                });
            }
        });
    },
    deletePost(context, payload){
        return new Promise((resolve, reject) =>{
            if (context.rootGetters.Auth) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.rootGetters.Token;
                axios.get("/api/post/delete/" + payload)
                .then((response)=>{
                        context.commit('deletepost', response.data.post);
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
    post(state, data) {
        localStorage.setItem('storedpost', JSON.stringify(data));
        return state.post  =  JSON.parse(localStorage.getItem('storedpost'));
    },
    posts(state, data){
       localStorage.setItem('storedposts', JSON.stringify(data));
       return state.posts  =  JSON.parse(localStorage.getItem('storedposts'));
    },
    addpost(state, data) {
        let storedposts = JSON.parse(localStorage.getItem('storedposts'));
        storedposts.push(data);
        localStorage.setItem('storedposts', JSON.stringify(storedposts));

        return state.posts =  JSON.parse(localStorage.getItem('storedposts'));
    },
    updatepost(state, data){
        let storedposts = JSON.parse(localStorage.getItem('storedposts'));
        const index = storedposts.findIndex(post => post.id === data.id);
        storedposts.splice(index, 1, data);

        localStorage.setItem('storedposts', JSON.stringify(storedposts));
        return state.posts  =  JSON.parse(localStorage.getItem('storedposts'));
    },
    deletepost(state, data){
        let storedposts = JSON.parse(localStorage.getItem('storedposts'));
        const index = storedposts.findIndex(post => post.id === data.id);
        var newdata = storedposts.splice(index, 1)

        localStorage.setItem('storedposts', JSON.stringify(newdata));
        return state.posts  =  JSON.parse(localStorage.getItem('storedposts'));
    },
};

export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
};














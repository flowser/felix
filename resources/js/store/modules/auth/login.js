//login
namespaced: true;
const state = {
        access_token     : JSON.parse(localStorage.getItem('access_token')) || null,
        expires_in       : JSON.parse(localStorage.getItem('expires_in')) || null,
        refresh_token    : JSON.parse(localStorage.getItem('refresh_token')) || null,
        token_type       : JSON.parse(localStorage.getItem('token_type')) || null,

        user             : JSON.parse(localStorage.getItem('storeduser')) || null,
        // institution      : JSON.parse(localStorage.getItem('storedinstitution')) || null,
        // department       : JSON.parse(localStorage.getItem('storeddepartment')) || null,
        params           : JSON.parse(localStorage.getItem('storedparams')) || null,
        dashboard        : JSON.parse(localStorage.getItem('storeddashboard')) || null,
        roles            : JSON.parse(localStorage.getItem('storedroles')) || [],
        permissions      : JSON.parse(localStorage.getItem('storedpermissions')) || [],
        url              : JSON.parse(localStorage.getItem('storedurl')) || null,
        urldept          : JSON.parse(localStorage.getItem('storedurldept')) || null,
        urlclassmastdept : JSON.parse(localStorage.getItem('storedurlclassmastdept')) || null,
        urllectdept      : JSON.parse(localStorage.getItem('storedurllectdept')) || null,
        membership       : JSON.parse(localStorage.getItem('storedmembership')) || null,
    };
const getters = {
        Token(state) {
            return state.access_token;
        },
        Tokenexpiry(state) {
            return state.expires_in;
        },
        Refreshtoken(state) {
            return state.refresh_token;
        },
        Auth(state){
            return true;
        },
        AuthUser(state){
            return state.user;
        },        

    };
const actions = {
    
};
const mutations = {
  
};
export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations,
};

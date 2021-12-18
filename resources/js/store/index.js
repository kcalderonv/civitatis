import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: null,
        reserva: null,
    },
    mutations: {
        SET_USER(state, payload) {
            state.user = payload;
        },
        SET_RESERVA(state, payload) {
            state.reserva = payload;
        },
    },
    actions: {
        setUser({ commit }, payload) {
            commit("SET_USER", payload);
        },
        setReserva({ commit }, payload) {
            commit("SET_RESERVA", payload);
        },
    },
});

export default store;

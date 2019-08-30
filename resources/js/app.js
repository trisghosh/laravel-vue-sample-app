/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal'
 
Vue.use(VModal)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('ajaxteamdata', require('./components/AjaxTeamData.vue').default);
Vue.component('ajaxplayerdata', require('./components/AjaxPlayerData.vue').default);
Vue.component('ajaxpointsdata', require('./components/AjaxPointsData.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// register modal component
  
const app = new Vue({
    el: '#app',
    data:{
        newMessage:{
            name:'tristup'
        },
        showTeamId: null,
        showPlayerId:null,
        seen: false
    },
    mounted(){
        console.log({ a: this})
    },
    methods: {
        showTeamDetails(e){
            console.log({e});
            this.$modal.show('teams')
            this.showTeamId = e.team_id
        },
        showPlayerDetails(e){
            console.log({e});
            this.$modal.show('player')
            this.showPlayerId = e.player_id
        },
        showPointsTable(e)
        {
            this.$modal.show('points')
            this.showTeamId = e.team_id
        },
        onChange(e)
        {
            console.log(e.target.value);
        },
        showHide(e)
        {
            console.log(e.target.value);
            e.target.value==2?this.seen=true:this.seen=false;
           
        },
        beforeOpen(e) {
            
           
        }
    }
});

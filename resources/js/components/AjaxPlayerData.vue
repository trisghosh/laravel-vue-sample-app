<template>
    <div class="modal-container" v-if="info">
        <div class="modal-header">
            <slot name="header">
                {{ info.first_name.charAt(0).toUpperCase() + info.first_name.slice(1) }} {{ info.last_name.charAt(0).toUpperCase() + info.last_name.slice(1)  }}
            </slot>
        </div>
        <div class="modal-body">
            <slot name="body">
                <div class="col-md-6 partition">
                    <img :src="imgurl + info.imageuri" class="player-logo">

                    <div> Jersey Number : {{info.jersey_no}}</div>
                    <div> Team : {{info.team.name}}</div>
                    <div class="">
                        <img :src="teamlogo + info.team.logouri" class="team-logo">
                    </div>
                </div>
                <div class="col-md-6 partition" v-if="info.playerdetails">
                    <div class="player-details">
                        <div v-if="info.playerdetails.total_matches">Total Match Played : {{info.playerdetails.total_matches}}</div>
                        <div v-if="info.playerdetails.highest_score">Highest Scored : {{info.playerdetails.highest_score}}</div>
                        <div v-if="info.playerdetails.total_run">Total Run : {{info.playerdetails.total_run}}</div>
                        <div v-if="info.playerdetails.hundreds">Hundreds : {{info.playerdetails.hundreds}}</div>
                        <div v-if="info.playerdetails.no_of_fifties">Fifties : {{info.playerdetails.no_of_fifties}}</div>
                        <div v-if="info.playerdetails.total_overs">Total Over Bowled: {{info.playerdetails.total_overs}}</div>
                        <div v-if="info.playerdetails.totle_wickets">Total Wicket Taken: {{info.playerdetails.totle_wickets}}</div>
                        <div v-if="info.playerdetails.totalhighest_highest_wicketswickets_overs">Higest Wicket: {{info.playerdetails.highest_wickets}}</div>
                        <div v-if="info.playerdetails.five_wickets">Higest Wicket: {{info.playerdetails.five_wickets}}</div>
                    </div>
                </div>
                <div v-else>
                    No Match Played yet
                </div>
            </slot>
        </div>

        
    </div>
</template>
<script>
      export default {
         data() {
            return {
              info: null,
              imgurl:null
            }
        },
        props: ['id'],
        mounted() {
            console.log(this.id)
            let ajax_url=process.env.MIX_AJAX_URL+'/api/player/'+this.id            
            this.imgurl=process.env.MIX_AJAX_URL+'/storage/playerimage/'
            this.teamlogo=process.env.MIX_AJAX_URL+'/storage/teamlogos/'

            console.log(ajax_url)
            axios
                .get(ajax_url)
                .then(response => (this.info = response.data))
                .catch(error => console.log(error))
        }
    }
</script>

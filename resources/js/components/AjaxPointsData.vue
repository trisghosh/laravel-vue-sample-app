<template>
    <div class="modal-container" v-if="info">
        <div class="modal-header">
            <slot name="header">
            Points Table
            
            </slot>
        </div>
        <div class="modal-body">
            <slot name="body" v-if="info">               
                <div v-for="inf in info">
                    <div class="match-details">
                        <img :src="teamlogo + inf.logo" class="team-logo">
                        <div v-if="inf.team_name">Team Name : {{inf.team_name}}</div>
                        <div v-if="inf.played_match">Played : {{inf.played_match}}</div>
                        <div v-if="inf.win">Win : {{inf.win}}</div>
                        <div v-if="inf.draw">Draw : {{inf.draw}}</div>
                        <div v-if="inf.lost">Lost : {{inf.lost}}</div>
                    </div>
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
            let ajax_url=process.env.MIX_AJAX_URL+'/api/points/'+this.id            
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

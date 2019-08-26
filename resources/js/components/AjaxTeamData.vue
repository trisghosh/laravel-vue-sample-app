<template>    
    <div class="modal-container" v-if="info">
        <div class="modal-header">
            <slot name="header">
                <img :src="teamlogo + info.logouri" class="team-logo"> {{ info.name }}
            </slot>
        </div>
        <div class="col-md-6 partition" v-if="info.point.length>0">
            <div class="points-details">
                <div>Total Match Played : {{info.point[0].played}}</div>
                <div>Match Win : {{info.point[0].win}}</div>
                <div>Match Lost : {{info.point[0].loose}}</div>
                <div>Match Drawn : {{info.point[0].draw}}</div>
                <div>Total Points : {{info.point[0].point}}</div>
            </div>
        </div>
        <div v-else>
            No Match Played yet
        </div>
    </div>
</template>
<script>
      export default {
         data() {
            return {
              info: null
            }
        },
        props: ['id'],
        mounted() {
            let ajax_url=process.env.MIX_AJAX_URL+'/api/team/'+this.id
            this.teamlogo=process.env.MIX_AJAX_URL+'/storage/teamlogos/'
            console.log(ajax_url);
            axios
                .get(ajax_url)
                .then(response => (this.info = response.data))
                .catch(error => console.log(error))
        }
    }
</script>

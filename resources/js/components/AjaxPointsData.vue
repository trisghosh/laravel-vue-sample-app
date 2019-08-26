<template>
    <div class="modal-container" v-if="info">
        <div class="modal-header">
            <slot name="header">
            Points Table
            </slot>
        </div>
        <div class="modal-body">
            <slot name="body">
               Body
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

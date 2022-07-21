<template>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <div style="width: 24px" @click="likePost">
                <img v-bind:src="likeIcon" class="w-100">
            </div> 
            <div style="width: 22px" class="ml-3"
                 onclick="document.getElementById('postcomment').focus();">
                <img src="/icons/icons8-comments-32.png" class="w-100">
            </div>
            <div style="width: 24px" class="ml-3">
                <img src="/icons/icons8-sent-32.png" class="w-100">
            </div>
        </div>
        <div>
            <div style="width: 24px" class="mr-2">
                <img src="/icons/icons8-bookmark-32.png" class="w-100">
            </div>
        </div>     
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        props: ['postId', 'likes'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                likeStatus: this.likes,
            }
        },
        
        methods: {
            likePost(){
                axios.post("/like/" + this.postId)
                    .then(response => {
                        this.likeStatus = !this.likeStatus;
                        console.log(response.data);
                    })
                    .catch(error => {
                        if(error.response.status === 401){
                            window.location = "/login";
                        }
                        console.log(error);
                    });
            }
        },

        computed: {
            likeIcon(){
                return (this.likeStatus) ? '/icons/icons8-love-32.png' : '/icons/icons8-favorite-32.png';
            }
        }
    }
</script>

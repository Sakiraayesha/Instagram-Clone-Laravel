<template>
    <div>
        <button v-if="!postview" class="btn btn-outline-secondary ml-4" @click="followUser" v-text="buttonText"></button>
        <span v-if="postview" class="text-info font-weight-bold ml-1" @click="followUser" v-text="buttonText" style="font-size: 13px; cursor: pointer"></span>
    </div>   
</template>

<script>
import axios from 'axios'

    export default {
        props: ['userId', 'follows', 'postview'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.follows
            }
        },

        methods: {
            followUser(){
                axios.post("/follow/" + this.userId)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(error => {
                        if(error.response.status === 401){
                            window.location = "/login";
                        }
                    });
            }
        },

        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>

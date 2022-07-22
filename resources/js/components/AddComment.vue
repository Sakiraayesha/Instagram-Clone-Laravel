<template>
    <div>
        <div class="text-info fs-7 mr-2" style="cursor: pointer" @click="AddComment">Post</div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        props: ['postId', 'userId', 'image', 'username'],

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            AddComment(){
                const newcomment = document.getElementById('comment').value;
                document.getElementById('comment').value = "";
                const removeElm = document.getElementsByClassName('commentclass')[2];                
                removeElm?.parentElement.removeChild(removeElm);
                const AddElm = document.createElement('div');
                AddElm.setAttribute('class', 'mb-1 ml-3 commentclass');
                AddElm.innerHTML = '<img class= "rounded-circle w-100 mr-1" style="max-width:25px" src="'+ this.image +'">'+
                                    '<a href="/profile/'+ this.userId +'" class="text-decoration-none mr-1">'+
                                        '<span class="text-dark font-weight-bold">'+this.username+'</span>'+
                                    '</a>'+
                                    '<span>'+newcomment+'</span>';                  
                document.getElementById('commentbox').prepend(AddElm);

                axios.post("/comment/" + this.postId, {comment: newcomment})
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        if(error.response.status === 401){
                            window.location = "/login";
                        }
                        console.log(error);
                    });
            }
        }
    }
</script>

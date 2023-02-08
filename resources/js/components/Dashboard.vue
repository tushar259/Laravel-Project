<template>
    <div style="padding-left:10%">
        <h1>Welcome <span style="color:red" v-if="userName != 'To Dashboard'">{{userName}}</span><span v-else>{{userName}}</span></h1>
    </div>
</template>

<script>
export default{
    
    data(){
        return{
            userName: 'To Dashboard'
        }

    },

    mounted(){
        $("#logout").hide();
        this.getUserData();
    },

    methods: {

        getUserData(){
            axios.get('/api/getUserInfo',{
                headers:{
                    'accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken')
                }
            }).then((response) => {
                
                if(response.data.message == "success"){
                    this.userName = response.data.data.name;
                    $("#login").hide();
                    $("#signup").hide();
                    $("#logout").show();
                }
                else{
                    this.userName = "To Dashboard";
                }
            })
            .catch((error) => {
                console.log(error.response.data.errors);
            });
            
        },


        

    }
}
</script>

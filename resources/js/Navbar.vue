<template>

    <nav class="navbar navbar-light bg-light justify-content-between" style="padding-left:2%">
        
        <router-link class="navbar-brand" to="/">Dashboard</router-link>
        <div class="form-inline">
            
            <router-link class="navbar-brand" to="/login" id="login">Login</router-link>
            <router-link class="navbar-brand" to="/registration" id="signup">Sign up</router-link>
            <router-link class="navbar-brand" to="" v-on:click="logoutClicked()" id="logout">Logout</router-link>
        </div>
    </nav>

    <router-view></router-view>
</template>


<script>

export default{
    
    data(){
        return{
            
        }

    },

    methods: {

        logoutClicked(){
            axios.get('/api/logoutUser').then((response) => {
                
                console.log(response);
                if(response.data.message == "success"){
                    localStorage.setItem('accessToken', "");
                    $("#login").show();
                    $("#signup").show();
                    $("#logout").hide();
                    location.reload();
                }
            })
            .catch((error) => {
                console.log(error.response.data.errors);
            });
            
        }

        

        

    }
}

</script>


